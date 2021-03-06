<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AccessControlsTableSeeder extends Seeder
{


    public function run()
    {

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $dev = \App\Models\User::where('email', 'super@admin.com')->first();

        if (empty($dev)) {

            $data = [
                [
                    'id'=>'1',
                    'name' => 'Super Admin',
                    'email' => 'super@admin.com',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'id'=>'2',
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('12345678'),
                ], [
                    'id'=>'3',
                    'name' => 'Guest',
                    'email' => 'guest@gmail.com',
                    'password' => bcrypt('12345678'),
                ],
            ];

            \DB::table('users')->insert($data);

        }

        $dev = \App\Models\User::where('email', 'super@admin.com')->first();

        //data for roles table
        $data = [
            ['name' => 'Super Admin', 'guard_name' => 'api'],
            ['name' => 'Admin', 'guard_name' => 'api'],
            ['name' => 'Guest', 'guard_name' => 'api'],
        ];
        \DB::table('roles')->insert($data);

        //data for permissions table
        $data = [
            ['name' => 'dashboard', 'guard_name' => 'api'],

            ['name' => 'category-list', 'guard_name' => 'api'],
            ['name' => 'category-create', 'guard_name' => 'api'],
            ['name' => 'category-show', 'guard_name' => 'api'],
            ['name' => 'category-edit', 'guard_name' => 'api'],
            ['name' => 'category-delete', 'guard_name' => 'api'],

            ['name' => 'brand-list', 'guard_name' => 'api'],
            ['name' => 'brand-create', 'guard_name' => 'api'],
            ['name' => 'brand-show', 'guard_name' => 'api'],
            ['name' => 'brand-edit', 'guard_name' => 'api'],
            ['name' => 'brand-delete', 'guard_name' => 'api'],

            ['name' => 'courier-company-list', 'guard_name' => 'api'],
            ['name' => 'courier-company-create', 'guard_name' => 'api'],
            ['name' => 'courier-company-show', 'guard_name' => 'api'],
            ['name' => 'courier-company-edit', 'guard_name' => 'api'],
            ['name' => 'courier-company-delete', 'guard_name' => 'api'],

            ['name' => 'vendor-list', 'guard_name' => 'api'],
            ['name' => 'vendor-create', 'guard_name' => 'api'],
            ['name' => 'vendor-show', 'guard_name' => 'api'],
            ['name' => 'vendor-edit', 'guard_name' => 'api'],
            ['name' => 'vendor-delete', 'guard_name' => 'api'],

            ['name' => 'product-list', 'guard_name' => 'api'],
            ['name' => 'product-create', 'guard_name' => 'api'],
            ['name' => 'product-show', 'guard_name' => 'api'],
            ['name' => 'product-edit', 'guard_name' => 'api'],
            ['name' => 'product-delete', 'guard_name' => 'api'],


        ];

        \DB::table('permissions')->insert($data);
        //Data for role user pivot
        $data = [
            ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => $dev->id],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 2],
            ['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => 3],
        ];
        \DB::table('model_has_roles')->insert($data);
        //Data for role permission pivot
        $permissions = Permission::all();
        foreach ($permissions as $key => $value) {
            $data = [
                ['permission_id' => $value->id, 'role_id' => 1],
            ];

            \DB::table('role_has_permissions')->insert($data);

        }


    }
}
