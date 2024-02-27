<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleGrantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = User::find(1);
        $roleAdministrator = Role::findByName('Administrator');
        $permissionsAdministrator = Permission::pluck('id', 'id')->all();
        $roleAdministrator->syncPermissions($permissionsAdministrator);
        $administrator->assignRole([$roleAdministrator->id]);

        $editor = User::find(1104);
        $roleEditor = Role::findByName('Editor CMS');
        $permissionEditor = Permission::pluck('id', 'id')->all();
        $roleEditor->syncPermissions($permissionEditor);
        $editor->assignRole([$roleEditor->id]);
    }
}
