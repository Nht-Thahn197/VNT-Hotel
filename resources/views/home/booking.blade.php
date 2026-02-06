<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt phòng - Khách sạn Việt Thành</title>
    <link href="{{asset('favicon-home.ico')}}" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('css/style2.css')}}">

</head>
<body>

@include('layout.user_header')

    <!-- booking section starts  -->

<section class="bookings">

    <h1 class="heading">Phòng đã đặt</h1>

    <div class="box-container">
        @foreach($orders as $order)
        <div class="box">
            <p>Mã đặt phòng : <span>{{$order -> booking_id}}</span></p>
            <p>Tên : <span>{{ $order -> customer_name }}</span></p>
            <p>Email :  <span>{{$order -> email}}</span></p>
            <p>Số điện thoại :  <span>{{$order -> phone}}</span></p>
            <p>Loại phòng : <span>{{$order -> room_type_name}}</span></p>
            <p>Phòng : <span>{{ $order -> room_name ?? 'Chưa gắn' }}</span></p>
            <p>Check in :  <span>{{$order -> time_start }}</span></p>
            <p>Check out :   <span>{{$order -> time_end}}</span></p>
            <p>Trạng thái :<span>
                @if($order->booking_status == 0)
    {{ "Cho xac nhan" }}
@elseif($order->booking_status == 1)
    {{ "Da xac nhan / giu phong" }}
@elseif($order->booking_status == 2)
    {{ "Da nhan phong" }}
@elseif($order->booking_status == 3)
    {{ "Da tra phong" }}
@elseif($order->booking_status == 4)
    {{ "Da huy" }}
@elseif($order->booking_status == 5)
    {{ "Khach khong den" }}
@endif
                </span></p>
            <p>Thanh toán :<span>
                @if($order->invoice_status === null)
    {{ "Chua lap hoa don" }}
@elseif($order->invoice_status == 0)
    {{ "Tam tinh" }}
@elseif($order->invoice_status == 1)
    {{ "Chua thanh toan" }}
@elseif($order->invoice_status == 2)
    {{ "Da thanh toan" }}
@elseif($order->invoice_status == 3)
    {{ "Da hoan tien" }}
@elseif($order->invoice_status == 4)
    {{ "Huy hoa don" }}
@endif
            </span></p>
            @if(in_array($order->booking_status, [0, 1]))
            <form action="" method="POST">
                <input type="hidden" name="order_id" value="{{ $order->booking_id }}">
                <a href="{{ route('cancel.booking', ['order_id' => $order->booking_id]) }}" value="cancel this booking" name="cancel" class="btn" onclick="return confirm('cancel this booking?');">Cancel Booking</a>
            </form>
            @endif
        </div>
        @endforeach
        <div class="box" style="text-align: center;">
            <p style="padding-bottom: .5rem; text-transform:capitalize;">Đặt phòng mới</p>
            <a href="../../home#reservation" class="btn">Đặt phòng</a>
        </div>

    </div>

</section>

<!-- booking section ends -->

@include('layout.user_footer')

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="{{asset('js/script.js')}}"></script>

</body>
</html>


