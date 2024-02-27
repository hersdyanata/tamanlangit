<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventOrganizer;
use DataTables;
use App\Http\Requests\EventOrganizerRequest;
use DB;

class EventOrganizerController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:eo-list|eo-create|eo-edit|eo-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:eo-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:eo-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:eo-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EventOrganizer::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('eo-edit')){
                    $btn .= '<a href="'.route('wahana.eo.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                                
                if(auth()->user()->can('eo-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }
        return view('modules.wahana_eo.index')
                ->with([
                    'title' => 'Event Organizer'
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.wahana_eo.create')
                ->with([
                    'title' => 'Buat EO Baru',
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventOrganizerRequest $request)
    {
        try {
            DB::beginTransaction();
                EventOrganizer::create([
                    'name' => $request->name,
                    'commission' => $request->commission,
                    'commission_type' => $request->commission_type,
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
            'msg_body' => 'EO baru berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = EventOrganizer::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus EO '.$data->name.'?',
        ];
        return response()->json($res, 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = EventOrganizer::find($id);
        return view('modules.wahana_eo.edit')
                ->with([
                    'title' => 'Edit EO '.$data->name,
                    'data' => $data,
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventOrganizerRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $data = EventOrganizer::find($id);
                $data->name = $request->name;
                $data->commission = $request->commission;
                $data->commission_type = $request->commission_type;
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
            'msg_body' => 'Perubahan EO berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EventOrganizer::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'EO '.$data->name.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);    
    }
}
