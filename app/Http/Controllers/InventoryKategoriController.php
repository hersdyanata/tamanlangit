<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories;
use DB;
use DataTables;
use App\Http\Requests\ProductCategoryRequest;

class InventoryKategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:inventory-kategori-list|inventory-kategori-create|inventory-kategori-edit|inventory-kategori-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:inventory-kategori-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:inventory-kategori-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:inventory-kategori-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductCategories::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('inventory-kategori-edit')){
                    $btn .= '<a href="'.route('inventory.kategori-produk.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                                
                if(auth()->user()->can('inventory-kategori-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }

        return view('modules.inventory_kategori.index')
                ->with([
                    'title' => 'Produk'
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.inventory_kategori.create')
                ->with([
                    'title' => 'Buat Kategori Baru',
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
                ProductCategories::create([
                    'name' => $request->name,
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
            'msg_body' => 'Kategori baru berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ProductCategories::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus kategori produk '.$data->name.'?',
        ];
        return response()->json($res, 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ProductCategories::find($id);
        return view('modules.inventory_kategori.edit')
                ->with([
                    'title' => 'Edit Kategori Produk '.$data->name,
                    'kategori' => $data
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $kategori = ProductCategories::find($id);
                $kategori->name = $request->name;
                $kategori->updated_by = auth()->user()->id;
                $kategori->save();
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
            'msg_body' => 'Perubahan kategori produk berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = ProductCategories::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Kategori produk '.$kategori->name.' telah dihapus.',
        ];
        $kategori->delete();
        return response()->json($res,200);    
    }
}
