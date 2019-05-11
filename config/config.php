<?php
return [
    'select_default' => '--- Hãy chọn giá trị ---',
    'frontend' => [
        'per_page' => 20,
        'rates' => [
            'per_page' => 3,
        ],
    ],
    // Image
	'avatar_default' => '/images/avatar.png',
	'no_image' => '/images/placeholder.png',
	'url_tmp' => '/tmp',
	'url_media' => '/media',
    'url_media_frontend' => '/media/frontend',
    'favicon_frontend' => 'images/favicon.png',
    'logo_frontend' => 'images/logo.png',
    'url_facebook_image' => 'https://graph.facebook.com',

    'contact' => [
        'phone' => '(+84) 123-456-789',
        'email' => 'hoangpham2395@gmail.com',
        'address' => 'Số 1, Đại Cồ Việt, Hai Bà Trưng, Hà Nội, Việt Nam.',
    ],

    'link_messager' => 'https://www.facebook.com/messages/t/',

    // Admin
    'role_type' => [
        1 => 'Super admin',
        2 => 'Admin',
    ],
    'super_admin_type' => 1,

    // User
    'user_type' => [
        1 => 'Chủ xe',
        2 => 'Hành khách',
    ],
    'user_type_car_owner' => 1,
    'user_type_passenger' => 2,
    'open_flag' => [
        1 => 'On',
        0 => 'Off',
    ],

    // Post
    'post_type' => [
        1 => 'Xe tìm khách',
        2 => 'Khách tìm xe',
    ],
    'cost_search' => [
        'min' => 0,
        'max' => 10,
    ],

    // Car
    'car_type' => [
        1 => '4 chỗ',
        2 => '5 chỗ',
        3 => '7 chỗ',
        4 => '12 chỗ',
        5 => '16 chỗ',
        6 => '24 chỗ',
        7 => '30 chỗ',
        8 => 'Trên 30 chỗ',
    ],

    // Rate
    'rating_breakdown' => [
        5 => 'success',
        4 => 'primary',
        3 => 'info',
        2 => 'warning',
        1 => 'danger',
    ],
];