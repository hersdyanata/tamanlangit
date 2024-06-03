<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use DB;
use App\Models\ReservationExtraServices;
use App\Models\InventoryStock;
use App\Models\WahanaRoom;

class TransCheckinController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:kasir-checkin-list|kasir-checkin-create|kasir-checkin-edit|kasir-checkin-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:kasir-checkin-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:kasir-checkin-edit|kasir-checkin-create'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:kasir-checkin-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.cashier_checkin.index')
            ->with([
                'title' => 'Check-In',
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Reservations::with(['wahana', 'room', 'wahana.facilities'])
                ->where('trans_num', $id)
                ->where('reservation_status', 'aktif')
                ->whereNull('checkin_date')
                // ->whereDate('start_date', '=', now()->format('Y-m-d'))
                ->first();

        if(isset($data)){
            $result = [
                'isFound' => true,
                'msg_title' => 'Berhasil!',
                'msg_body' => 'Data reservasi dengan nomor tiket <strong>#'.$id.'</strong> ditemukan',
                'data' => $data
            ];
        }else{
            $result = [
                'isFound' => false,
                'msg_title' => 'Gagal!',
                'msg_body' => 'Data reservasi dengan nomor tiket <strong>#'.$id.'</strong> tidak ditemukan',
            ];
        }
        return response()->json($result, 200);
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
        try {
            DB::beginTransaction();
                $data = Reservations::find($id);
                $room = WahanaRoom::find($data->room_id);
                $room->status = 'RV';
                $room->last_checkin = now();
                $room->save();

                if($request->total_extra_bill !== null){
                    $extra = [];
                    for($i = 0; $i < count($request->extra_type); $i++){
                        $extra[] = [
                            'reservation_id' => $id,
                            'type' => $request->extra_type[$i],
                            'stock_id' => $request->stock_id[$i],
                            'price' => str_replace('.', '', $request->price[$i]),
                            'quantity' => $request->quantity[$i],
                            'subtotal' => str_replace('.', '', $request->subtotal[$i]),
                        ];

                        if($request->extra_type[$i] == 'item'){
                            $stock[$i] = InventoryStock::find($request->stock_id[$i]);
                            $stock[$i]->quantity = $stock[$i]->quantity - $request->quantity[$i];
                            $stock[$i]->save();
                        }
                    }

                    ReservationExtraServices::insert($extra);
                    $data->extra_bill = $request->total_extra_bill;
                }

                $data->checkin_date = now();
                $data->save();
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();
            return response()->json([
                'msg_title' => 'Gagal!',
                'msg_body' => $e->getMessage()
            ], 400);
        }
        
        $result = [
            'msg_title' => 'Berhasil!',
            'msg_body' => 'Nomor tiket <strong>#'.$data->trans_num.'</strong> telah check-in',
        ];

        return response()->json($result, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
