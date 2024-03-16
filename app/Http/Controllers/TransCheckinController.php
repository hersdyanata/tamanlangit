<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use DB;

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
                ->whereNull('cancel_flag')
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
