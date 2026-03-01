<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Booking Management - H2T Hotel</title>
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
<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    @include('layout.sidebar')
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('layout.navbar')
        <!-- Navbar End -->

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Danh sách đặt phòng</h6>
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên khách hàng</th>
                                <th>Loại phòng</th>
                                <th>Check in</th>
                                <th>Check out</th>
                                <th>Trạng thái đặt phòng</th>
                                <th>Phòng</th>
                                <th>Trạng thái hóa đơn</th>
                                <th>Phương thức thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id}}</td>
                                    <td>{{ $booking->customer_name}}</td>
                                    <td>{{ $booking->room_type_name}}</td>
                                    <td>{{ $booking->time_start}}</td>
                                    <td>{{ $booking->time_end}}</td>
                                    <td>
                                        @if($booking->booking_status == 0)
                                            {{ 'Chờ xác nhận' }}
                                        @elseif($booking->booking_status == 1)
                                            {{ 'Đã xác nhận / giữ phòng' }}
                                        @elseif($booking->booking_status == 2)
                                            {{ 'Đã nhận phòng' }}
                                        @elseif($booking->booking_status == 3)
                                            {{ 'Đã trả phòng' }}
                                        @elseif($booking->booking_status == 4)
                                            {{ 'Đã hủy' }}
                                        @elseif($booking->booking_status == 5)
                                            {{ 'Khách không đến' }}
                                        @endif
                                    </td>
                                    <td>{{ $booking->room_name ?? 'Chưa gắn'}}</td>
                                    <td>
                                        @if($booking->invoice_status === null)
                                            {{ 'Chưa lập hóa đơn' }}
                                        @elseif($booking->invoice_status == 0)
                                            {{ 'Tạm tính' }}
                                        @elseif($booking->invoice_status == 1)
                                            {{ 'Chưa thanh toán' }}
                                        @elseif($booking->invoice_status == 2)
                                            {{ 'Đã thanh toán' }}
                                        @elseif($booking->invoice_status == 3)
                                            {{ 'Đã hoàn tiền' }}
                                        @elseif($booking->invoice_status == 4)
                                            {{ 'Hủy hóa đơn ' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->invoice_method === null || $booking->invoice_method == 0)
                                            {{ '-' }}
                                        @elseif($booking->invoice_method == 1)
                                            {{ 'Tiền mặt' }}
                                        @elseif($booking->invoice_method == 2)
                                            {{ 'Ngân hàng' }}
                                        @elseif($booking->invoice_method == 3)
                                            {{ 'Thẻ' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->booking_status == 0)
                                            <a href="{{route('invoice.updateStatus', $booking->id)}}"><button class="btn btn-success">Xác nhận</button></a>
                                        @endif
                                        @if($booking->booking_status == 1)
                                            <a href="{{route('invoicedetail.edit', $booking->id)}}"><button class="btn btn-info">Check-in</button></a>
                                        @endif
                                        @if($booking->booking_status == 2)
                                            <a href="{{route('invoice.restore', $booking->id)}}"><button class="btn btn-light">Check-out</button></a>
                                        @endif
                                        @if($booking->invoice_id)
                                            <a href="{{route('invoicedetail.index', ['id' => $booking->invoice_id])}}"><button class="btn btn-secondary">Chi tiết</button></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->


        <!-- Footer Start -->
        @include('layout.footer')
        <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
