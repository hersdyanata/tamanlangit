<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use DataTables;
use DB;
use Illuminate\Support\Facades\Artisan;

use App\Http\Requests\UsergroupRequest;


class UsergroupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Role::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('a_name', function ($row) {
                        return '<a href="'.route('acl.usergroup.detail', $row->id).'" class="tooltiped" title="Lihat Detail">'.$row->name.'</a>';
                    })
                    ->addColumn('granted_user', function ($row){
                        return $this->count_user_has_role($row->id);
                    })
                    ->addColumn('count_permission', function ($row){
                        return $row->permissions->count();
                    })
                    ->addColumn('actions', function ($row){
                        $btn = '';
                        if(auth()->user()->can('role-edit')){
                            $btn .= '<a href="'.route('acl.usergroup.edit', $row->id).'" class="btn btn-outline-success btn-icon tooltiped" title="Edit">
                                        <i class="ph-note-pencil"></i>
                                    </a> ';
                        }
                        
                        if(auth()->user()->can('role-delete')){
                            $btn .= '<button type="button" class="btn btn-outline-danger btn-icon tooltiped" title="Hapus" onclick="preaction('.$row->id.')">
                                        <i class="ph-trash"></i>
                                    </button>';
                        }

                        return $btn;
                    })->rawColumns(['actions', 'a_name'])
                    ->make(true);
        }
        return view('modules.acl_usergroup.index')
                ->with([
                    'title' => 'Data Role'
                ]);
    }

    public function count_user_has_role($role_id){
        return DB::table('model_has_roles')
                ->where('role_id', $role_id)
                ->count();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.acl_usergroup.create')
        ->with([
            'title'=> 'Buat Role Baru',
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserGroupRequest $request)
    {
        try {
            DB::beginTransaction();
                $role = Role::create(['name' => $request->name]);
                $role->syncPermissions($request->permissions);
                Artisan::call('optimize:clear');
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

    public function detail($id){
        $role = Role::find($id);
        $permissions = $role->permissions;
        $user = User::role($role->name)->get();
        
        return view('modules.acl_usergroup.detail')
                ->with([
                    'title' => 'Daftar Permission '.$role->name,
                    'role' => $role,
                    'permissions' => $permissions,
                    'users' => $user,
                ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hasRole = $this->count_user_has_role($id);
        $role = Role::find($id);

        if($hasRole > 0){
            $res = [
                'msg_title' => 'Gagal',
                'msg_body' => 'Role <strong>'.$role->name.'</strong> tidak dapat dihapus karena terhubung ke '.$hasRole.' pengguna',
                'permission' => 'F'
            ];
        }else{
            $res = [
                'msg_title' => 'Konfirmasi',
                'msg_body' => 'Apakah Anda yakin akan menghapus role '.$role->name.' ?',
                'permission' => 'Y'
            ];
        }

        return response()->json($res, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        return view('modules.acl_usergroup.edit')
        ->with([
            'title'=> 'Edit Role '.$role->name,
            'role' => $role,
            'role_permissions' => $role->permissions->pluck('name')->toArray(),
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
                $role = Role::find($id);
                $role->name = $request->name;
                $role->save();
                $role->syncPermissions($request->permissions);
                Artisan::call('optimize:clear');
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
        $role = Role::find($id);
        foreach($role->permissions as $p){
            $role->revokePermissionTo($p->name);
        }
        $res = [
            'msg_title' => 'Berhasil',
            'msg_body' => 'Role '.$role->name.' telah dihapus.',
        ];
        $role->delete();
        return response()->json($res, 200);
    }
}
