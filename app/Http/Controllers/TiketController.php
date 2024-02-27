<?php

namespace App\Http\Controllers;

use App\Models\TicketSerials;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Tickets;
use App\Http\Requests\TiketRequest;

class TiketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:tiket-list|tiket-create|tiket-edit|tiket-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:tiket-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:tiket-edit|tiket-create'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:tiket-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tickets::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('tiket-edit')){
                    $status = '';
                    if($row->status == 'selesai'){
                        $status = 'disabled';
                    }
                    $btn .= '<a href="'.route('tiket.data.edit', $row->id).'" class="btn '.$status.' btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                                
                if(auth()->user()->can('tiket-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->addColumn('a_code', function ($row){
                return '<a href="'.route('tiket.data.detail', $row->id).'" class="tooltiped" title="Lihat Detail">'.$row->code.'</a>';
            })->rawColumns(['actions', 'a_code'])
            ->make(true);
        }
        return view('modules.ticketing.index')
                ->with([
                    'title' => 'Batch Ticketing'
                ]);
    }

    public function detail(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = TicketSerials::where('ticket_id', $id)->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }

        $data = Tickets::findOrFail($id);
        return view('modules.ticketing.detail')
                ->with([
                    'title' => 'Detail Tiket #'.$data->code,
                    'data' => $data,
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.ticketing.create')
                ->with([
                    'title' => 'Buat Tiket Batch Baru'
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiketRequest $request)
    {
        $tanggal = explode(' - ', $request->tanggal);
        try {
            DB::beginTransaction();
                $header = Tickets::create([
                    'code' => Tickets::generateUniqueCode(),
                    'description' => $request->description,
                    'valid_from' => $tanggal[0],
                    'valid_to' => $tanggal[1],
                    'quantity' => $request->quantity,
                    'category' => $request->category,
                    'status' => 'aktif',
                    'price' => $request->price,
                    'created_by' => auth()->user()->id,
                ]);

                for ($i = 1; $i <= $header->quantity; $i++) {
                    TicketSerials::create([
                        'ticket_id' => $header->id,
                        'serial_number' => TicketSerials::generateUniqueCode($header->id),
                        'price' => $header->price,
                        'status' => 'aktif',
                    ]);
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
            'msg_body' => 'Tiket baru berhasil disimpan. Nomor tiket #'.$header->code
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Tickets::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus tiket '.$data->code.' ?',
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Tickets::find($id);
        return view('modules.ticketing.edit')
                ->with([
                    'title' => 'Edit Tiket Batch #'.$data->code,
                    'data' => $data
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TiketRequest $request, string $id)
    {
        $tanggal = explode(' - ', $request->tanggal);
        try {
            DB::beginTransaction();
                $data = Tickets::find($id);
                $data->description = $request->description;
                $data->valid_from = $tanggal[0];
                $data->valid_to = $tanggal[1];
                $data->category = $request->category;
                $data->status = $request->status;
                $data->price = $request->price;
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
            'msg_body' => 'Perubahan tiket #'.$data->code.' berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Tickets::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Tiket dengan kode #'.$data->code.' telah dihapus.',
        ];
        TicketSerials::where('ticket_id', $id)->delete();
        $data->delete();
        return response()->json($res,200);
    }
}
