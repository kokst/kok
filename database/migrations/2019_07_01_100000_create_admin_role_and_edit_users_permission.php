<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminRoleAndEditUsersPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Admin
        $admin = Role::create(['name' => 'Admin']);

        // 'edit users' Permission
        $editUsers = Permission::create(['name' => 'edit users']);
    }
}
