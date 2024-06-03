<?php

namespace App\Http\Controllers;
use App\Models\Wahana;
use App\Helpers\Reservation;
use App\Models\Reservations;
use App\Models\Coupons;
use App\Helpers\Mailer;
use App\Helpers\Midtrans;
use App\Http\Requests\ReservasiOnlineRequest;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use DB;
use App\Models\Configuration;
use App\Models\Reviews;

class FrontReservation extends Controller
{
    public function form_submit(Request $request)
    {
        $tanggal = explode(' - ', $request->reservation_date);
        return view('frontends.reservation.form')
                ->with([
                    'title' => 'Reservasi',
                    'data' => Wahana::with(['rooms', 'images'])->find($request->wahana_id),
                    'start_date' => $tanggal[0],
                    'end_date' => $tanggal[1],
                    'nights' => $request->nights,
                    'persons' => $request->person_quantity,
                    'tent' => $request->tent,
                    'ppn' => 11,
                ]);
    }

    public function store(Mailer $sendmail, Midtrans $midtrans, ReservasiOnlineRequest $request)
    {
        try {
            DB::beginTransaction();
                $daterange = explode(' - ', $request->reservation_date);
                $header = Reservations::create([
                    'trans_via' => 'online',
                    'trans_num' => Reservations::generateUniqueCode(),
                    'start_date' => $daterange[0],
                    'end_date' => $daterange[1],
                    'night_count' => $request->nights,
                    'wahana_id' => $request->wahana_id,
                    'room_id' => $request->tent,
                    'name' => $request->name,
                    'email' => $request->email,
                    'wa_number' => $request->wa_number,
                    'persons' => $request->persons,
                    'price' => str_replace('.', '', $request->price),
                    'subtotal' => str_replace('.', '', $request->subtotal),
                    'ppn' => $request->ppn,
                    'ppn_amount' => str_replace('.', '', $request->ppn_amount),
                    'total_amount' => str_replace('.', '', $request->total_amount),
                    'payment_status' => 'pending',
                    'reservation_status' => 'aktif',
                    'coupon_id' => $request->coupon_id,
                    'discount' => $request->discount,
                    'discount_type' => $request->discount_type,
                    'discount_amount' => $request->discount,
                    'omzet' => str_replace('.', '', $request->total_amount),
                ]);

                if($request->coupon_id != null){
                    $coupon = Coupons::find($request->coupon_id);
                    $coupon->status = ($coupon->balance == 1) ? 'NA' : $coupon->status;
                    $coupon->balance = $coupon->balance -1 ;
                    $coupon->save();
                }
                
                // $reservation = Reservations::with(['room', 'wahana'])->find(58);
                $payment = $midtrans->postCharge($header->id);
                // $payment = $this->postToMidtrans($header->id);
                if($payment){
                    $sendmail->reservation($request->email, $header->id);
                }
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();

            return response()->json([
                'msg_title' => 'Gagal!',
                'msg_body' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'msg_title' => 'Berhasil',
            'msg_body' => 'Reservasi berhasil dibuat. Detail pesanan telah dikirim via email, silahkan periksa inbox atau spam box. Selanjutnya Anda akan diarahkan ke halaman pembayaran.',
            'id' => Crypt::encryptString($header->id),
        ], 200);
    }

    public function make_payment($id){
        $data = Reservations::findOrFail(Crypt::decryptString($id));
        return view('frontends.reservation.make_payment')
                ->with([
                    'title' => 'Pembayaran Reservasi',
                    'data' => $data
                ]);
    }

    public function payment_created(){
        return view('frontends.reservation.payment_created')
                ->with([
                    'title' => 'Pembayaran Berhasil'
                ]);
    }

    public function notifier(Request $request, Midtrans $midtrans, Mailer $sendmail)
    {
        $notif = $midtrans->notifier($sendmail, $request->order_id);
        return response()->json($notif);
    }

    public function check_availability(Reservation $reservation, Request $request){
        return $reservation->check_availability($request->all());
    }

    public function get_coupon(Reservation $reservation, $wahana_id, $code){
        return $reservation->checkCoupon($wahana_id, $code);
    }

    public function ticket($id)
    {
        $data = Reservations::with(['payments', 'wahana', 'room'])->find(Crypt::decryptString($id));
        if($data->reservation_status != 'aktif'){
            abort(404);
        }

        return view('modules.cashier_reservasi.receipt')
                ->with([
                    'title' => 'Slip Reservasi #'.$data->trans_num,
                    'data' => $data,
                    'qrcode' => QrCode::size(150)->backgroundColor(255, 255, 255)->generate($data->trans_num)
                ]);
    }

    public function cancel($id)
    {
        $data = Reservations::with(['payments', 'wahana', 'room'])->find(Crypt::decryptString($id));
        if($data->reservation_status != 'aktif'){
            abort(404);
        }

        return view('frontends.reservation.cancel')
                ->with([
                    'title' => 'Batalkan Reservasi',
                    'data' => $data,
                    'cancelRules' => Configuration::where('prefix', 'cancel')->get(),
                ]);
    }

    public function submit_cancel(Request $request)
    {
        try {
            DB::beginTransaction();
                $data = Reservations::find($request->id);
                if($request->payment_status === 'paid'){
                    $data->refund = $request->refund;
                    $data->omzet = $request->omzet;
                    $data->reservation_status = 'cancel';
                    $data->cancel_reason = $request->cancel_reason;
                }
                $data->save();
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();

            return response()->json([
                'msg_title' => 'Gagal!',
                'msg_body' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'msg_title' => 'Berhasil',
            'msg_body' => 'Terima kasih untuk feedback kamu. Sampai berjumpa kembali di lain kesempatan😉',
        ], 200);
    }

    public function review($slug, $reservation)
    {
        $wahana = Wahana::where('slug', $slug)->first();
        $reservation = Reservations::find(Crypt::decryptString($reservation));
        return view('frontends.reservation.post_review')
                ->with([
                    'title' => 'Berikan Review',
                    'wahana' => $wahana,
                    'reservation' => $reservation
                ]);
    }

    public function post_review(ReviewRequest $request)
    {
        try {
            DB::beginTransaction();
                Reviews::create([
                    'wahana_id' => $request->wahana_id,
                    'reservation_id' => $request->reservation_id,
                    'name' => $request->name,
                    'star' => $request->star,
                    'testimonial' => $request->review
                ]);
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();

            return response()->json([
                'msg_title' => 'Gagal!',
                'msg_body' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'msg_title' => 'Berhasil',
            'msg_body' => 'Terima kasih untuk review kamu. Sampai berjumpa kembali di lain kesempatan😉',
        ], 200);
    }

    public function template_email(){
        $data = Reservations::find(22);
        return view('emails.reservation')
                ->with([
                    'data' => $data
                ]);
    }

    public function template_email_payment()
    {
        $data = Reservations::find(81);
        return view('emails.payment')
                ->with([
                    'data' => $data
                ]);
    }

    public function template_email_review()
    {
        $data = Reservations::with(['wahana'])->find(1);
        return view('emails.review')
                ->with([
                    'data' => $data
                ]);
    }
}
