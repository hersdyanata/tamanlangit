<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Http\Requests\SupplierRequest;
use DB;
use DataTables;

class InventorySupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:inventory-supplier-list|inventory-supplier-create|inventory-supplier-edit|inventory-supplier-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:inventory-supplier-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:inventory-supplier-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:inventory-supplier-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Suppliers::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('inventory-supplier-edit')){
                    $btn .= '<a href="'.route('inventory.supplier.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                                
                if(auth()->user()->can('inventory-supplier-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }
        return view('modules.inventory_supplier.index')
                ->with([
                    'title' => 'Supplier'
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.inventory_supplier.create')
                ->with([
                    'title' => 'Buat Supplier Baru',
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        try {
            DB::beginTransaction();
                Suppliers::create([
                    'name' => $request->name,
                    'pic_name' => $request->pic_name,
                    'phone_number' => $request->phone_number,
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
            'msg_body' => 'Supplier baru berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Suppliers::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus supplier '.$data->name.'?',
        ];
        return response()->json($res, 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Suppliers::find($id);
        return view('modules.inventory_supplier.edit')
                ->with([
                    'title' => 'Edit Supplier '.$data->name,
                    'supplier' => $data,
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $data = Suppliers::find($id);
                $data->name = $request->name;
                $data->pic_name = $request->pic_name;
                $data->phone_number = $request->phone_number;
                $data->updated_by = auth()->user()->id;
                $data->save();
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
            'msg_body' => 'Perubahan Supplier berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Suppliers::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Supplier '.$data->name.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);    
    }
}
