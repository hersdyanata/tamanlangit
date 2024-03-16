<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategories;
use DB;
use DataTables;
use App\Http\Requests\ArticleCategoryRequest;
use Illuminate\Support\Str;

class CmsKategoriController extends Controller
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
            $data = ArticleCategories::whereNotIn('id', [1,3,4])->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('cms-blog-kategori-edit')){
                    $btn .= '<a href="'.route('cms.kategori-artikel.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                                
                if(auth()->user()->can('cms-blog-kategori-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }

        return view('modules.cms_kategori.index')
                ->with([
                    'title' => 'Kategori Artikel'
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.cms_kategori.create')
                ->with([
                    'title' => 'Buat Kategori Artikel Baru',
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
                ArticleCategories::create([
                    'title' => $request->title,
                    'url' => Str::slug($request->title), //str_replace(' ', '-', strtolower($request->title)),
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
        $data = ArticleCategories::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus kategori artikel '.$data->title.'?',
        ];
        return response()->json($res, 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ArticleCategories::find($id);
        return view('modules.cms_kategori.edit')
                ->with([
                    'title' => 'Edit Kategori Artikel '.$data->name,
                    'kategori' => $data
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleCategoryRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $kategori = ArticleCategories::find($id);
                $kategori->title = $request->title;
                $kategori->url = Str::slug($request->title); //str_replace(' ', '-', strtolower($request->title));
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
            'msg_body' => 'Perubahan kategori artikel berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ArticleCategories::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Kategori artikel '.$data->name.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);    
    }
}
