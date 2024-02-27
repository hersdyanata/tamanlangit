<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wahana;
use App\Models\Reservations;
use App\Models\ReservedDates;

class WahanaMonitoringController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:monitoring-list|monitoring-create|monitoring-edit|monitoring-delete'], ['only' => ['index', 'show', 'store']]);
        // $this->middleware(['permission:monitoring-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:monitoring-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:monitoring-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Wahana::with(['rooms'])->get();
        return view('modules.wahana_monitoring.index')
                ->with([
                    'title' => 'Monitoring Wahana',
                    'wahana' => $data
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
        $data = ReservedDates::where('date', $request->date)->where('wahana_id', $request->wahana_id)->get();
        
        if ($data->count() > 0) {
            $response = [
                'msg_title' => 'Berhasil',
                'msg_body' => 'Data reservasi tanggal '. $request->date .' berhasil dimuat',
                'data' => $data,
                'isExists' => true,
            ];
        }else{
            $response = [
                'msg_title' => 'Gagal',
                'msg_body' => 'Data reservasi tanggal '. $request->date .' tidak ditemukan',
                'data' => null,
                'isExists' => false,
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
