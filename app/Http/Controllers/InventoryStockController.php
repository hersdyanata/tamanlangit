<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryStock;
use DB;
use DataTables;

class InventoryStockController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:inventory-stock-list|inventory-stock-create|inventory-stock-edit|inventory-stock-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:inventory-stock-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:inventory-stock-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:inventory-stock-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if($request->param == 'stock'){
                $data = InventoryStock::with(['product', 'product.category'])->get();
            }else{
                $data = InventoryStock::with(['product', 'product.category'])
                ->whereHas('product', function ($query) {
                    $query->where('inventory_type', 'sale');
                })->get();
            }
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('inventory-stock-edit')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Ubah Quantity Pengingat" onclick="set_('.$row->id.', \'notif\')">
                                <i class="ph-bell"></i>
                            </button> 
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-icon tooltiped" title="Ubah Harga" onclick="set_('.$row->id.', \'price\')">
                                <i class="ph-tag"></i>
                            </button> ';
                }
                                
                if(auth()->user()->can('inventory-stock-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }
        return view('modules.inventory_stock.index')
                ->with([
                    'title' => 'Stock Inventory'
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
        $data = InventoryStock::with(['product'])->find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus stock produk <strong>'.$data->product->code.' - '.$data->product->name.'</strong> ?<br>Penghapusan ini tidak akan mempengaruhi pada data pembelian.',
            'permission' => 'Y'
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = InventoryStock::with(['product'])->find($id);
        $res = [
            'msg_title' => 'Atur Pengingat Minimum Quantity',
            'msg_body' => '<strong>'.$data->product->code.' - '.$data->product->name.'</strong>',
            'permission' => 'Y'
        ];
        return response()->json($res, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = InventoryStock::with(['product'])->find($id);
        if($request->_set == 'notif'){
            $data->min_stock_reminder = $request->_value;
            $msg = 'Pengingat quantity stock produk <strong>'.$data->product->code.' - '.$data->product->name.'</strong> sudah diatur menjadi '.$request->_value;
        }else{
            $data->price = $request->_value;
            $msg = 'Harga jual stock produk <strong>'.$data->product->code.' - '.$data->product->name.'</strong> sudah diatur menjadi '.number_format($request->_value);
        }
        $data->save();

        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => $msg,
        ];
        return response()->json($res, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = InventoryStock::with(['product'])->find($id);
        $data->delete();
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Stock produk <strong>'.$data->product->code.' - '.$data->product->name.'</strong> sudah dihapus'
        ];
        return response()->json($res, 200);
    }
}
