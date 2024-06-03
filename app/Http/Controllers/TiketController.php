<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Tickets;
use App\Models\TicketSerials;
use App\Models\TicketCategories;
use App\Models\TicketDirect;
use App\Http\Requests\TiketRequest;
use App\Http\Requests\TiketDirectRequest;

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
            if($request->category == 'presale'){
                $data = Tickets::with(['category'])->get();
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
                        $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction_presale('.$row->id.')">
                                    <i class="ph-trash"></i>
                                </button>';
                    }
    
                    return $btn;
                })->addColumn('a_code', function ($row){
                    return '<a href="'.route('tiket.data.detail', $row->id).'" class="tooltiped" title="Lihat Detail">#'.$row->code.'</a>';
                })->rawColumns(['actions', 'a_code'])
                ->make(true);
            }else{
                $data = TicketDirect::with(['category_'])->get();
                return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row){
                    $btn = '';
                    if(auth()->user()->can('tiket-edit')){
                        $btn .= '<a href="'.route('tiket.data.edit_direct', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                    <i class="ph-note-pencil"></i>
                                </a> ';
                    }
                                    
                    if(auth()->user()->can('tiket-delete')){
                        $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction_direct('.$row->id.')">
                                    <i class="ph-trash"></i>
                                </button>';
                    }
    
                    return $btn;
                })->rawColumns(['actions'])
                ->make(true);
            }
        }

        return view('modules.ticketing.index')
                ->with([
                    'title' => 'Ticketing',
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

        $data = Tickets::with(['category'])->findOrFail($id);
        return view('modules.ticketing.detail')
                ->with([
                    'title' => 'Detail Tiket #'.$data->code,
                    'data' => $data,
                ]);
    }

    public function presale_print(Request $request)
    {

        $limit = $request->quantity;
        if($request->printMethod === 'partial'){
            $data = Tickets::with(['serials' => function($query) use ($limit) {
                $query->whereNull('print_date')->take($limit);
            }, 'category'])->find($request->id);
        }else{
            $data = Tickets::with(['serials' => function($query) use ($limit) {
                $query->whereNull('print_date');
            }, 'category'])->find($request->id);
        }

        return view('modules.ticketing.receipt_presale')
                ->with([
                    'title' => 'Tiket Presale Batch #'.$data->code,
                    'data' => $data
                ])->render();
    }

    public function presale_set_print_date(Request $request, $id){
        return TicketSerials::where('ticket_id', $id)
                ->whereIn('serial_number', $request->serials)
                ->update(['print_date' => now()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.ticketing.create')
                ->with([
                    'title' => 'Buat Tiket Pre-Sale Baru',
                    'categories' => TicketCategories::get(),
                ]);
    }

    public function create_direct(Request $request)
    {
        if ($request->ajax()) {
            $data = TicketCategories::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('wahana-edit')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Ubah Status" onclick="edit_category('.$row->id.')">
                                <i class="ph-eye"></i>
                            </button> ';
                }
                                
                if(auth()->user()->can('wahana-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="hapus_category('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }

        return view('modules.ticketing.create_direct')
                ->with([
                    'title' => 'Buat Tiket Direct Baru',
                ]);
    }

    public function edit_direct(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = TicketCategories::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('wahana-edit')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Ubah Status" onclick="edit_category('.$row->id.')">
                                <i class="ph-eye"></i>
                            </button> ';
                }
                                
                if(auth()->user()->can('wahana-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="hapus_category('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }

        $category = TicketDirect::find($id);
        return view('modules.ticketing.edit_direct')
                ->with([
                    'title' => 'Edit Tiket Direct '.$category->name,
                    'data' => $category,
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiketRequest $request)
    {
        try {
            DB::beginTransaction();
                $header = Tickets::create([
                    'code' => Tickets::generateUniqueCode(),
                    'description' => $request->description,
                    'quantity' => $request->quantity,
                    'category_id' => $request->category_id,
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

    public function store_direct(TiketDirectRequest $request)
    {
        try {
            DB::beginTransaction();
                TicketDirect::Create([
                    'category' => $request->category,
                    'price' => str_replace(',', '', $request->price),
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
            'msg_body' => 'Tiket baru berhasil disimpan.',
        ], 200);
    }

    public function update_direct(TiketDirectRequest $request, $id)
    {
        try {
            DB::beginTransaction();
                $data = TicketDirect::find($id);
                $data->category = $request->category;
                $data->price = $request->price;
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
            'msg_body' => 'Perubahan tiket direct sale berhasil disimpan.',
        ], 200);
    }

    public function get_categories()
    {
        $data = TicketCategories::get();
        return response()->json($data, 200);
    }

    public function edit_category($id)
    {
        $data = TicketCategories::find($id);
        return response()->json($data, 200);
    }
    
    public function store_category(Request $request)
    {
        try {
            DB::beginTransaction();
                TicketCategories::create([
                    'name' => $request->name,
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
            'msg_body' => 'Kategori tiket '.$request->name.' berhasil disimpan.',
        ], 200);
    }

    public function update_category(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
                $data = TicketCategories::find($id);
                $data->name = $request->name;
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

    public function show_category($id)
    {
        $data = TicketCategories::with(['ticketPresale', 'ticketDirect'])->find($id);
        if((isset($data->ticketPresale) && $data->ticketPresale->count() > 0) || (isset($data->ticketDirect) && $data->ticketDirect->count() > 0)){
            $res = [
                'permission' => 'F',
                'msg_title' => 'Gagal!',
                'msg_body' => 'Kategori tiket '.$data->name.' tidak bisa dihapus karena sudah memiliki tiket direct/presale',
            ];
        }else{
            $res = [
                'permission' => 'Y',
                'msg_title' => 'Berhasil!',
                'msg_body' => 'Apakah anda yakin akan menghapus kategori tiket '.$data->name.' ?',
            ];
        }
        return response()->json($res, 200);
    }

    public function destroy_category(string $id)
    {
        $data = TicketCategories::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Kategori tiket '.$data->name.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Tickets::with(['sales'])->find($id);
        
        if($data->sales->count() < 1){
            $res = [
                'permission' => 'T',
                'msg_title' => 'Konfirmasi',
                'msg_body' => 'Apakah Anda yakin akan menghapus tiket '.$data->code.' ?',
            ];
        }else{
            $res = [
                'permission' => 'F',
                'msg_title' => 'Gagal!',
                'msg_body' => 'Tiket presale '.$data->code.' tidak bisa dihapus karena sudah memiliki penjualan!',
            ];
        }
        return response()->json($res, 200);
    }

    public function show_direct(string $id)
    {
        $data = TicketDirect::with(['category_'])->find($id);
        $res = [
            'permission' => 'T',
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus tiket direct '.$data->category_->name.' ?',
        ];
        return response()->json($res, 200);
    }

    public function destroy_direct(string $id)
    {
        $data = TicketDirect::with(['category_'])->find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Tiket direct  '.$data->category_->name.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Tickets::find($id);
        return view('modules.ticketing.edit')
                ->with([
                    'title' => 'Edit Tiket Presale #'.$data->code,
                    'data' => $data,
                    'categories' => TicketCategories::get(),
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TiketRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $data = Tickets::find($id);
                $data->description = $request->description;
                $data->category_id = $request->category_id;
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
