<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Thêm nhân viên - VNT-Hotel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('favicon-home.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>

<!-- Sidebar Start -->
@include('layout.sidebar')
<!-- Sidebar End -->

<div class="content">

    <!-- Navbar Start -->
    @include('layout.navbar')
    <!-- Navbar End -->

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <form method="post" action="{{ Route('admin.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ & Tên <span>*</span></label>
                            <input type="text" maxlength="50" required placeholder="Nhập họ tên nhân viên" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại <span>*</span></label>
                            <input type="int" maxlength="10" required placeholder="Nhập số điện thoại nhân viên" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span>*</span></label>
                            <input type="email" maxlength="50" required placeholder="Nhập email nhân viên" class="form-control" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Chức vụ <span>*</span></label>
                            <input type="text" maxlength="50" required placeholder="Nhập chức vụ nhân viên" class="form-control" name="role" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái <span>*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                                <option value="2">Blocked</option>
                                <option value="3">Deleted</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu <span>*</span></label>
                            <input type="text" maxlength="50" required placeholder="Nhập mật khẩu nhân viên" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Start -->
    @include('layout.footer')
    <!-- Footer End -->
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('lib/chart/chart.min.js')}}"></script>
<script src="{{asset('lib/easing/easing.min.js')}}"></script>
<script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('lib/tempusdominus/js/moment.min.js')}}"></script>
<script src="{{asset('lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
<script src="{{asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<!-- Template Javascript -->
<script src="{{asset('js/main.js')}}"></script>
</body>

</html>


