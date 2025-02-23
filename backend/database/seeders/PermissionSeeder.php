<?php

namespace Database\Seeders;

use App\Models\ModelHasPermission;
use App\Models\ModelHasRole;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\RoleHasPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET CONSTRAINTS ALL DEFERRED;');//postgresql
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //mysql
        // RoleHasPermission::truncate();//rollarga biriktirilgan ruxsatlar ->manager faqat view qilaoladi,admin->hammasini qilaoladi
        // ModelHasPermission::truncate();//(model)userga berilgan ruxsatlar id=1 user -> delete qilaoladi
        // ModelHasRole::truncate();//(model)userga berlgan rollar id=1 userga admin role berilgan
        // Permission::truncate(); //ruxsatlar ->delete,publish,view...
        // Role::truncate(); //rollar -> admin,manager...
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //mysql
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE;');//postgresql

        $roles = [
            [
                'name' =>'admin',
                'guard_name' =>'web'
            ],
            [
                'name' =>'admin',
                'guard_name' =>'api'
            ],
            [
                'name' =>'manager',
                'guard_name' =>'web'
            ],
            [
                'name' =>'manager',
                'guard_name' =>'api'
            ],
            [
                'name' =>'user',
                'guard_name' =>'web'
            ],
            [
                'name' =>'user',
                'guard_name' =>'api'
            ],

        ];
        Role::insert($roles);
        dump('Role seeder done');

        $permissions = [
            [
                'name' =>'create',
                'guard_name' =>'web'
            ],
            [
                'name' =>'create',
                'guard_name' =>'api'
            ],
            [
                'name' =>'read',
                'guard_name' =>'web'
            ],
            [
                'name' =>'read',
                'guard_name' =>'api'
            ],
            [
                'name' =>'update',
                'guard_name' =>'web'
            ],
            [
                'name' =>'update',
                'guard_name' =>'api'
            ],
            [
                'name' =>'delete',
                'guard_name' =>'web'
            ],
            [
                'name' =>'delete',
                'guard_name' =>'api'
            ],
            [
                'name' =>'publish',
                'guard_name' =>'web'
            ],
            [
                'name' =>'publish',
                'guard_name' =>'api'
            ],

        ];
        Permission::insert($permissions);
        dump('Permission seeder done');

        $role_has_permission = [
            [
                'permission_id' =>1,
                'role_id' =>1
            ],
            [
                'permission_id' =>3,
                'role_id' =>1
            ],
            [
                'permission_id' =>5,
                'role_id' =>1
            ],
            [
                'permission_id' =>7,
                'role_id' =>1
            ],
            [
                'permission_id' =>9,
                'role_id' =>1
            ],
            [
                'permission_id' =>2,
                'role_id' =>2
            ],
            [
                'permission_id' =>4,
                'role_id' =>2
            ],
            [
                'permission_id' =>6,
                'role_id' =>2
            ],
            [
                'permission_id' =>8,
                'role_id' =>2
            ],
            [
                'permission_id' =>10,
                'role_id' =>2
            ],
            [
                'permission_id' =>1,
                'role_id' =>3
            ],
            [
                'permission_id' =>3,
                'role_id' =>3
            ],
            [
                'permission_id' =>2,
                'role_id' =>4
            ],
            [
                'permission_id' =>4,
                'role_id' =>4
            ],

        ];
        DB::table('role_has_permissions')->insert($role_has_permission);
        dump('RoleHasPermission seeder done');

        $model_has_permission = [
            //oddiy user permission berilayapti
            [
                'permission_id' =>3,
                'model_type' => 'App\\Models\\User',
                'model_id' => 3
            ],
            [
                'permission_id' =>4,
                'model_type' => 'App\\Models\\User',
                'model_id' => 3
            ],

        ];
        DB::table('model_has_permissions')->insert($model_has_permission);
        dump('ModelHasPermission seeder done');

        $model_has_role = [
            //admin
            [
                'role_id' =>1,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1
            ],
            [
                'role_id' =>2,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1
            ],
            //manager
            [
                'role_id' =>5,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2
            ],
            [
                'role_id' =>6,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2
            ],

        ];
        DB::table('model_has_roles')->insert($model_has_role);
        dump('ModelHasRole seeder done');

    }
}
