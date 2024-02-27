<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wahana;
use App\Models\WahanaRoom;
use App\Models\WahanaFacility;
use App\Models\WahanaImage;
use DataTables;
use DB;

class WahanaController extends Controller
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
            $data = Wahana::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('wahana-edit')){
                    $btn .= '<a href="'.route('wahana.paket.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                
                if(auth()->user()->can('wahana-create')){
                    $btn .= '<a href="'.route('wahana.paket.images', $row->id).'" class="btn btn-sm btn-outline-primary btn-icon tooltiped" title="Upload Gambar">
                                <i class="ph-image"></i>
                            </a> ';
                }
                
                if(auth()->user()->can('wahana-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }

        return view('modules.wahana_paket.index')
                ->with([
                    'title' => 'Paket Wahana',
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.wahana_paket.create')
                ->with([
                    'title' => 'Buat Wahana Baru'
                ]);
    }

    public function images($id)
    {
        $wahana = Wahana::find($id);
        return view('modules.wahana_paket.images')
                ->with([
                    'title' => 'Gambar Wahana '.ucwords(strtolower($wahana->name)),
                    'wahana' => $wahana
                ]);
    }

    public function upload(Request $request, string $id){
        $path = 'assets/images/wahana';
        $file = $request->file('file');
        
        $pattern = '/\s+/';
        $fileName = date("Ymd"). '_' . preg_replace($pattern, '_', $file->getClientOriginalName());
        $file->move(public_path($path), $fileName);

        WahanaImage::create([
            'wahana_id' => $id,
            'image_path' => $path.'/'.$fileName,
        ]);

        return response()->json(['title' => 'success']);

        // $image = $request->file('file');
        // $imageName = time() . '.' . $image->extension();
        // $imagePath = 'assets/images/wahana/' . $imageName;

        // Image::make($image)
        //     ->encode($image->extension(), 70) // 70 is the quality
        //     ->save(public_path($imagePath));

        // return response()->json(['success' => $imageName]);
    }

    public function load_existing_images(Request $request, string $id){
        $data = WahanaImage::where('wahana_id', $id)->get();
        $view = view('modules.wahana_paket.thumbnails')
                ->with(['images' => $data])->render();

        return response()->json([
            'code' => 200,
            'images'=> $view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rooms = array();
        $facilities = array();
        try {
            DB::beginTransaction();
                $wahana = Wahana::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'max_person' => $request->max_person,
                    'room_wide' => $request->room_wide,
                    'room_available' => $request->room_available,
                    'user_choose_room' => (isset($request->user_choose_room)) ? 'Y' : 'N',
                    'room_name' => $request->room_name,
                    'price' => $request->price,
                    'url' => str_replace(' ', '-', strtolower($request->name))
                ]);

                for($i = 1; $i <= $wahana->room_available; $i++){
                    $rooms[] = [
                        'wahana_id' => $wahana->id,
                        'name' => $wahana->room_name.'_'.$i,
                        'status' => 'A'
                    ];
                }

                WahanaRoom::insert($rooms);

                foreach($request['fasilitas'] as $v){
                    $facilities[] = [
                        'wahana_id' => $wahana->id,
                        'name' => $v
                    ];
                }
                WahanaFacility::insert($facilities);
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
            'msg_body' => 'Data paket wahana berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Wahana::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus wahana '.$data->name.' ?',
            'permission' => 'Y'
        ];
        return response()->json($res, 200);
    }

    public function show_image(string $id)
    {
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus gambar ini ?',
            'permission' => 'Y'
        ];
        return response()->json($res, 200);
    }

    public function destroy_image(string $id)
    {
        $image = WahanaImage::find($id);
        if(file_exists($image->image_path)){
            if (unlink($image->image_path)) {
                $message = 'File berhasil dihapus';
            } else {
                $message = 'File gagal dihapus! Periksa permission folder.';
            }
        }
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => $message,
        ];
        $image->delete();
        return response()->json($res,200);    
    }

    public function load_facility(string $id)
    {
        $facilities = WahanaFacility::where('wahana_id', $id)->get();
        return response()->json($facilities,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Wahana::find($id);
        return view('modules.wahana_paket.edit')
                ->with([
                    'title' => 'Edit Wahana '.$data->name,
                    'wahana' => $data
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
                $wahana = Wahana::find($id);
                $wahana->name = $request->name;
                $wahana->description = $request->description;
                $wahana->max_person = $request->max_person;
                $wahana->room_wide = $request->room_wide;
                $wahana->room_available = $request->room_available;
                $wahana->user_choose_room = (isset($request->user_choose_room)) ? 'Y' : 'N';
                $wahana->price = $request->price;
                $wahana->url = str_replace(' ', '-', strtolower($request->name));
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
            'msg_body' => 'Data paket wahana berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wahana = Wahana::find($id);
        WahanaRoom::where('wahana_id', $wahana->id)->delete();
        WahanaFacility::where('wahana_id', $wahana->id)->delete();
        WahanaImage::where('wahana_id', $wahana->id)->delete();
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Wahana '.$wahana->name.' telah dihapus.',
        ];
        $wahana->delete();
        return response()->json($res,200);    
    }
}
