<?php
return [
	'admin' => [
		'id' => 'ID',
		'username' => 'Tài khoản',
		'email' => 'Email',
		'password' => 'Mật khẩu',
		'role_type' => 'Phân quyền',
		'confirm_password' => 'Xác nhận mật khẩu',
	],
    'users' => [
        'id' => 'ID',
        'name' => 'Tên',
        'user_type' => 'Kiểu người dùng',
        'fb_id' => 'Facebook ID',
        'gg_id' => 'Google ID',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'confirm_password' => 'Xác nhận mật khẩu',
        'open_flag' => 'Mở tài khoản',
    ],
    'posts' => [
        'id' => 'ID',
        'city_from_id' => 'Tỉnh/Thành phố đi',
        'city_to_id' => 'Tỉnh/Thành phố đến',
        'district_from_id' => 'Huyện/Quận đi',
        'district_to_id' => 'Huyện/Quận đến',
        'car_id' => 'Chọn xe',
        'car_type' => 'Loại xe',
        'type' => 'Hình thức',
        'date_start' => 'Ngày đi',
        'cost' => 'Giá đề xuất',
        'phone' => 'Số điện thoại',
        'image' => 'Hình ảnh',
        'note' => 'Nội dung',
        'tags' => 'Thẻ',
        'place_from' => 'Nơi đi',
        'place_to' => 'Nơi đến',
    ],
    'cars' => [
        'id' => 'ID',
        'user_id' => 'Chủ xe',
        'car_name' => 'Tên xe',
        'car_type' => 'Loại xe',
        'car_image' => 'Hình ảnh',
    ],
    'comments' => [
        'id' => 'ID',
        'user_id' => 'Người bình luận',
        'comment' => 'Bình luận',
    ],
    'feedbacks' => [
        'id' => 'ID',
        'email' => 'Email',
        'content' => 'Nội dung phản hồi',
    ],
    'cities' => [
        'id' => 'ID',
        'city_name' => 'Tỉnh/Thành phố',
    ],
    'districts' => [
        'id' => 'ID',
        'city_id' => 'Tỉnh/Thành phố',
        'district_name' => 'Quận/Huyện',
    ],
    'rates' => [
        'id' => 'ID',
        'use_id' => 'Người dùng',
        'post_id' => 'Bài đăng',
        'rate' => 'Đánh giá',
        'comment' => 'Bình luận',
    ],
];