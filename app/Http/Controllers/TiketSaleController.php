<?php

namespace App\Http\Controllers;

use App\Models\TicketSerials;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Tickets;
use App\Http\Requests\TiketRequest;
use App\Models\TicketSales;
use App\Models\TicketDirect;
use Illuminate\Support\Facades\Cache;

class TiketSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:tiket-sales-list|tiket-sales-create|tiket-sales-edit|tiket-sales-delete'], ['only' => ['index', 'show', 'get_batch']]);
        $this->middleware(['permission:tiket-sales-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:tiket-sales-edit|tiket-sales-create'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:tiket-sales-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TicketSales::with(['bulk'])->orderBy('sold_date', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('tiket-sales-list')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Cetak Slip" onclick="openReceipt('.$row->id.')">
                                <i class="ph-printer"></i>
                            </button> ';
                }

                if(auth()->user()->can('tiket-sales-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->addColumn('batch_code_sn', function ($row){
                if($row->trans_type == 'bulk'){
                    return $row->bulk->code.'-'.$row->serial_number;
                }else{
                    return $row->serial_number;
                }
            })->rawColumns(['actions', 'a_code'])
            ->make(true);
        }
        return view('modules.ticket_sales.index')
                ->with([
                    'title' => 'Penjualan Tiket'
                ]);
    }

    public function receipt($id)
    {
        $data = TicketSales::find($id);
        return view('modules.ticket_sales.receipt')
                ->with([
                    'title' => 'Tiket '.$data->category.' #'.$data->serial_number,
                    'data' => $data
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.ticket_sales.create')
                ->with([
                    'title' => 'Penjualan Tiket Baru'
                ]);
    }

    public function create_params($params)
    {
        return view('modules.ticket_sales.create_with_params')
                ->with([
                    'title' => 'Kasir Penjualan Tiket '.ucfirst($params),
                    'price' => TicketDirect::where('category', $params)->pluck('price')->first(),
                    'category' => $params
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
                $data = $request->input('data');
                $unsold = json_decode($data['serials'], true);
                $solds = TicketSerials::where('ticket_id', $request->batch_id)->whereNotIn('serial_number', $unsold)->get();
                
                $arraySold = [];
                foreach ($solds as $sold) {
                    $arraySold[] = [
                        'trans_type' => 'bulk',
                        'ticket_batch_id' => $request->batch_id,
                        'serial_number' => $sold->serial_number,
                        'category' => $request->category,
                        'price' => str_replace('.', '', $request->price),
                        'sold_date' => now(),
                        'created_by' => auth()->user()->id,
                    ];

                    $sold->status = 'sold';
                    $sold->sold_date = now();
                    $sold->save();
                }

                TicketSales::insert($arraySold);
                TicketSerials::where('ticket_id', $request->batch_id)
                            ->whereIn('serial_number', $unsold)
                            ->update([
                                'status' => 'expired'
                            ]);

                Tickets::where('id', $request->batch_id)->update([
                    'status' => 'selesai',
                    'updated_by' => auth()->user()->id,
                ]);
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
            'msg_body' => 'Penjualan tiket berhasil disimpan',
        ], 200);
    }
    
    public function store_direct(Request $request)
    {
        $createdId = [];
        try {
            DB::beginTransaction();
                for($i = 0; $i < $request->quantity; $i++){
                    $ticketSale = TicketSales::create([
                        'trans_type' => 'direct',
                        'serial_number' => TicketSales::generateUniqueCode(),
                        'category' => $request->category,
                        'price' => str_replace(',', '', $request->price),
                        'sold_date' => now(),
                        'created_by' => auth()->user()->id,
                    ]);

                    $createdId[] = $ticketSale->id;
                }
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
            'msg_body' => 'Penjualan tiket berhasil disimpan',
            'tickets' => $createdId
        ], 200);
    }

    public function get_batch($code){
        $data = Tickets::with(['serials'])->where('code', $code)->first();
        if(isset($data)){
            if($data->status == 'aktif'){
                $res = [
                    'isFound' => true,
                    'msg_body' => 'Tiket Batch #'.$data->code.' ditemukan!',
                    'data' => $data,
                ];
            }else{
                $res = [
                    'isFound' => false,
                    'msg_body' => 'Tiket Batch #'.$data->code.' sudah selesai!',
                ];
            }
        }else{
            $res = [
                'isFound' => false,
                'msg_body' => 'Tiket Batch #'.$code.' tidak ditemukan!',
            ];
        }

        return response()->json($res, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = TicketSales::with(['bulk'])->find($id);

        if ($data->trans_type == 'bulk'){
            $label = $data->bulk->code.'-'.$data->serial_number;
        }else{
            $label = $data->serial_number;
        }
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus penjualan tiket #'.$label.'? Penghapusan ini mungkin akan membuat laporan menjadi tidak akurat.',
        ];
        return response()->json($res, 200);
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
    public function update(TiketRequest $request, string $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TicketSales::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Penjualan tiket dengan serial number #'.$data->serial_number.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);
    }
}
