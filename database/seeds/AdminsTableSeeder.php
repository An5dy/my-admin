<?php

use App\Models\Role;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $tableNames = config('permission.table_names');

        // 清空表数据
        Admin::truncate();
        Role::truncate();
        Permission::truncate();
        DB::table($tableNames['model_has_permissions'])->truncate();
        DB::table($tableNames['model_has_roles'])->truncate();
        DB::table($tableNames['role_has_permissions'])->truncate();

        // 清空缓存
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $admin = Admin::create([
            'username' => 'admin',
            'nickname' => 'admin',
            'password' => bcrypt(123456),
            'is_super' => 1,
        ]);

        $role = Role::create([
            'display_name' => '超级管理员',
            'name' => 'super-admin',
            'guard_name' => 'api'
        ]);

        $time = now();
        Permission::insert([
            [
                'display_name' => '首页',
                'name' => 'home',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],

            [
                'display_name' => '权限列表',
                'name' => 'permissions-index',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '所有权限',
                'name' => 'permissions-all',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '权限新增',
                'name' => 'permissions-create',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '权限编辑',
                'name' => 'permissions-edit',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '权限删除',
                'name' => 'permissions-destroy',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '权限详情',
                'name' => 'permissions-show',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],

            [
                'display_name' => '角色列表',
                'name' => 'roles-index',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '所有角色',
                'name' => 'roles-all',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '角色新增',
                'name' => 'roles-create',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '角色编辑',
                'name' => 'roles-edit',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '角色删除',
                'name' => 'roles-destroy',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '角色详情',
                'name' => 'roles-show',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],

            [
                'display_name' => '管理员列表',
                'name' => 'admins-index',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '管理员新增',
                'name' => 'admins-create',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '管理员编辑',
                'name' => 'admins-edit',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '管理员删除',
                'name' => 'admins-destroy',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'display_name' => '管理员详情',
                'name' => 'admins-show',
                'guard_name' => 'api',
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ]);

        $role->givePermissionTo(Permission::all());

        $admin->assignRole($role);


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
