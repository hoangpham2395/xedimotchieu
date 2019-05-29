@extends('layouts.frontend.structure.static.main')
@section('content')
    <div class="w3-row-padding static-page">
        <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container">
                    <h1 class="w3-opacity">{{transb('home.introduction')}}</h1>
                </div>
                <div class="w3-container">
                    <h2>Bài toán thực tế cho <a href="{{route('home.index')}}">xemotchieu</a></h2>
                    <span>Trang web chia sẻ thông tin và kết nối những chuyến xe đi một chiều. Mục đích của trang web được tạo ra là nhằm giải quyết những bài toán thực tế trong cuộc sống về những chuyến đi một chiều mà xe không có khách hoặc ít khách khi thực hiện chuyến đi, hay một người có thể tìm được chuyến đi phù hợp với những tuyến đi cố định của nhà xe.</span>
                </div>
                <div class="w3-container">
                    <h2>Tại <a href="{{route('home.index')}}">xemotchieu</a> bạn được sử dụng những tính năng siêu việt và hoàn toàn miễn phí.</h2>
                    <span>Với chủ xe:</span>
                    <ul>
                        <li>Đăng bài tìm khách</li>
                        <li>Xem bài đăng có sẵn</li>
                        <li>Tìm kiếm khách theo khu vực</li>
                        <li>Tìm kiếm khách theo loại xe</li>
                        <li>Tìm kiếm khách theo giá đề xuất, ngày khởi hành, số chỗ ngồi</li>
                        <li>Quản lý các chuyến đi của mình.</li>
                        <li>Quản lý xe đăng ký trên hệ thống</li>
                        <li>Chat với khách qua messenger, trong hệ thống</li>
                    </ul>
                    <span>Với hành khách:</span>
                    <ul>
                        <li>Đăng bài tìm xe</li>
                        <li>Xem các bài đăng có sẵn</li>
                        <li>Tìm kiếm xe theo khu vực</li>
                        <li>Tìm kiếm xe theo loại xe</li>
                        <li>Tìm kiếm xe theo khoảng giá, ngày khởi hành, số chỗ trống</li>
                        <li>Đánh giá bài đăng</li>
                        <li>Chia sẻ bài đăng cho bạn bè</li>
                        <li>Chat với chủ xe qua messenger, trong hệ thống</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection