<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use DB;

class CmsKontakController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.cms_kontak.index')
                ->with([
                    'title' => 'Kontak',
                    'kontak' => Contacts::first()
                ]);
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
                Contacts::query()->update([
                    'phone_number' => $request->phone_number,
                    'mobile_number' => $request->mobile_number,
                    'email' => $request->email,
                    'facebook_url' => $request->facebook_url,
                    'instagram_url' => $request->instagram_url,
                    'youtube_url' => $request->youtube_url,
                    'pinterest_url' => $request->pinterest_url,
                    'tiktok_url' => $request->tiktok_url,
                    'twitter_url' => $request->twitter_url,
                ]);
                
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();
            
            return response()->json([
                'msg_title' => 'Gagal',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
