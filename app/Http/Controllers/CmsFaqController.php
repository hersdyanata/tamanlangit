<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\FAQ;
Use App\Http\Requests\FaqRequest;

class CmsFaqController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:cms-faq-list|cms-faq-create|cms-faq-edit|cms-faq-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:cms-faq-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:cms-faq-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:cms-faq-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.cms_faq.index')
                ->with([
                    'title' => 'Frequent Asked Questions',
                    'faqs' => FAQ::all()
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.cms_faq.create')
                ->with([
                    'title' => 'Buat FAQ Baru'
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        try {
            DB::beginTransaction();
                FAQ::create([
                    'question' => $request->question,
                    'answer' => $request->answer,
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
            'msg_body' => 'Data berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = FAQ::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus FAQ <strong>'.$data->question.'</strong> ?',
            'permission' => 'Y'
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = FAQ::find($id);
        return view('modules.cms_faq.edit')
                ->with([
                    'title' => 'Edit FAQ',
                    'faq' => $faq
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $faq = FAQ::find($id);
                $faq->question = $request->question;
                $faq->answer = $request->answer;
                $faq->save();
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
            'msg_body' => 'Perubahan FAQ berhasil disimpan'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = FAQ::find($id);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'FAQ '.$faq->question.' telah dihapus.',
        ];
        $faq->delete();
        return response()->json($res,200);   
    }
}
