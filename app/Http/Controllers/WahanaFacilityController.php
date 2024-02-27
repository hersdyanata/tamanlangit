<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WahanaFacility;
use DataTables;
use DB;

class WahanaFacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:wahana-list|wahana-create|wahana-edit|wahana-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:wahana-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:wahana-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:wahana-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        if ($request->ajax()) {
            $data = WahanaFacility::where('wahana_id', $request->id)->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('wahana-edit')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit" onclick="edit_facility('.$row->id.')">
                                <i class="ph-note-pencil"></i>
                            </button> ';
                }
                                
                if(auth()->user()->can('wahana-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="hapus_facility('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }
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
        try {
            DB::beginTransaction();
                WahanaFacility::create([
                    'wahana_id' => $request->wahana_id,
                    'name' => $request->facility_name
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
            'msg_body' => 'fasilitas baru berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = WahanaFacility::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus fasilitas '.$data->name.'?',
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return WahanaFacility::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
                $facility = WahanaFacility::find($id);
                $facility->name = $request->facility_name;
                $facility->save();
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
            'msg_body' => 'Perubahan fasilitas '.$facility->name.' berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facility = WahanaFacility::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Fasilitas '.$facility->name.' telah dihapus.',
        ];
        $facility->delete();
        return response()->json($res,200);  
    }
}
