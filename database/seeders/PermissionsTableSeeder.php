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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 21,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 22,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 23,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 24,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 25,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 26,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 27,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 28,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 29,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 30,
                'title' => 'task_create',
            ],
            [
                'id'    => 31,
                'title' => 'task_edit',
            ],
            [
                'id'    => 32,
                'title' => 'task_show',
            ],
            [
                'id'    => 33,
                'title' => 'task_delete',
            ],
            [
                'id'    => 34,
                'title' => 'task_access',
            ],
            [
                'id'    => 35,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 36,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 37,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 38,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 39,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 40,
                'title' => 'address_create',
            ],
            [
                'id'    => 41,
                'title' => 'address_edit',
            ],
            [
                'id'    => 42,
                'title' => 'address_show',
            ],
            [
                'id'    => 43,
                'title' => 'address_delete',
            ],
            [
                'id'    => 44,
                'title' => 'address_access',
            ],
            [
                'id'    => 45,
                'title' => 'vendor_create',
            ],
            [
                'id'    => 46,
                'title' => 'vendor_edit',
            ],
            [
                'id'    => 47,
                'title' => 'vendor_show',
            ],
            [
                'id'    => 48,
                'title' => 'vendor_delete',
            ],
            [
                'id'    => 49,
                'title' => 'vendor_access',
            ],
            [
                'id'    => 50,
                'title' => 'brand_create',
            ],
            [
                'id'    => 51,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 52,
                'title' => 'brand_show',
            ],
            [
                'id'    => 53,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 54,
                'title' => 'brand_access',
            ],
            [
                'id'    => 55,
                'title' => 'contact_create',
            ],
            [
                'id'    => 56,
                'title' => 'contact_edit',
            ],
            [
                'id'    => 57,
                'title' => 'contact_show',
            ],
            [
                'id'    => 58,
                'title' => 'contact_delete',
            ],
            [
                'id'    => 59,
                'title' => 'contact_access',
            ],
            [
                'id'    => 60,
                'title' => 'engine_create',
            ],
            [
                'id'    => 61,
                'title' => 'engine_edit',
            ],
            [
                'id'    => 62,
                'title' => 'engine_show',
            ],
            [
                'id'    => 63,
                'title' => 'engine_delete',
            ],
            [
                'id'    => 64,
                'title' => 'engine_access',
            ],
            [
                'id'    => 65,
                'title' => 'note_create',
            ],
            [
                'id'    => 66,
                'title' => 'note_edit',
            ],
            [
                'id'    => 67,
                'title' => 'note_show',
            ],
            [
                'id'    => 68,
                'title' => 'note_delete',
            ],
            [
                'id'    => 69,
                'title' => 'note_access',
            ],
            [
                'id'    => 70,
                'title' => 'prelude_number_create',
            ],
            [
                'id'    => 71,
                'title' => 'prelude_number_edit',
            ],
            [
                'id'    => 72,
                'title' => 'prelude_number_show',
            ],
            [
                'id'    => 73,
                'title' => 'prelude_number_delete',
            ],
            [
                'id'    => 74,
                'title' => 'prelude_number_access',
            ],
            [
                'id'    => 75,
                'title' => 'product_create',
            ],
            [
                'id'    => 76,
                'title' => 'product_edit',
            ],
            [
                'id'    => 77,
                'title' => 'product_show',
            ],
            [
                'id'    => 78,
                'title' => 'product_delete',
            ],
            [
                'id'    => 79,
                'title' => 'product_access',
            ],
            [
                'id'    => 80,
                'title' => 'service_create',
            ],
            [
                'id'    => 81,
                'title' => 'service_edit',
            ],
            [
                'id'    => 82,
                'title' => 'service_show',
            ],
            [
                'id'    => 83,
                'title' => 'service_delete',
            ],
            [
                'id'    => 84,
                'title' => 'service_access',
            ],
            [
                'id'    => 85,
                'title' => 'vendor_number_create',
            ],
            [
                'id'    => 86,
                'title' => 'vendor_number_edit',
            ],
            [
                'id'    => 87,
                'title' => 'vendor_number_show',
            ],
            [
                'id'    => 88,
                'title' => 'vendor_number_delete',
            ],
            [
                'id'    => 89,
                'title' => 'vendor_number_access',
            ],
            [
                'id'    => 90,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 91,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 92,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 93,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 94,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 95,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 96,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 97,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 98,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 99,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 100,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 101,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 102,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 103,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 104,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 105,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 106,
                'title' => 'asset_create',
            ],
            [
                'id'    => 107,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 108,
                'title' => 'asset_show',
            ],
            [
                'id'    => 109,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 110,
                'title' => 'asset_access',
            ],
            [
                'id'    => 111,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 112,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
