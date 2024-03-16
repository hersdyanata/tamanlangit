<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategories;
use App\Models\Articles;
use App\Http\Requests\ArticleRequest;
use DB;
use DataTables;
use Illuminate\Support\Str;

class CmsArtikelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:cms-blog-artikel-list|cms-blog-artikel-create|cms-blog-artikel-edit|cms-blog-artikel-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:cms-blog-artikel-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:cms-blog-artikel-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:cms-blog-artikel-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Articles::whereNotIn('category_id', [1,3,4])->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('category', function ($row) {
                return $row->category->title;
            })
            ->addColumn('content_', function ($row) {
                return strlen($row->content) > 100 ? substr($row->content, 0, 100) . '...' : $row->content;;
            })
            ->addColumn('creator', function ($row) {
                return $row->creator->name;
            })
            ->addColumn('actions', function ($row){
                $btn = '';
                if(auth()->user()->can('inventory-produk-edit')){
                    $btn .= '<a href="'.route('cms.artikel.edit', $row->id).'" class="btn btn-sm btn-outline-success btn-icon tooltiped" title="Edit">
                                <i class="ph-note-pencil"></i>
                            </a> ';
                }
                                
                if(auth()->user()->can('inventory-produk-delete')){
                    $btn .= '<button type="button" class="btn btn-sm btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                <i class="ph-trash"></i>
                            </button>';
                }

                return $btn;
            })->rawColumns(['actions'])
            ->make(true);
        }

        return view('modules.cms_artikel.index')
                ->with([
                    'title' => 'Artikel'
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.cms_artikel.create')
                ->with([
                    'title' => 'Buat Artikel Baru',
                    'categories' => ArticleCategories::whereNotIn('id', [1,3,4])->get()
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        try {
            DB::beginTransaction();
                Articles::create([
                    'title' => $request->title,
                    'category_id' => $request->category_id,
                    'content' => $request->content,
                    'status' => $request->status,
                    // 'tags' => $request->tags,
                    'keywords' => $request->keywords,
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
            'msg_body' => 'Artikel baru berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Articles::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus artikel '.$data->title.'?',
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Articles::find($id);
        return view('modules.cms_artikel.edit')
                ->with([
                    'title' => 'Edit Artikel '. $data->title,
                    'categories' => ArticleCategories::whereNotIn('id', [1,3,4])->get(),
                    'artikel' => $data
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $put = Articles::find($id);
                $put->title = $request->title;
                $put->category_id = $request->category_id;
                $put->content = $request->content;
                $put->status = $request->status;
                // $put->tags = $request->tags;
                $put->keywords = $request->keywords;
                $put->updated_by = auth()->user()->id;
                $put->url = Str::slug($request->title);
                $put->save();
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
            'msg_body' => 'Perubahan artikel berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Articles::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Artikel '.$data->title.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);   
    }
}
