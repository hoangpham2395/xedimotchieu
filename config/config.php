<?php
return [
    'select_default' => '--- Hãy chọn giá trị ---',
    'frontend' => [
        'per_page' => 20,
    ],
    // Image
	'avatar_default' => '/images/avatar.png',
	'no_image' => '/images/placeholder.png',
	'url_tmp' => '/tmp_uploads',
	'url_media' => '/medias',

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
    'open_flag' => [
        1 => 'On',
        0 => 'Off',
    ],

    // Post
    'post_type' => [
        1 => 'Xe tìm khách',
        2 => 'Khách tìm xe',
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
];