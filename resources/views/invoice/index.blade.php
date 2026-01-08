<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List of Invoice - H2T Hotel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/icon2.jpg" rel="icon">

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
                        <h6 class="mb-4">List of Invoice</h6>
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Method</th>
                                <th>Name Customer</th>
                                <th>Detail</th>
                                <th>Service Booked</th>
                                <th></th>
                                <th>Actice</th>
                                <th></th>

                            </tr>
                            </thead>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id}}</td>
                                    <td>
                                        @if($invoice->status == 0)
                                            {{ "Unconfimred" }}
                                        @elseif($invoice->status == 1)
                                            {{ "Confirmed" }}
                                        @elseif($invoice->status == 2)
                                            {{ "Paid" }}
                                        @elseif($invoice->status == 3)
                                            {{ "Checked out" }}
                                        @elseif($invoice->status == 4)
                                            {{ "Cancel" }}
                                        @endif
                                    </td>

                                    <td> @if($invoice->method == 0)
                                             {{'Not Paid'}}
                                        @elseif($invoice->method == 1)
                                             {{'Cash'}}
                                        @else
                                             {{'Tranfer'}}
                                    @endif</td>
                                    <td>{{ $invoice->customer_name}}</td>
                                    <td><a href="{{route('invoicedetail.index', ['id' => $invoice->id])}}"><button class="btn btn-info">Detail</button></a> </td>
                                    <td><a href="{{route('serviceinvoice.index')}}"><button class="btn btn-info">Show</button></a> </td>
                                    <td><a href="{{route('invoice.updateStatus', $invoice->id)}}"><button class="btn btn-success">Xác nhận</button></a> </td>
                                    <td><a href="{{route('invoice.mini', $invoice->id)}}"><button class="btn btn-primary">Thanh toán</button></a></td>
                                    <td><a href="{{route('invoice.restore', $invoice->id)}}"><button class="btn btn-light">Trả phòng</button></a></td>

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
