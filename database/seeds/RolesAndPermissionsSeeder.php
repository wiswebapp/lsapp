<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionType = [
            'Blog'
        ];

        //Create Roles
        $Adminrole = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $Reviewer = Role::create(['name' => 'Reviewer Admin', 'guard_name' => 'admin']);

        // Create permissions
        foreach ($permissionType as $value) {
            Permission::create(['name' => 'Create '. $value, 'guard_name' => 'admin']);
            Permission::create(['name' => 'Edit '. $value, 'guard_name' => 'admin']);
            Permission::create(['name' => 'View '. $value, 'guard_name' => 'admin']);
            Permission::create(['name' => 'Delete '. $value, 'guard_name' => 'admin']);   
        }

        //Permission >> Roles
        $Adminrole->givePermissionTo(Permission::all());
        $Reviewer->givePermissionTo('Edit Blog');
        $Reviewer->givePermissionTo('View Blog');

        //User >> Roles
        $SuperAdmin = Admin::find(1);
        $ReviewerAdmin = Admin::find(1);
        $SuperAdmin->assignRole($Adminrole);
        $ReviewerAdmin->assignRole($Reviewer);
    }
}
