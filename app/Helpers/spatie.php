<?php

use App\Models\Divider;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

use App\Models\Role;
use App\Models\Permission;

function addRole()
{
    $role = Role::create(['name' => 'kasir']);
}

function addPermission()
{
    $permission = Permission::create(['name' => 'add_user']);
}

function hello()
{
    return 'Hai Saya helpers spatie!';
}

function givePermission()
{
    $role = Role::create(['name' => 'kasir']);
    $permission = Permission::create(['name' => 'add_user']);

    $role->givePermissionTo($permission);
}