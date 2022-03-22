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
                'title' => 'setting_access',
            ],
            [
                'id'    => 18,
                'title' => 'country_create',
            ],
            [
                'id'    => 19,
                'title' => 'country_edit',
            ],
            [
                'id'    => 20,
                'title' => 'country_show',
            ],
            [
                'id'    => 21,
                'title' => 'country_delete',
            ],
            [
                'id'    => 22,
                'title' => 'country_access',
            ],
            [
                'id'    => 23,
                'title' => 'city_create',
            ],
            [
                'id'    => 24,
                'title' => 'city_edit',
            ],
            [
                'id'    => 25,
                'title' => 'city_show',
            ],
            [
                'id'    => 26,
                'title' => 'city_delete',
            ],
            [
                'id'    => 27,
                'title' => 'city_access',
            ],
            [
                'id'    => 28,
                'title' => 'blog_access',
            ],
            [
                'id'    => 29,
                'title' => 'article_create',
            ],
            [
                'id'    => 30,
                'title' => 'article_edit',
            ],
            [
                'id'    => 31,
                'title' => 'article_show',
            ],
            [
                'id'    => 32,
                'title' => 'article_delete',
            ],
            [
                'id'    => 33,
                'title' => 'article_access',
            ],
            [
                'id'    => 34,
                'title' => 'auther_create',
            ],
            [
                'id'    => 35,
                'title' => 'auther_edit',
            ],
            [
                'id'    => 36,
                'title' => 'auther_show',
            ],
            [
                'id'    => 37,
                'title' => 'auther_delete',
            ],
            [
                'id'    => 38,
                'title' => 'auther_access',
            ],
            [
                'id'    => 39,
                'title' => 'forum_access',
            ],
            [
                'id'    => 40,
                'title' => 'thread_create',
            ],
            [
                'id'    => 41,
                'title' => 'thread_edit',
            ],
            [
                'id'    => 42,
                'title' => 'thread_show',
            ],
            [
                'id'    => 43,
                'title' => 'thread_delete',
            ],
            [
                'id'    => 44,
                'title' => 'thread_access',
            ],
            [
                'id'    => 45,
                'title' => 'forum_category_create',
            ],
            [
                'id'    => 46,
                'title' => 'forum_category_edit',
            ],
            [
                'id'    => 47,
                'title' => 'forum_category_show',
            ],
            [
                'id'    => 48,
                'title' => 'forum_category_delete',
            ],
            [
                'id'    => 49,
                'title' => 'forum_category_access',
            ],
            [
                'id'    => 50,
                'title' => 'forum_comment_create',
            ],
            [
                'id'    => 51,
                'title' => 'forum_comment_edit',
            ],
            [
                'id'    => 52,
                'title' => 'forum_comment_show',
            ],
            [
                'id'    => 53,
                'title' => 'forum_comment_delete',
            ],
            [
                'id'    => 54,
                'title' => 'forum_comment_access',
            ],
            [
                'id'    => 55,
                'title' => 'training_access',
            ],
            [
                'id'    => 56,
                'title' => 'course_create',
            ],
            [
                'id'    => 57,
                'title' => 'course_edit',
            ],
            [
                'id'    => 58,
                'title' => 'course_show',
            ],
            [
                'id'    => 59,
                'title' => 'course_delete',
            ],
            [
                'id'    => 60,
                'title' => 'course_access',
            ],
            [
                'id'    => 61,
                'title' => 'specialization_create',
            ],
            [
                'id'    => 62,
                'title' => 'specialization_edit',
            ],
            [
                'id'    => 63,
                'title' => 'specialization_show',
            ],
            [
                'id'    => 64,
                'title' => 'specialization_delete',
            ],
            [
                'id'    => 65,
                'title' => 'specialization_access',
            ],
            [
                'id'    => 66,
                'title' => 'diploma_create',
            ],
            [
                'id'    => 67,
                'title' => 'diploma_edit',
            ],
            [
                'id'    => 68,
                'title' => 'diploma_show',
            ],
            [
                'id'    => 69,
                'title' => 'diploma_delete',
            ],
            [
                'id'    => 70,
                'title' => 'diploma_access',
            ],
            [
                'id'    => 71,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 72,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 73,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 74,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 75,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 76,
                'title' => 'zoom_create',
            ],
            [
                'id'    => 77,
                'title' => 'zoom_edit',
            ],
            [
                'id'    => 78,
                'title' => 'zoom_show',
            ],
            [
                'id'    => 79,
                'title' => 'zoom_delete',
            ],
            [
                'id'    => 80,
                'title' => 'zoom_access',
            ],
            [
                'id'    => 81,
                'title' => 'payment_access',
            ],
            [
                'id'    => 82,
                'title' => 'invoice_create',
            ],
            [
                'id'    => 83,
                'title' => 'invoice_edit',
            ],
            [
                'id'    => 84,
                'title' => 'invoice_show',
            ],
            [
                'id'    => 85,
                'title' => 'invoice_delete',
            ],
            [
                'id'    => 86,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 87,
                'title' => 'order_create',
            ],
            [
                'id'    => 88,
                'title' => 'order_edit',
            ],
            [
                'id'    => 89,
                'title' => 'order_show',
            ],
            [
                'id'    => 90,
                'title' => 'order_delete',
            ],
            [
                'id'    => 91,
                'title' => 'order_access',
            ],
            [
                'id'    => 92,
                'title' => 'certificate_create',
            ],
            [
                'id'    => 93,
                'title' => 'certificate_edit',
            ],
            [
                'id'    => 94,
                'title' => 'certificate_show',
            ],
            [
                'id'    => 95,
                'title' => 'certificate_delete',
            ],
            [
                'id'    => 96,
                'title' => 'certificate_access',
            ],
            [
                'id'    => 97,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
