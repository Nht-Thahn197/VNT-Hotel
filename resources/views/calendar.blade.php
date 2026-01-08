<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Calender - H2T Hotel</title>
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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


        <!-- Widget Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-3">
                <div class="col-sm-12 col-md-12 col-xl-6">
                    <div class="h-100 bg-secondary rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0">Messages</h6>
                            <a href="">Show All</a>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-3">
                            <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">X</h6>
                                    <small>15 minutes ago</small>
                                </div>
                                <span>Short message goes here...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6">
                    <div class="h-100 bg-secondary rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Calender</h6>
                            <a href="">Show All</a>
                        </div>
                        <div id="calender"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <!--                        <div class="h-100 bg-secondary rounded p-4">-->
                    <!--                            <div class="d-flex align-items-center justify-content-between mb-4">-->
                    <!--                                <h6 class="mb-0">To Do List</h6>-->
                    <!--                                <a href="">Show All</a>-->
                    <!--                            </div>-->
                    <!--                            <div class="d-flex mb-2">-->
                    <!--                                <input class="form-control bg-transparent" type="text" placeholder="Enter task">-->
                    <!--                                <button type="button" class="btn btn-primary ms-2">Add</button>-->
                    <!--                            </div>-->
                    <!--                            <div class="d-flex align-items-center border-bottom py-2">-->
                    <!--                                <input class="form-check-input m-0" type="checkbox">-->
                    <!--                                <div class="w-100 ms-3">-->
                    <!--                                    <div class="d-flex w-100 align-items-center justify-content-between">-->
                    <!--                                        <span>Short task goes here...</span>-->
                    <!--                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="d-flex align-items-center border-bottom py-2">-->
                    <!--                                <input class="form-check-input m-0" type="checkbox">-->
                    <!--                                <div class="w-100 ms-3">-->
                    <!--                                    <div class="d-flex w-100 align-items-center justify-content-between">-->
                    <!--                                        <span>Short task goes here...</span>-->
                    <!--                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="d-flex align-items-center border-bottom py-2">-->
                    <!--                                <input class="form-check-input m-0" type="checkbox" checked>-->
                    <!--                                <div class="w-100 ms-3">-->
                    <!--                                    <div class="d-flex w-100 align-items-center justify-content-between">-->
                    <!--                                        <span><del>Short task goes here...</del></span>-->
                    <!--                                        <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="d-flex align-items-center border-bottom py-2">-->
                    <!--                                <input class="form-check-input m-0" type="checkbox">-->
                    <!--                                <div class="w-100 ms-3">-->
                    <!--                                    <div class="d-flex w-100 align-items-center justify-content-between">-->
                    <!--                                        <span>Short task goes here...</span>-->
                    <!--                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="d-flex align-items-center pt-2">-->
                    <!--                                <input class="form-check-input m-0" type="checkbox">-->
                    <!--                                <div class="w-100 ms-3">-->
                    <!--                                    <div class="d-flex w-100 align-items-center justify-content-between">-->
                    <!--                                        <span>Short task goes here...</span>-->
                    <!--                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                </div>

                <div class="col-sm-6 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <iframe class="position-relative rounded w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3726.0095758312573!2d105.73904657432033!3d20.952130590407936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjDCsDU3JzA3LjciTiAxMDXCsDQ0JzI5LjgiRQ!5e0!3m2!1sen!2sus!4v1693489453217!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">"
                            frameborder="0" allowfullscreen="" aria-hidden="false"
                            tabindex="0" style="filter: grayscale(100%) invert(92%) contrast(83%); border: 0;"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widget End -->


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
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>
