<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->delete();

        $rolesuperadmin = Role::create(['name' => 'superadmin']);
        $roleadmin = Role::create(['name' => 'admin']);
        $roleeditor = Role::create(['name' => 'editor']);
        $roleuser = Role::create(['name' => 'user']);
        //permission

        $permissions = [



            [
                'group_name' => 'home',
                'permissions' => [
                    // admin Permissions
                    'admin.home',


                ]
            ],


            [
                'group_name' => 'admin',
                'permissions' => [
                    // admin Permissions
                    'users.all',
                    'users.create',
                    'users.store',
                    'users.edit',
                    'users.view',
                    'users.update',
                    'users.delete',

                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.all',
                    'role.create',
                    'role.store',
                    'role.edit',
                    'role.update',
                    'role.delete',
                ]
            ],
        ];


        //create Permission

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {

                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);

                $rolesuperadmin->givePermissionTo($permission);
                $permission->assignRole($rolesuperadmin);
            }
        }
        // DB::table('model_has_roles')->insert([
        //     'role_id' => 1,
        //     'model_type' => 'App\User',
        //     'model_id' => 1
        // ]);
    }
}
