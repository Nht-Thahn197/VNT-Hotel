<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Thêm loại phòng - Khách sạn Việt Thành</title>
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
                    <form method="post" action="{{ Route('typeroom.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên loại phòng <span>*</span></label>
                            <input type="text" maxlength="50" required placeholder="Nhập tên loại phòng" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="price_hour" class="form-label">Giá theo giờ <span>*</span></label>
                            <input type="int" maxlength="50" required placeholder="Nhập giá theo giờ" class="form-control" name="price_hour">
                        </div>
                        <div class="mb-3">
                            <label for="price_overnight" class="form-label">Giá qua đêm <span>*</span></label>
                            <input type="int" maxlength="50" required placeholder="Nhập giá qua đêm" class="form-control" name="price_overnight">
                        </div>
                        <div class="mb-3">
                            <label for="price_night" class="form-label">Giá theo đêm <span>*</span></label>
                            <input type="int" maxlength="50" required placeholder="Nhập giá theo đêm" class="form-control" name="price_night">
                        </div>
                        <div class="mb-3">
                            <label for="max_guest" class="form-label">Số khách tối đa <span>*</span></label>
                            <input type="int" maxlength="50" required placeholder="Nhập số khách tối đa" class="form-control" name="max_guest" >
                        </div>
                        <div class="mb-3">
                            <label for="guest" class="form-label">Số khách <span>*</span></label>
                            <input type="int" maxlength="50" required placeholder="Nhập số khách" class="form-control" name="guest" >
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
