<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Tickets;
use App\Models\TicketDirect;
use App\Models\TicketDirectSales;
use App\Models\TicketDirectSalesDetail;

class TiketSalesDirectController extends Controller
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
            $data = TicketDirectSalesDetail::with(['ticket', 'ticket.category_', 'parent'])->orderBy('trans_id', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('tiket-sales-list')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Cetak Slip" onclick="receipt_direct('.$row->trans_id.')">
                                <i class="ph-printer"></i>
                            </button> ';
                }

                if(auth()->user()->can('tiket-sales-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction_direct('.$row->trans_id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }

        return view('modules.ticket_sales.index')
        ->with([
            'title' => 'Penjualan Tiket'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.ticket_sales.create_direct')
                ->with([
                    'title' => 'Kasir Penjualan Langsung ',
                    'tickets' => TicketDirect::with(['category_'])->get(),
                    // 'price' => TicketDirect::where('category', $params)->pluck('price')->first(),
                    // 'category' => $params
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
                $sale = TicketDirectSales::create([
                    'trans_num' => TicketDirectSales::generateUniqueCode(),
                    'trans_date' => now(),
                    'amount' => $request->total_billing,
                    'created_by' => auth()->user()->id,
                ]);

                $detail = [];
                if ($request->has('check_ticket')) {
                    for ($i = 0; $i < count($request->ticket_id); $i++){
                        if($request->ticket_id[$i] !== null){
                            // echo 'tiket_id: '. count($request->ticket_id).'<br>';
                            // echo 'price: '. count($request->price).'<br>';
                            // echo 'quantity: '. count($request->quantity).'<br>';
                            // echo 'subtotal: '. count($request->subtotal).'<br>';
                            $detail[] = [
                                'trans_id' => $sale->id,
                                'ticket_id' => $request->ticket_id[$i],
                                'price' => $request->price[$i],
                                'quantity' => $request->quantity[$i],
                                'subtotal' => $request->subtotal[$i],
                            ];
                        }
                    }
                }

                TicketDirectSalesDetail::insert($detail);
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
            'ticket' => $sale->id
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = TicketDirectSales::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus penjualan tiket #'.$data->trans_num.'? Penghapusan ini akan menghapus semua data penjualan tiket terkait.',
        ];
        return response()->json($res, 200);
    }

    public function receipt($id)
    {
        $data = TicketDirectSales::with(['details', 'details.ticket', 'details.ticket.category_'])->find($id);
        return view('modules.ticket_sales.receipt_direct')
                ->with([
                    'title' => 'Tiket #'.$data->trans_num,
                    'data' => $data
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TicketDirectSales::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Penjualan tiket dengan nomor #'.$data->trans_num.' beserta item didalamnya telah dihapus.',
        ];
        TicketDirectSalesDetail::where('trans_id', $id)->delete();
        $data->delete();
        return response()->json($res,200);
    }
}
