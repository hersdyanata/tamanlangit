<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WahanaRoom;
use App\Models\Wahana;
use DataTables;
use DB;

class WahanaRoomController extends Controller
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
            $data = WahanaRoom::where('wahana_id', $request->id)->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('wahana-edit')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Ubah Status" onclick="ubah_status_room('.$row->id.')">
                                <i class="ph-eye"></i>
                            </button> ';
                }
                                
                if(auth()->user()->can('wahana-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="hapus_room('.$row->id.')">
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
                $maxCurrentRooms = WahanaRoom::where('wahana_id', $request->wahana_id)
                                    ->max(DB::raw('cast(replace(name, substring(name, 1, 3), "") as signed)'));

                $rooms = array();
                for($i = ($maxCurrentRooms + 1); $i <= ($maxCurrentRooms + $request->new_rooms); $i++){
                    $rooms[] = array(
                        'wahana_id' => $request->wahana_id,
                        'name' => $request->room_name.'_'.$i,
                        'status' => 'A'
                    );
                }

                // dd($rooms);

                WahanaRoom::insert($rooms);
                $wahana = Wahana::find($request->wahana_id);
                $wahana->room_available = $maxCurrentRooms + $request->new_rooms;
                $wahana->save();
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
            'msg_body' => 'Penambahan kamar sudah disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Setelah ada transaksi ini harus di validasi dulu boleh atau tidak melakukan penghapusan.
        $data = WahanaRoom::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus kamar/tenda '.$data->name.'?',
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = WahanaRoom::find($id);
        if($room->status == 'RV'){
            $res = [
                'msg_title' => 'Perubahan Tidak Bisa Dilanjutkan!',
                'msg_body' => 'Status kamar/tenda <strong>'.$room->name.'</strong> sedang <span class="badge bg-primary text-primary bg-opacity-20">Booked</span>',
                'permission' => 'F'
            ];            
        }else{
            $res = [
                'msg_title' => 'Ubah Status Kamar/Tenda',
                'msg_body' => 'Silahkan pilih status untuk kamar/tenda '.$room->name.'?',
                'permission' => 'Y'
            ];
        }
        return response()->json($res, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
                $room = WahanaRoom::find($id);
                $room->status = $request->new_status;
                $room->save();
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
            'msg_body' => 'Perubahan status kamar '.$room->name.' berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = WahanaRoom::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Kamar/tenda '.$room->name.' telah dihapus.',
        ];
        $room->delete();
        return response()->json($res,200);  
    }
}
