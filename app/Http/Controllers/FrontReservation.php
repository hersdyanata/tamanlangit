<?php

namespace App\Http\Controllers;
use App\Models\Wahana;
use App\Helpers\Reservation;
use App\Models\Reservations;
use App\Models\Coupons;
use App\Models\Payments;
use App\Helpers\Mailer;

use QrCode;
use PDF;

use Illuminate\Http\Request;
use DB;

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

    public function store(Mailer $sendmail, Request $request)
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
                    'payment_status' => 'unpaid',
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

                Payments::create([
                    'payment_for' => 'reservation',
                    'trans_id' => $header->id,
                    'method' => 'midtrans',
                    'amount' => $header->total_amount,
                    'status' => 'unpaid'
                ]);

                $dataMail = Reservations::with(['room', 'wahana'])->find($header->id)->toArray();
                $sendmail->reservation($request->email, $dataMail);
                // $this->generatePDF();
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();

            return response()->json([
                'msg_title' => 'Gagal!',
                'msg_body' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'msg_title' => 'Berhasil',
            'msg_body' => 'Reservasi berhasil dibuat. Detail pesanan telah dikirim via email, silahkan periksa inbox atau spam box. Selanjutnya Anda akan diarahkan ke halaman pembayaran.',
        ], 200);
    }

    public function check_availability(Reservation $reservation, Request $request){
        return $reservation->check_availability($request->all());
    }

    public function get_coupon(Reservation $reservation, $wahana_id, $code){
        return $reservation->checkCoupon($wahana_id, $code);
    }

    public function generatePDF()
    {
        $reservation = Reservations::with(['payments', 'wahana', 'room'])->find(1);
        $qrcode = QrCode::size(150)->backgroundColor(255, 255, 255)->generate($reservation->trans_num);
        echo $qrcode;
        die;
        $data = [
            'title' => 'Slip',
        ];
        $pdf = PDF::loadView('modules.cashier_reservasi.test', $data);
        return $pdf->download('document.pdf');
    }

    public function template_email(){
        return view('emails.reservation')
                ->with([
                    'qrcode' => QrCode::size(150)->backgroundColor(255, 255, 255)->generate('2222222')
                ]);
    }
}
