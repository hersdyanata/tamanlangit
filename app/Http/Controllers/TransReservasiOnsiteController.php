<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wahana;
use App\Models\Reservations;
use DB;
use App\Models\Payments;
use DataTables;
use QrCode;
use App\Models\Coupons;
use App\Models\EventOrganizer;
use App\Http\Requests\ReservasiOnsiteRequest;
use Illuminate\Support\Facades\Cache;
use App\Models\ReservedDates;

class TransReservasiOnsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:kasir-reservasi-list|kasir-reservasi-create|kasir-reservasi-edit|kasir-reservasi-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:kasir-reservasi-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:kasir-reservasi-edit|kasir-reservasi-create'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:kasir-reservasi-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Reservations::with(['payments', 'wahana', 'room'])->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('kasir-reservasi-list')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-info btn-icon tooltiped" title="Cetak Tiket" onclick="openReceipt('.$row->id.')">
                                <i class="icon-ticket"></i>
                            </button> ';
                }

                return $btn;
            })->addColumn('a_tiket', function ($row) {
                $link_style = 'success';
                if($row->cancel_flag == 'Y'){
                    $link_style = 'danger';
                }
                return '<a href="'.route('transaksi.cash-reservasi.show', $row->id).'" class="text-'.$link_style.' link-'.$link_style.' tooltiped" title="Lihat Detail">#'.$row->trans_num.'</a>';
            })->rawColumns(['actions', 'a_tiket'])
            ->make(true);
        }
        return view('modules.cashier_reservasi.index')
                ->with([
                    'title' => 'Reservasi On-Site',
                    'wahanas' => Wahana::with(['rooms'])->get(),
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wahana = Cache::remember('dropdown_wahana', 60, function() {
            return Wahana::with(['rooms'])->get();
        });

        $coupons = Cache::remember('dropdown_coupon', 300, function () {
            return Coupons::where(['status' => 'A', 'valid_for' => 'both'])->orWhere('valid_for', 'onsite')->get();
        });

        return view('modules.cashier_reservasi.create')
                ->with([
                    'title' => 'Reservasi On-Site',
                    'wahanas' => $wahana,
                    'coupons' => $coupons,
                    'eos' => EventOrganizer::all(),
                    'withParams' => false
                ]);
    }

    public function create_with_params($tanggal, $wahana_id, $room_id)
    {
        $wahana = Cache::remember('dropdown_wahana', 60, function() {
            return Wahana::with(['rooms'])->get();
        });

        $coupons = Cache::remember('dropdown_coupon', 300, function () {
            return Coupons::where(['status' => 'A', 'valid_for' => 'both'])->orWhere('valid_for', 'onsite')->get();
        });

        return view('modules.cashier_reservasi.create')
                ->with([
                    'title' => 'Reservasi On-Site',
                    'wahanas' => $wahana,
                    'coupons' => $coupons,
                    'eos' => EventOrganizer::all(),
                    'withParams' => true,
                    'date_from' => $tanggal,
                    'wahana_id' => $wahana_id,
                    'room_id' => $room_id
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservasiOnsiteRequest $request)
    {
        try {
            DB::beginTransaction();
                $daterange = explode(' - ', $request->tanggal);
                $komisi_eo = 0;
                if($request->eo_id != null) {
                    if($request->eo_commission_type == 'persentase'){
                        $komisi_eo = str_replace('.', '', $request->total_amount) * $request->eo_commission / 100;
                    }else{
                        $komisi_eo = $request->eo_commission * $request->jumlah_malam;
                    }
                }
                $header = Reservations::create([
                    'trans_via' => 'onsite',
                    'trans_num' => Reservations::generateUniqueCode(),
                    'start_date' => $daterange[0],
                    'end_date' => $daterange[1],
                    'checkin_date' => (isset($request->toggle_checkin)) ? now() : null,
                    'night_count' => $request->jumlah_malam,
                    'wahana_id' => $request->wahana_id,
                    'room_id' => $request->room_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'wa_number' => $request->wa_number,
                    'persons' => $request->persons,
                    'price' => str_replace('.', '', $request->price),
                    'subtotal' => str_replace('.', '', $request->subtotal),
                    'ppn' => $request->ppn,
                    'ppn_amount' => str_replace('.', '', $request->ppn_amount),
                    'total_amount' => str_replace('.', '', $request->total_amount),
                    'payment_status' => 'paid',
                    'eo_id' => $request->eo_id,
                    'eo_commission' => $request->eo_commission,
                    'eo_commission_type' => $request->eo_commission_type,
                    'eo_total_commission' => $komisi_eo,
                    'coupon_id' => $request->coupon_id,
                    'discount' => $request->discount,
                    'discount_type' => $request->discount_type,
                    'discount_amount' => ($request->has('toggle_coupon') && $request->toggle_coupon) ? str_replace('.', '',  $request->discount_amount) : null,
                    'omzet' => str_replace('.', '', $request->total_amount) - $komisi_eo,
                ]);

                if($request->coupon_id != null){
                    $coupon = Coupons::find($request->coupon_id);
                    $coupon->status = ($coupon->balance == 1) ? 'NA' : $coupon->status;
                    $coupon->balance = $coupon->balance -1 ;
                    $coupon->save();
                }

                $payment = array();
                if($request->payment_method != 'split'){
                    $payment = [
                        'payment_for' => 'reservation',
                        'trans_id' => $header->id,
                        'method' => $request->payment_method,
                        'amount' => str_replace('.', '', $request->total_amount),
                        'status' => 'paid',
                        'pay_date' => now(),
                        'received_by' => auth()->user()->id
                    ];
                }else{
                    foreach ($request->input('pay') as $i => $v) {
                        $payment[] = [
                            'payment_for' => 'reservation',
                            'trans_id' => $header->id,
                            'method' => $i,
                            'amount' => str_replace('.', '', $request->pay[$i]),
                            'status' => 'paid',
                            'pay_date' => now(),
                            'received_by' => auth()->user()->id
                        ];
                    }
                }

                Payments::insert($payment);
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
            'msg_body' => 'Data berhasil disimpan. Nomor transaksi: <strong>#'.$header->trans_num.'</strong>',
            'trans_id' => $header->id
        ], 200);
    }

    public function receipt($id)
    {
        $data = Reservations::with(['payments', 'wahana', 'room'])->find($id);
        return view('modules.cashier_reservasi.receipt')
                ->with([
                    'title' => 'Slip Reservasi #'.$data->trans_num,
                    'data' => $data,
                    'qrcode' => QrCode::size(150)->backgroundColor(255, 255, 255)->generate($data->trans_num)
                ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Reservations::with(['coupon', 'eo', 'wahana', 'room',])->find($id);
        return view('modules.cashier_reservasi.detail')
                ->with([
                    'title' => 'Detail Reservasi #'.$data->trans_num,
                    'data' => $data,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->_to == 'cancel'){
            $res = $this->cancel_reservation($request->id, $request->_reason);
        }

        return response()->json($res, 200);
    }

    public function cancel_reservation($id, $message)
    {
        $data = Reservations::find($id);
        $data->cancel_flag = 'Y';
        $data->payment_status = 'cancel';
        $data->cancel_reason = $message;
        $data->save();

        Payments::where('payment_for', 'reservation')->where('trans_id', $id)->update(['status' => 'cancel']);

        return [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Reservasi dengan nomor tiket <strong>#'.$data->trans_num.'</strong> sudah dibatalkan!',
        ];        
    }

    public function check_availability(Request $request)
    {
        $tanggal = explode(' - ', $request->daterange);
        $reserved = ReservedDates::whereBetween('date', $tanggal)->where('wahana_id', $request->wahana_id)->where('room_id', $request->room_id)->get();

        $message = '';
        foreach ($reserved as $index => $reservation){
            $message .= '<span class="fw-semibold">#'.$reservation->trans_num. '</span>, <span class="fw-semibold text-danger">Tanggal: '.$reservation->date.'</span>';        
            if ($index < count($reserved) - 1) {
                $message .= '<br>';
            }
        }

        $availability = (count($reserved) > 0) ? false : true;

        return response()->json([
            'isAvailable' => $availability,
            'message' => $message
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
