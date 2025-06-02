@extends('layouts.app')

@section('title', 'Trang chủ của tôi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Chào mừng bạn đến với trang chủ!</h1>
                    </div>

                    <div class="card-body">
                        <p class="lead text-center">
                            CMS một nền tảng trực tuyến cho phép người dùng tạo, quản lý và xuất bản các bài viết đồng thời
                            chia sẻ chúng với cộng đồng.
                        </p>

                        <hr>

                        <h2>Giới thiệu</h2>
                        <p>
                            Một website CMS (Content Management System) chia sẻ blog là một nền tảng trực tuyến cho phép
                            người dùng tạo, quản lý và xuất bản các bài viết (blog posts), đồng thời chia sẻ chúng với cộng
                            đồng. Hệ thống này không chỉ tập trung vào việc hiển thị nội dung mà còn cung cấp các công cụ để
                            quản lý người dùng, phân quyền, tương tác qua bình luận, và đôi khi cả các trang nội dung tĩnh.
                        </p>

                        <p>
                            Mục tiêu của chúng tôi là giúp khách hàng đạt được thành công
                            thông qua việc ứng dụng công nghệ tiên tiến.
                        </p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h3>Dịch vụ của chúng tôi</h3>
                                <ul>
                                    <li>Một website CMS (Content Management System) chia sẻ blog</li>
                                    <li>Một website CMS (Content Management System) chia sẻ blog</li>
                                    <li>Một website CMS (Content Management System) chia sẻ blog</li>
                                    <li>Một website CMS (Content Management System) chia sẻ blog</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h3>Tại sao chọn chúng tôi?</h3>
                                <p>
                                    Chúng tôi luôn đặt chất lượng lên hàng đầu, cam kết giao hàng đúng hạn,
                                    và cung cấp hỗ trợ khách hàng tuyệt vời.
                                </p>
                                <a href="#" class="btn btn-primary">Tìm hiểu thêm</a>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center mt-4">
                            <p>&copy; {{ date('Y') }} Content Management System</p>
                            <p>
                                <a href="#">Chính sách bảo mật</a> |
                                <a href="#">Điều khoản sử dụng</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
