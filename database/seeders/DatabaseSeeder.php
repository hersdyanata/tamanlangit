<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private $permissions = [
        'user-list',
        'user-create',
        'user-edit',
        'user-delete'
    ];
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(MenuItemSeeder::class);
        // foreach ($this->permissions as $permission) {
        //     Permission::create(['name' => $permission]);
        // }

        $user = User::find(1104);
        $role = Role::findByName('Editor');
        // $permissions = Permission::pluck('id', 'id')->all();
        // $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
