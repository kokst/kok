<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Migrations\Migration;

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
