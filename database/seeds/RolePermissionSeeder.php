<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        $permissions = [
            'update-settings',
            'view-user',
            'create-user',
            'update-user',
            'destroy-user',
            'view-role',
            'view-permission',
            'create-role',
            'create-permission',
            'update-role',
            'update-permission',
            'destroy-role',
            'destroy-permission',
            'view-activity-log',
            'view-category',
            'create-category',
            'update-category',
            'destroy-category',
            'view-department',
            'create-department',
            'update-department',
            'destroy-department',
            'view-facility-department',
            'create-facility-department',
            'update-facility-department',
            'destroy-facility-department',
            'view-post',
            'create-post',
            'update-post',
            'destroy-post',
            'view-checkins',
            'create-checkins',
            'update-checkins',
            'destroy-checkins',
            'view-students',
            'create-students',
            'update-students',
            'destroy-students',
            'view-internships',
            'create-internships',
            'update-internships',
            'destroy-internships',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // Create Super user & role
        $admin= Role::create(['name' => 'Super Admin', 'status' => '0']);
        $admin->syncPermissions($permissions);

        $usr = User::create([
            'first_name'=> 'Super Admin',
            'middle_name'=> '',
            'last_name'=> 'Admin',
            'email' => 'admin@email.com',
            'msisdn' => '0700000001',
            'role_id' => '1',
            'nckid' => 'NCK001',
            'password' => 'secret',
            'status' => true,
            'email_verified_at' => now(),
        ]);

        $usr->assignRole($admin);

        $usr->syncPermissions($permissions);

        // Create user & role
        $role = Role::create(['name' => 'Practitioner']);
        $role->givePermissionTo('update-settings');
        $role->givePermissionTo('view-user');
        $role->givePermissionTo('create-user');
        $role->givePermissionTo('view-checkins');
        $role->givePermissionTo('update-checkins');
        $role->givePermissionTo('create-checkins');
        $role->givePermissionTo('view-facility-department');
        $role->givePermissionTo('create-facility-department');
        $role->givePermissionTo('update-facility-department');
        $role->givePermissionTo('destroy-facility-department');
        $role->givePermissionTo('view-post');
        $role->givePermissionTo('create-post');
        $role->givePermissionTo('update-post');
        $role->givePermissionTo('destroy-post');
        $role->givePermissionTo('destroy-checkins');
        $role->givePermissionTo('view-students');
        $role->givePermissionTo('create-students');
        $role->givePermissionTo('update-students');
        $role->givePermissionTo('destroy-students');
        $role->givePermissionTo('view-internships');
        $role->givePermissionTo('create-internships');
        $role->givePermissionTo('update-internships');
        $role->givePermissionTo('destroy-internships');

        $user = User::create([
            'first_name'=> 'Practitioner',
            'middle_name'=> 'User',
            'last_name'=> 'User',
            'email' => 'user@email.com',
            'msisdn' => '0700000002',
            'role_id' => '2',
            'nckid' => 'NCK002',
            'password' => 'secret',
            'status' => true,
            'email_verified_at' => now(),
        ]);
        $user->assignRole($role);

        // Create user & role
        $role = Role::create(['name' => 'Student']);
        $role->givePermissionTo('update-settings');
        $role->givePermissionTo('view-user');

        $user = User::create([
            'first_name'=> 'Student',
            'middle_name'=> 'User',
            'last_name'=> 'User',
            'email' => 'student@email.com',
            'msisdn' => '0700000003',
            'role_id' => '3',
            'nckid' => 'NCK003',
            'password' => 'secret',
            'status' => true,
            'email_verified_at' => now(),
        ]);
        $user->assignRole($role);
    }
}
