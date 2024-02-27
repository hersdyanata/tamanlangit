<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchases;
use App\Models\PurchaseDetails;
use App\Models\InventoryStock;
use App\Models\Suppliers;
use DB;
use App\Http\Requests\PurchaseRequest;
use Carbon\Carbon;
use DataTables;

class InventoryPurchasingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:inventory-purchasing-list|inventory-purchasing-create|inventory-purchasing-edit|inventory-purchasing-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:inventory-purchasing-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:inventory-purchasing-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:inventory-purchasing-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Purchases::with(['supplier', 'creator'])->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('supplier', function ($row) {
                return $row->supplier->name;
            })
            ->addColumn('creator', function ($row) {
                return $row->creator->name;
            })
            ->addColumn('a_trans_num', function ($row) {
                return '<a href="'.route('inventory.purchasing.detail', $row->id).'" class="tooltiped" title="Lihat Detail">'.$row->trans_num.'</a>';
            })
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('inventory-purchasing-edit')){
                    $btn .= '<a href="'.route('inventory.purchasing.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                                
                if(auth()->user()->can('inventory-purchasing-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions', 'a_trans_num'])
            ->make(true);
        }
        return view('modules.inventory_purchasing.index')
                ->with([
                    'title' => 'Pembelian Inventory'
                ]);
    }

    public function detail($id)
    {
        $data = Purchases::with(['supplier', 'creator', 'items', 'items.product', 'items.product.category'])->find($id);
        return view('modules.inventory_purchasing.detail')
                ->with([
                    'title' => 'Detail Pembelian Nomor Transaksi: '.$data->trans_num,
                    'purchase' => $data
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.inventory_purchasing.create')
                ->with([
                    'title' => 'Buat Pembelian Baru',
                    'suppliers' => Suppliers::all()
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseRequest $request)
    {
        try {
            DB::beginTransaction();
                $header = Purchases::create([
                    'trans_num' => Purchases::generateUniqueCode(),
                    'trans_date' => Carbon::now(),
                    'supplier_id' => $request->supplier_id,
                    'amount' => (isset($request->toggle_ppn)) ? str_replace('.', '', $request->total_amount) - str_replace('.', '', $request->ppn_amount) : str_replace('.', '', $request->total_amount),
                    'ppn' => (isset($request->toggle_ppn)) ? $request->ppn : null,
                    'ppn_amount' => (isset($request->toggle_ppn)) ? str_replace('.', '', $request->ppn_amount) : null,
                    'total_amount' => str_replace('.', '', $request->total_amount),
                    'non_stock' => (isset($request->toggle_non_stock)) ? 'non stock' : 'stock',
                    'created_by' => auth()->user()->id
                ]);

                $items = array();
                for($i = 0; $i < count($request->price); $i++){
                    $items[] = [
                        'purchase_id' => $header->id,
                        'product_id' => $request->product_id[$i],
                        'quantity' => $request->quantity[$i],
                        'price' => str_replace('.', '', $request->price[$i]),
                        'subtotal' => str_replace('.', '', $request->subtotal[$i]),
                    ];
                }

                if(!isset($request->toggle_non_stock)){
                    InventoryStock::updateOrInsertStocks($items, $header->trans_date);
                }

                PurchaseDetails::insert($items);
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
            'msg_body' => 'Data pembelian berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Purchases::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus pembelian dengan nomor transaksi <code>'.$data->trans_num.'</code>?<br><br><strong>Jika pembelian ini masuk kedalam stock maka penghapusan data akan mengurangi quantity stock inventory produk terkait!</strong>',
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Purchases::with(['items', 'items.product', 'items.product.category'])->find($id);
        return view('modules.inventory_purchasing.edit')
                ->with([
                    'title' => 'Edit Pembelian Nomor Transaksi '. $data->trans_num,
                    'suppliers' => Suppliers::all(),
                    'data' => $data
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PurchaseRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $totalAmount = intval(str_replace('.', '', $request->total_amount));
                $ppnAmount = intval(str_replace('.', '', $request->ppn_amount));
                
                $header = Purchases::find($id);
                $header->trans_date = Carbon::now();
                $header->supplier_id = $request->supplier_id;
                $header->amount = ($request->has('toggle_ppn') && $request->toggle_ppn) ? $totalAmount - $ppnAmount : $totalAmount;
                $header->ppn = ($request->has('toggle_ppn') && $request->toggle_ppn) ? $request->ppn : null;
                $header->ppn_amount = ($request->has('toggle_ppn') && $request->toggle_ppn) ? $ppnAmount : null;
                $header->total_amount = $totalAmount;
                $header->updated_by = auth()->user()->id;
                $header->save();

                for($i = 0; $i < count($request->price); $i++){
                    PurchaseDetails::updateOrCreate(
                        ['product_id' => $request->product_id[$i]],
                        [
                            'purchase_id' => $id,
                            'quantity' => $request->quantity[$i],
                            'price' => str_replace('.', '', $request->price[$i]),
                            'subtotal' => str_replace('.', '', $request->subtotal[$i])
                        ]
                    );

                    if($request->non_stock == 'stock'){
                        $stockExists = InventoryStock::where('product_id', $request->product_id[$i])->first();
                        if($stockExists){
                            $stockExists->update([
                                'quantity' => $stockExists->quantity - $request->old_quantity[$i] + $request->quantity[$i],
                            ]);
                        }else{
                            InventoryStock::create([
                                'product_id' => $request->product_id[$i],
                                'quantity' => $request->quantity[$i],
                                'last_purchase' => now()
                            ]);
                        }
                    }
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
            'msg_body' => 'Perubahan pembelian berhasil disimpan'
        ], 200);
    }

    public function updateStockQty($product_id, $current_quantity, $new_quantity)
    {
        $put = InventoryStock::find($product_id);
        $put->quantity = $put->quantity - $put->quantity + $new_quantity;
        $put->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Purchases::with(['items'])->find($id);
        if($data->non_stock == 'stock'){
            foreach($data->items as $item){
                $stock = InventoryStock::where('product_id', $item->product_id)->first();
                $stock->update([
                    'quantity' => $stock->quantity - $item->quantity
                ]);
            }
        }
        
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Pembelian dengan nomor transaksi '.$data->trans_num.' telah dihapus. Jika pembelian ini "Masuk Kedalam Stock" maka quantity stock terkait telah dikurangi sesuai dengan penghapusan ini.',
        ];
        PurchaseDetails::where('purchase_id', $id)->delete();
        $data->delete();
        return response()->json($res,200);
    }
}
