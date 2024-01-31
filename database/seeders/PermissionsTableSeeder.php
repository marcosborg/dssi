<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'manufacturer_create',
            ],
            [
                'id'    => 18,
                'title' => 'manufacturer_edit',
            ],
            [
                'id'    => 19,
                'title' => 'manufacturer_show',
            ],
            [
                'id'    => 20,
                'title' => 'manufacturer_delete',
            ],
            [
                'id'    => 21,
                'title' => 'manufacturer_access',
            ],
            [
                'id'    => 22,
                'title' => 'solution_create',
            ],
            [
                'id'    => 23,
                'title' => 'solution_edit',
            ],
            [
                'id'    => 24,
                'title' => 'solution_show',
            ],
            [
                'id'    => 25,
                'title' => 'solution_delete',
            ],
            [
                'id'    => 26,
                'title' => 'solution_access',
            ],
            [
                'id'    => 27,
                'title' => 'stock_create',
            ],
            [
                'id'    => 28,
                'title' => 'stock_edit',
            ],
            [
                'id'    => 29,
                'title' => 'stock_show',
            ],
            [
                'id'    => 30,
                'title' => 'stock_delete',
            ],
            [
                'id'    => 31,
                'title' => 'stock_access',
            ],
            [
                'id'    => 32,
                'title' => 'crash_plan_create',
            ],
            [
                'id'    => 33,
                'title' => 'crash_plan_edit',
            ],
            [
                'id'    => 34,
                'title' => 'crash_plan_show',
            ],
            [
                'id'    => 35,
                'title' => 'crash_plan_delete',
            ],
            [
                'id'    => 36,
                'title' => 'crash_plan_access',
            ],
            [
                'id'    => 37,
                'title' => 'product_menu_access',
            ],
            [
                'id'    => 38,
                'title' => 'k_seven_security_create',
            ],
            [
                'id'    => 39,
                'title' => 'k_seven_security_edit',
            ],
            [
                'id'    => 40,
                'title' => 'k_seven_security_show',
            ],
            [
                'id'    => 41,
                'title' => 'k_seven_security_delete',
            ],
            [
                'id'    => 42,
                'title' => 'k_seven_security_access',
            ],
            [
                'id'    => 43,
                'title' => 'mail_store_create',
            ],
            [
                'id'    => 44,
                'title' => 'mail_store_edit',
            ],
            [
                'id'    => 45,
                'title' => 'mail_store_show',
            ],
            [
                'id'    => 46,
                'title' => 'mail_store_delete',
            ],
            [
                'id'    => 47,
                'title' => 'mail_store_access',
            ],
            [
                'id'    => 48,
                'title' => 'own_cloud_create',
            ],
            [
                'id'    => 49,
                'title' => 'own_cloud_edit',
            ],
            [
                'id'    => 50,
                'title' => 'own_cloud_show',
            ],
            [
                'id'    => 51,
                'title' => 'own_cloud_delete',
            ],
            [
                'id'    => 52,
                'title' => 'own_cloud_access',
            ],
            [
                'id'    => 53,
                'title' => 'titan_hq_create',
            ],
            [
                'id'    => 54,
                'title' => 'titan_hq_edit',
            ],
            [
                'id'    => 55,
                'title' => 'titan_hq_show',
            ],
            [
                'id'    => 56,
                'title' => 'titan_hq_delete',
            ],
            [
                'id'    => 57,
                'title' => 'titan_hq_access',
            ],
            [
                'id'    => 58,
                'title' => 'ubiquiti_create',
            ],
            [
                'id'    => 59,
                'title' => 'ubiquiti_edit',
            ],
            [
                'id'    => 60,
                'title' => 'ubiquiti_show',
            ],
            [
                'id'    => 61,
                'title' => 'ubiquiti_delete',
            ],
            [
                'id'    => 62,
                'title' => 'ubiquiti_access',
            ],
            [
                'id'    => 63,
                'title' => 'wasabi_create',
            ],
            [
                'id'    => 64,
                'title' => 'wasabi_edit',
            ],
            [
                'id'    => 65,
                'title' => 'wasabi_show',
            ],
            [
                'id'    => 66,
                'title' => 'wasabi_delete',
            ],
            [
                'id'    => 67,
                'title' => 'wasabi_access',
            ],
            [
                'id'    => 68,
                'title' => 'product_create',
            ],
            [
                'id'    => 69,
                'title' => 'product_edit',
            ],
            [
                'id'    => 70,
                'title' => 'product_show',
            ],
            [
                'id'    => 71,
                'title' => 'product_delete',
            ],
            [
                'id'    => 72,
                'title' => 'product_access',
            ],
            [
                'id'    => 73,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
