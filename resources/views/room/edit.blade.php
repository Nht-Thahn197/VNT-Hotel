<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sửa thông tin phòng - Khách sạn Việt Thành</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('img/icon2.jpg')}}" rel="icon">

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
                    <form method="post" action="">
                        @method('PUT')
                        @csrf
                            <div class="mb-3">
                            @foreach($rooms as $room)
                            <label class="form-label">Loại phòng: </label> <select name="roomtype_id" class="form-select">
                                @foreach($typerooms as $typeroom)
                                    <option value="{{ $typeroom->id }}"
                                    @if($typeroom->id == $room->roomtype_id)
                                        {{'selected'}}
                                        @endif>
                                        {{ $typeroom->name }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                            <div class="mb-3">
                                <label for="floor_id" class="form-label">Tầng:</label>
                                <select name="floor_id" class="form-select" required>
                                    @foreach($floors as $floor)
                                        <option value="{{ $floor->id }}"
                                            @if($floor->id == $room->floor_id)
                                                {{ 'selected' }}
                                            @endif>
                                            {{ $floor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3"> <label for="name" class="form-label">Tên phòng:</label>
                                <input type="text" class="form-control" name="name" value="{{$room->name}}" ></div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái:</label>
                                <select name="status" class="form-select" required>
                                    <option value="0" @if($room->status == 0) selected @endif>Available</option>
                                    <option value="1" @if($room->status == 1) selected @endif>Reserved</option>
                                    <option value="2" @if($room->status == 2) selected @endif>Occupied</option>
                                    <option value="3" @if($room->status == 3) selected @endif>Cleaning</option>
                                    <option value="4" @if($room->status == 4) selected @endif>Maintenance</option>
                                    <option value="5" @if($room->status == 5) selected @endif>Disabled</option>
                                </select>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    @include('layout.footer')
    <!-- Footer End -->
</div>

<!-- JavaScript Libraries -->
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

