<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\InventoryStock;
use App\Models\Payments;
use DB;
use DataTables;

class TransInventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:kasir-inventory-list|kasir-inventory-create|kasir-inventory-edit|kasir-inventory-delete'], ['only' => ['index', 'show', 'list']]);
        $this->middleware(['permission:kasir-inventory-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:kasir-inventory-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:kasir-inventory-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sales::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('kasir-inventory-list')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Cetak Slip" onclick="openReceipt('.$row->id.')">
                                <i class="ph-printer"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }

        return view('modules.cashier_inventory.index')
                ->with([
                    'title' => 'Penjualan Inventory'
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.cashier_inventory.create')
                ->with([
                    'title' => 'Penjualan Inventory'
                ]);
    }

    public function receipt($id)
    {
        $data = Sales::with(['items'])->find($id);
        return view('modules.cashier_inventory.sales_receipt')
                ->with([
                    'title' => 'Slip Penjualan #'.$data->trans_num,
                    'data' => $data
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
                $header = Sales::create([
                    'trans_num' => Sales::generateUniqueCode(),
                    'trans_date' => now(),
                    'ppn' => (isset($request->toggle_ppn)) ? $request->ppn : null,
                    'ppn_amount' => (isset($request->toggle_ppn)) ? str_replace('.', '', $request->ppn_amount) : null,
                    'amount' => (isset($request->toggle_ppn)) ? str_replace('.', '', $request->total_amount) - str_replace('.', '', $request->ppn_amount) : str_replace('.', '', $request->total_amount),
                    'total_amount' => str_replace('.', '', $request->total_amount),
                    'payment_status' => 'paid',
                    'created_by' => auth()->user()->id
                ]);

                $items = array();
                for($i = 0; $i < count($request->stock_id); $i++){
                    $items[] = [
                        'sales_id' => $header->id,
                        'stock_id' => $request->stock_id[$i],
                        'product_id' => $request->product_id[$i],
                        'quantity' => $request->quantity[$i],
                        'price' => str_replace('.', '', $request->price[$i]),
                        'subtotal' => str_replace('.', '', $request->quantity[$i]) * str_replace('.', '', $request->price[$i]),
                    ];

                    $stock[$i] = InventoryStock::find($request->stock_id[$i]);
                    $stock[$i]->quantity = $stock[$i]->quantity - $request->quantity[$i];
                    $stock[$i]->price = ($request->old_price[$i] != str_replace('.', '', $request->price[$i])) ? str_replace('.', '', $request->price[$i]) : $request->old_price[$i];
                    $stock[$i]->save();
                }
                SalesDetails::insert($items);

                $payment = array();
                if($request->payment_method != 'split'){
                    $payment = [
                        'payment_for' => 'sales',
                        'trans_id' => $header->id,
                        'method' => $request->payment_method,
                        'amount' => $header->total_amount,
                        'status' => 'paid',
                        'pay_date' => now(),
                        'received_by' => auth()->user()->id
                    ];
                }else{
                    foreach ($request->input('pay') as $i => $v) {
                        $payment[] = [
                            'payment_for' => 'sales',
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
