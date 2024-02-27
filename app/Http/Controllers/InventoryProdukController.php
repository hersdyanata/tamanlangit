<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories;
use App\Models\Products;
use App\Http\Requests\ProductRequest;
use DB;
use DataTables;

class InventoryProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:inventory-produk-list|inventory-produk-create|inventory-produk-edit|inventory-produk-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:inventory-produk-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:inventory-produk-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:inventory-produk-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::with(['category'])->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('inventory-produk-edit')){
                    $btn .= '<a href="'.route('inventory.produk.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                                
                if(auth()->user()->can('inventory-produk-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }
        return view('modules.inventory_produk.index')
                ->with([
                    'title' => 'Produk'
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.inventory_produk.create')
                ->with([
                    'title' => 'Buat Produk Baru',
                    'categories' => ProductCategories::all()
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
                Products::create([
                    'code' => Products::generateUniqueCode(),
                    'name' => $request->name,
                    'inventory_type' => $request->inventory_type,
                    'category_id' => $request->category_id,
                    'created_by' => auth()->user()->id,
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
            'msg_body' => 'Produk baru berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Products::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus produk '.$data->name.'?',
        ];
        return response()->json($res, 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Products::find($id);
        return view('modules.inventory_produk.edit')
                ->with([
                    'title' => 'Edit Produk '.$data->name,
                    'produk' => $data,
                    'categories' => ProductCategories::all()
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $produk = Products::find($id);
                $produk->name = $request->name;
                $produk->inventory_type = $request->inventory_type;
                $produk->category_id = $request->category_id;
                $produk->updated_by = auth()->user()->id;
                $produk->save();
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
            'msg_body' => 'Perubahan produk berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Products::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Produk '.$data->name.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);
    }
}
