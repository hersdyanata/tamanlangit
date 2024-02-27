<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use DB;

class TransCheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:kasir-checkout-list|kasir-checkout-create|kasir-checkout-edit|kasir-checkout-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:kasir-checkout-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:kasir-checkout-edit|kasir-checkout-create'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:kasir-checkout-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.cashier_checkout.index')
                ->with([
                    'title' => 'Check-Out'
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
                ->whereNull('cancel_flag')
                ->whereNotNull('checkin_date')
                ->whereNull('checkout_date')
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
                'msg_body' => 'Data reservasi dengan nomor tiket <strong>#'.$id.'</strong> tidak ditemukan atau belum check-in',
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
                $data->checkout_date = now();
                $data->complete_flag = 'Y';
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
            'msg_body' => 'Nomor tiket <strong>#'.$data->trans_num.'</strong> telah check-out',
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
