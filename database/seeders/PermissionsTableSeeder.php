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
                'title' => 'content_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 29,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 30,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 31,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 32,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 33,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 34,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 35,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 36,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 37,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 38,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 39,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 40,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 41,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 42,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 43,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 44,
                'title' => 'blog_access',
            ],
            [
                'id'    => 45,
                'title' => 'blog_category_create',
            ],
            [
                'id'    => 46,
                'title' => 'blog_category_edit',
            ],
            [
                'id'    => 47,
                'title' => 'blog_category_show',
            ],
            [
                'id'    => 48,
                'title' => 'blog_category_delete',
            ],
            [
                'id'    => 49,
                'title' => 'blog_category_access',
            ],
            [
                'id'    => 50,
                'title' => 'blog_tag_create',
            ],
            [
                'id'    => 51,
                'title' => 'blog_tag_edit',
            ],
            [
                'id'    => 52,
                'title' => 'blog_tag_show',
            ],
            [
                'id'    => 53,
                'title' => 'blog_tag_delete',
            ],
            [
                'id'    => 54,
                'title' => 'blog_tag_access',
            ],
            [
                'id'    => 55,
                'title' => 'blog_post_create',
            ],
            [
                'id'    => 56,
                'title' => 'blog_post_edit',
            ],
            [
                'id'    => 57,
                'title' => 'blog_post_show',
            ],
            [
                'id'    => 58,
                'title' => 'blog_post_delete',
            ],
            [
                'id'    => 59,
                'title' => 'blog_post_access',
            ],
            [
                'id'    => 60,
                'title' => 'country_create',
            ],
            [
                'id'    => 61,
                'title' => 'country_edit',
            ],
            [
                'id'    => 62,
                'title' => 'country_show',
            ],
            [
                'id'    => 63,
                'title' => 'country_delete',
            ],
            [
                'id'    => 64,
                'title' => 'country_access',
            ],
            [
                'id'    => 65,
                'title' => 'state_create',
            ],
            [
                'id'    => 66,
                'title' => 'state_edit',
            ],
            [
                'id'    => 67,
                'title' => 'state_show',
            ],
            [
                'id'    => 68,
                'title' => 'state_delete',
            ],
            [
                'id'    => 69,
                'title' => 'state_access',
            ],
            [
                'id'    => 70,
                'title' => 'address_access',
            ],
            [
                'id'    => 71,
                'title' => 'city_create',
            ],
            [
                'id'    => 72,
                'title' => 'city_edit',
            ],
            [
                'id'    => 73,
                'title' => 'city_show',
            ],
            [
                'id'    => 74,
                'title' => 'city_delete',
            ],
            [
                'id'    => 75,
                'title' => 'city_access',
            ],
            [
                'id'    => 76,
                'title' => 'admin_create',
            ],
            [
                'id'    => 77,
                'title' => 'admin_edit',
            ],
            [
                'id'    => 78,
                'title' => 'admin_show',
            ],
            [
                'id'    => 79,
                'title' => 'admin_delete',
            ],
            [
                'id'    => 80,
                'title' => 'admin_access',
            ],
            [
                'id'    => 81,
                'title' => 'events_management_access',
            ],
            [
                'id'    => 82,
                'title' => 'event_addon_create',
            ],
            [
                'id'    => 83,
                'title' => 'event_addon_edit',
            ],
            [
                'id'    => 84,
                'title' => 'event_addon_show',
            ],
            [
                'id'    => 85,
                'title' => 'event_addon_delete',
            ],
            [
                'id'    => 86,
                'title' => 'event_addon_access',
            ],
            [
                'id'    => 87,
                'title' => 'event_create',
            ],
            [
                'id'    => 88,
                'title' => 'event_edit',
            ],
            [
                'id'    => 89,
                'title' => 'event_show',
            ],
            [
                'id'    => 90,
                'title' => 'event_delete',
            ],
            [
                'id'    => 91,
                'title' => 'event_access',
            ],
            [
                'id'    => 92,
                'title' => 'costume_create',
            ],
            [
                'id'    => 93,
                'title' => 'costume_edit',
            ],
            [
                'id'    => 94,
                'title' => 'costume_show',
            ],
            [
                'id'    => 95,
                'title' => 'costume_delete',
            ],
            [
                'id'    => 96,
                'title' => 'costume_access',
            ],
            [
                'id'    => 97,
                'title' => 'costume_attribute_create',
            ],
            [
                'id'    => 98,
                'title' => 'costume_attribute_edit',
            ],
            [
                'id'    => 99,
                'title' => 'costume_attribute_show',
            ],
            [
                'id'    => 100,
                'title' => 'costume_attribute_delete',
            ],
            [
                'id'    => 101,
                'title' => 'costume_attribute_access',
            ],
            [
                'id'    => 102,
                'title' => 'event_ticket_create',
            ],
            [
                'id'    => 103,
                'title' => 'event_ticket_edit',
            ],
            [
                'id'    => 104,
                'title' => 'event_ticket_show',
            ],
            [
                'id'    => 105,
                'title' => 'event_ticket_delete',
            ],
            [
                'id'    => 106,
                'title' => 'event_ticket_access',
            ],
            [
                'id'    => 107,
                'title' => 'booking_access',
            ],
            [
                'id'    => 108,
                'title' => 'event_booking_create',
            ],
            [
                'id'    => 109,
                'title' => 'event_booking_edit',
            ],
            [
                'id'    => 110,
                'title' => 'event_booking_show',
            ],
            [
                'id'    => 111,
                'title' => 'event_booking_delete',
            ],
            [
                'id'    => 112,
                'title' => 'event_booking_access',
            ],
            [
                'id'    => 113,
                'title' => 'traveler_create',
            ],
            [
                'id'    => 114,
                'title' => 'traveler_edit',
            ],
            [
                'id'    => 115,
                'title' => 'traveler_show',
            ],
            [
                'id'    => 116,
                'title' => 'traveler_delete',
            ],
            [
                'id'    => 117,
                'title' => 'traveler_access',
            ],
            [
                'id'    => 118,
                'title' => 'payment_create',
            ],
            [
                'id'    => 119,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 120,
                'title' => 'payment_show',
            ],
            [
                'id'    => 121,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 122,
                'title' => 'payment_access',
            ],
            [
                'id'    => 123,
                'title' => 'hotel_create',
            ],
            [
                'id'    => 124,
                'title' => 'hotel_edit',
            ],
            [
                'id'    => 125,
                'title' => 'hotel_show',
            ],
            [
                'id'    => 126,
                'title' => 'hotel_delete',
            ],
            [
                'id'    => 127,
                'title' => 'hotel_access',
            ],
            [
                'id'    => 128,
                'title' => 'hotel_room_create',
            ],
            [
                'id'    => 129,
                'title' => 'hotel_room_edit',
            ],
            [
                'id'    => 130,
                'title' => 'hotel_room_show',
            ],
            [
                'id'    => 131,
                'title' => 'hotel_room_delete',
            ],
            [
                'id'    => 132,
                'title' => 'hotel_room_access',
            ],
            [
                'id'    => 133,
                'title' => 'amenity_create',
            ],
            [
                'id'    => 134,
                'title' => 'amenity_edit',
            ],
            [
                'id'    => 135,
                'title' => 'amenity_show',
            ],
            [
                'id'    => 136,
                'title' => 'amenity_delete',
            ],
            [
                'id'    => 137,
                'title' => 'amenity_access',
            ],
            [
                'id'    => 138,
                'title' => 'hotels_management_access',
            ],
            [
                'id'    => 139,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
