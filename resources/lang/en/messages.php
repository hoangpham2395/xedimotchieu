<?php
return [
	// add
    'create_success' => 'Thành công.',
    'create_failed' => 'Đã có lỗi xảy ra ở hệ thống. Xin hãy thử lại!',
    // update
    'update_success' => 'Thành công.',
    'update_failed' => 'Đã có lỗi xảy ra ở hệ thống. Xin hãy thử lại!',
    // delete
    'delete_success' => 'Xóa thành công.',
    'delete_failed' => 'Đã có lỗi xảy ra ở hệ thống. Xin hãy thử lại!',

    'change_success' => 'Thay đổi thành công.',
    'failed' => 'Đã có lỗi xảy ra ở hệ thống. Xin hãy thử lại!',
    'success' => 'Thành công.',
    // search
    'no_result_found' => 'Không có dữ liệu.',
    'db_not_connect' => 'Chưa kết nối với cơ sở dữ liệu.',
    'url_not_found' => 'URL không được tìm thấy.',
    'db_error' => 'Đã có lỗi xảy ra ở cơ sở dữ liệu.',
    'system_error' => 'Hệ thống xảy ra lỗi. Xin hãy thử lại!',

    'id_invalid' => 'ID không hợp lệ.',
    'permission' => 'Bạn không có quyền truy cập.',
    'error_login' => 'Email hoặc mật khẩu không đúng.',
    'text_confirm_delete' => 'Bạn có chắc chắn muốn xóa?',
    'error_not_agree_term' => 'Bạn chưa đồng ý các điều khoản.',
    'create_account_success' => 'Đăng ký tài khoản thành công, mời bạn đăng nhập vào hệ thống.',

    // Message of dashboard
    'dashboard_users' => 'Hiện tại hệ thống có :users thành viên, bao gồm :car_owner chủ xe và :passenger hành khách đăng ký tham gia vào hệ thống.', 
    'dashboard_posts' => 'Hệ thống đã có :posts bài được đăng lên.',
    'dashboard_cars' => 'Hệ thống hiện có :cars chiếc xe đã đăng ký.',
    'dashboard_cities' => 'Hiện tại hệ thống đã có xe ở :cities tỉnh và thành phố trên cả nước.',

    'login_fb' => 'Sử dụng tài khoản Facebook',
    'login_title' => 'Đăng nhập vào hệ thống',
    'login_remember_me' => 'Giữ cho tôi đăng nhập',
    'login_forgot_password' => 'Quên mật khẩu',
    'login_register' => 'Đăng ký thành viên',
    'register_title' => 'Đăng ký thành viên',
    'register_agree_term' => 'Tôi đồng ý với các <a href="'.route('home.policy').'" target="blank">điều khoản chính sách</a>',
    'register_login' => 'Tôi đã có tài khoản',
    'forgot_password_title' => 'Hệ thống sẽ gửi email cho bạn, bạn hãy xác nhận email để nhận lại mật khẩu.',
    'account_not_exist' => 'Tài khoản không tồn tại.',
    'send_mail_success' => 'Gửi email thành công. Bạn hãy kiểm tra lại email để xem mật khẩu mới của bạn.',
    'send_mail_fail' => 'Gửi email thất bại.',
    'send_feedback_success' => 'Gửi email trả lời phản hồi thành công',
    'account_block' => 'Tài khoản của bạn đã bị chặn.',
    'not_connect_fb' => 'Không thể kết nối với facebook',
    'not_have_account' => 'Bạn chưa có tài khoản. Vui lòng hãy đăng ký!',
    'error_register' => 'Đã xảy lỗi, có thể tài khoản facebook hoặc email đăng ký facebook được đã đăng ký cho tài khoản khác. Vui lòng kiểm tra lại!',

    'note_posts' => [
        'image' => 'Ảnh sẽ hiển thị ở cuối bài đăng.',
        'cost' => 'Dưới 10 triệu VND.',
        'tags' => 'Ngăn cách giữa các thẻ là dấu phẩy. VD: facebook,google, ...',
        'schedules' => 'VD: Hà Nội,6:00|Đà Nẵng,19:00',
    ],

    'home_search' => 'Tìm kiếm chuyến xe phù hợp',
    'home_search_cost' => ':min triệu VND - :max triệu VND',
    'home_search_result' => 'Có :result kết quả tìm kiếm.',
    'average_rating' => 'Đánh giá trung bình',
    'rating_breakdown' => 'Thống kê đánh giá ',
    'rates_error_rate' => 'Bạn chưa đánh giá sao.',
    'rates_error_comment' => 'Bạn chưa để lại bình luận.',
    'rates_require_login' => 'Vui lòng bạn đăng nhập trước khi đánh giá.',

    'add_schedule_success' => 'Cập nhật lịch trình thành công.',
    'add_schedule_failed' => 'Cập nhật lịch trình thất bại.',
];