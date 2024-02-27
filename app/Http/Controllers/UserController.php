<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:user-list|user-create|user-edit|user-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:user-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = User::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('granted_role', function ($row){
                        return $row->roles->pluck('name')[0];
                    })
                    ->addColumn('actions', function ($row){
                        $btn = '';
                        if(auth()->user()->can('user-edit')){
                            $btn .= '<a href="'.route('acl.user.edit', $row->id).'" class="btn btn-outline-success btn-icon tooltiped" title="Edit">
                                        <i class="ph-note-pencil"></i>
                                    </a> ';
                        }
                        
                        if(auth()->user()->can('user-delete')){
                            $btn .= '<button type="button" class="btn btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                        <i class="ph-trash"></i>
                                    </button>';
                        }

                        return $btn;
                    })->rawColumns(['actions'])
                    ->make(true);
        }
        return view('modules.acl_user.index')
                ->with([
                    'title' => 'Data Pengguna',
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.acl_user.create')
                ->with([
                    'title' => 'Buat Pengguna Baru',
                    'roles' => Role::all()
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
                $new_user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);

                $new_user->assignRole($request->role);
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
    public function show($id){
        $data = User::find($id);
        $res = [
            'msg_title' => 'Konfirmasi',
            'msg_body' => 'Apakah Anda yakin akan menghapus user '.$data->name.' ?',
            'permission' => 'Y'
        ];
        return response()->json($res, 200);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Data Pengguna';
        return view('modules.acl_user.edit')
                ->with([
                    'title' => $title,
                    'roles' => Role::all(),
                    'old' => User::find($id),
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
                $put = User::find($id);
                $put->name = $request->name;
                $put->email = $request->email;
                $put->save();

                $put->removeRole($put->roles->pluck('name')[0]);
                $put->assignRole($request->role);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->removeRole($data->roles->pluck('name')[0]);
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'User '.$data->name.' telah dihapus.',
        ];
        $data->delete();
        return response()->json($res,200);    
    }
}
