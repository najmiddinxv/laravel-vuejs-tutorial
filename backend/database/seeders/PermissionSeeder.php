<?php

namespace Database\Seeders;

use App\Models\categories;
use App\Models\Category;
use App\Models\ModelHasPermission;
use App\Models\ModelHasRole;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Role::truncate(); //rollar -> admin,manager...
        Permission::truncate(); //ruxsatlar ->delete,publish,view...

        RoleHasPermission::truncate();//rollarga biriktirilgan ruxsatlar ->manager faqat view qilaoladi,admin->hammasini qilaoladi

        ModelHasPermission::truncate();//(model)userga berilgan ruxsatlar id=1 user -> delete qilaoladi
        ModelHasRole::truncate();//(model)userga berlgan rollar id=1 userga admin role berilgan

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
                'name' =>'User',
                'guard_name' =>'web'
            ],
            [
                'name' =>'User',
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
                'name' =>'modify',
                'guard_name' =>'web'
            ],
            [
                'name' =>'modify',
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
            [
                'name' =>'view',
                'guard_name' =>'web'
            ],
            [
                'name' =>'view',
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
                'permission_id' =>11,
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
                'permission_id' =>12,
                'role_id' =>2
            ],
            [
                'permission_id' =>9,
                'role_id' =>3
            ],
            [
                'permission_id' =>11,
                'role_id' =>3
            ],
            [
                'permission_id' =>8,
                'role_id' =>4
            ],
            [
                'permission_id' =>10,
                'role_id' =>4
            ],
            [
                'permission_id' =>11,
                'role_id' =>5
            ],
            [
                'permission_id' =>12,
                'role_id' =>6
            ],
        ];
        RoleHasPermission::insert($role_has_permission);
        dump('RoleHasPermission seeder done');


        $model_has_permission = [
            [
                'permission_id' =>11,
                'model_type' => 'App\\Models\\User',
                'model_id' => 3
            ],
            [
                'permission_id' =>12,
                'model_type' => 'App\\Models\\User',
                'model_id' => 3
            ],

        ];
        ModelHasPermission::insert($model_has_permission);
        dump('ModelHasPermission seeder done');

        $model_has_role = [
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
        ModelHasRole::insert($model_has_role);
        dump('ModelHasRole seeder done');

    }
}