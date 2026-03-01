<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Thêm phòng mới - Khách sạn Việt Thành</title>
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
                    <form method="post" action="{{ Route('room.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="roomtype_id" class="form-label">Loại phòng <span>*</span></label>
                                <select name="roomtype_id" class="form-select">
                                    @foreach($typerooms as $typeroom)
                                        <option  value="{{$typeroom->id}}">
                                            {{ $typeroom->name }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="mb-3">
                            <label for="floor_id" class="form-label">Tầng <span>*</span></label>
                            <select name="floor_id" class="form-select" required>
                                @foreach($floors as $floor)
                                    <option value="{{ $floor->id }}">
                                        {{ $floor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên phòng <span>*</span></label>
                            <input type="text" maxlength="50" required placeholder="Nhập số phòng" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái <span>*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="0">Available</option>
                                <option value="1">Reserved</option>
                                <option value="2">Occupied</option>
                                <option value="3">Cleaning</option>
                                <option value="4">Maintenance</option>
                                <option value="5">Disabled</option>
                            </select>
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

