<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;

class CmsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:cms-list|cms-create|cms-edit|cms-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:cms-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:cms-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:cms-delete'], ['only' => ['destroy']]);
    }

    public function profile()
    {
        return view('modules.cms.editor')
                ->with([
                    'title' => 'Profile Perusahaan',
                    'cms' => Articles::find(1),
                ]);
    }

    public function syarat_ketentuan()
    {
        return view('modules.cms.editor')
                ->with([
                    'title' => 'Syarat & Ketentuan',
                    'cms' => Articles::find(2),
                ]);
    }

    public function privacy_policy()
    {
        return view('modules.cms.editor')
                ->with([
                    'title' => 'Kebijakan Privasi',
                    'cms' => Articles::find(3),
                ]);
    }

    public function update(Request $request, string $id)
    {
        $cms = Articles::find($id);
        $cms->title = $request->title;
        $cms->content = $request->content;
        $cms->save();

        return response()->json([
            'msg_title' => 'Berhasil',
            'msg_body' => 'Konten '.$request->title.' berhasil disimpan',
        ], 200);
    }
}
