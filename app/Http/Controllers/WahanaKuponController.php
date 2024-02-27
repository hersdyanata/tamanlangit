<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupons;
use App\Models\CouponWahana;
use App\Models\Wahana;
use DataTables;
use DB;

use App\Http\Requests\CouponRequest;

class WahanaKuponController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:kupon-list|kupon-create|kupon-edit|kupon-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:kupon-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:kupon-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:kupon-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Coupons::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('qty_balance', function ($row) {
                return $row->balance.' / '.$row->quantity;
            })->addColumn('validity', function ($row) {
                $valid_for = '';
                if($row->valid_for == 'online'){
                    $valid_for = 'Online';
                }elseif($row->valid_for == 'onsite'){
                    $valid_for = 'OnSite';
                }else{
                    $valid_for = 'Online & OnSite';
                }

                return $valid_for;
            })->addColumn('discount_', function($row){
                return ($row->discount_type == 'persentase') ? $row->discount.'%' : 'IDR '.number_format($row->discount,0,'.');
            })
            ->addColumn('periode', function($row){
                return date('Y.m.d', strtotime($row->start_date)).' - '.date('Y.m.d', strtotime($row->end_date));
            })
            ->addColumn('wahana', function($row){
                $wahana = '';
                foreach($row->wahanas as $r){
                    $wahana .= '- '.ucwords(strtolower($r->wahana->name)).'<br>';
                }

                return $wahana;
            })
            ->addColumn('disp_status', function($row){
                $status = '';
                if($row->status == 'A'){
                    $status = '<span class="badge bg-success text-success bg-opacity-20">Aktif</span>';
                }elseif($row->status == 'NA'){
                    $status = '<span class="badge bg-danger text-danger bg-opacity-20">Tidak Aktif</span>';
                }else{
                    $status = '<span class="badge bg-warning text-warning bg-opacity-20">Kadaluarsa</span>';
                }

                return $status;
            })
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('kupon-edit')){
                    $btn .= '<a href="'.route('wahana.kupon.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                
                if(auth()->user()->can('kupon-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions', 'wahana', 'periode', 'disp_status'])
            ->make(true);
        }

        return view('modules.wahana_kupon.index')
                ->with([
                    'title' => 'Kupon'
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.wahana_kupon.create')
                ->with([
                    'title' => 'Buat Kupon Baru',
                    'wahanas' => Wahana::get(),
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        try {
            $daterange = explode(' - ', $request->periode);
            DB::beginTransaction();
                $kupon = Coupons::create([
                    'code' => $request->code,
                    'description' => $request->description,
                    'start_date' => $daterange[0],
                    'end_date' => $daterange[1],
                    'quantity' => $request->quantity,
                    'balance' => $request->quantity,
                    'discount_type' => $request->discount_type,
                    'discount' => $request->discount,
                    'valid_for' => $request->valid_for,
                    'created_by' => auth()->user()->id,
                ]);

                $wahana = $request->wahana;
                $for_wahana = array();
                for($i = 0; $i < count($wahana); $i++){
                    $for_wahana[] = [
                        'coupon_id' => $kupon->id,
                        'wahana_id' => $wahana[$i],                        
                    ];
                }

                CouponWahana::insert($for_wahana);
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
            'msg_body' => 'Data kupon berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Coupons::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus kupon '.$data->code.'?',
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kupon = Coupons::with('wahanas')->find($id);
        return view('modules.wahana_kupon.edit')
                ->with([
                    'title' => 'Edit Kupon '.$kupon->code,
                    'wahanas' => Wahana::get(),
                    'kupon' => $kupon,
                    'kupon_wahana' => $kupon->wahanas
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, string $id)
    {
        try {
            $daterange = explode(' - ', $request->periode);
            DB::beginTransaction();
                $kupon = Coupons::find($id);
                $kupon->code = $request->code;
                $kupon->description = $request->description;
                $kupon->start_date = $daterange[0];
                $kupon->end_date = $daterange[1];
                $kupon->quantity = $request->quantity;
                $kupon->balance = $request->quantity;
                $kupon->discount_type = $request->discount_type;
                $kupon->discount = $request->discount;
                $kupon->valid_for = $request->valid_for;
                $kupon->updated_by = auth()->user()->id;
                $kupon->save();

                $wahana = $request->wahana;
                $for_wahana = array();
                for($i = 0; $i < count($wahana); $i++){
                    $for_wahana[] = [
                        'coupon_id' => $kupon->id,
                        'wahana_id' => $wahana[$i],                        
                    ];
                }

                CouponWahana::where('coupon_id', $id)->delete();
                CouponWahana::insert($for_wahana);
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
            'msg_body' => 'Data kupon '.$kupon->code.' berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kupon = Coupons::find($id);
        CouponWahana::where('coupon_id', $id)->delete();
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Kupon '.$kupon->code.' telah dihapus.',
        ];
        $kupon->delete();
        return response()->json($res,200);     
    }
}
