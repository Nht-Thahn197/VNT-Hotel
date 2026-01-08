@php
    $Price = \App\Models\InvoiceDetailed::where('id', 4)
        ->sum(DB::raw('Price * DATEDIFF(time_end, time_start)'));
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booking - H2T Hotel</title>
    <link href="{{asset('img/icon2.jpg')}}" rel="icon">
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

    <h1 class="heading">my bookings</h1>

    <div class="box-container">
        @foreach($orders as $order)
        <div class="box">
            <p>booking id : <span>{{$order -> invoice_id}}</span></p>
            <p>name : <span>{{ $order -> customer_name }}</span></p>
            <p>email :  <span>{{$order -> email}}</span></p>
            <p>number :  <span>{{$order -> phone}}</span></p>
            <p>People : <span>{{$order -> total}}</span></p>
            <p>rooms : <span>{{$order -> room_name}}</span></p>
            <p>check in :  <span>{{$order -> time_start }}</span></p>
            <p>check out :   <span>{{$order -> time_end}}</span></p>
            <p>status :<span>
                @if($order->status == 0)
                    {{ "Unconfimred" }}
                @elseif($order->status == 1)
                    {{ "Confirmed" }}
                @elseif($order->status == 2)
                    {{ "Paid" }}
                @elseif($order->status == 3)
                    {{ "Checked out" }}
                @elseif($order->status == 4)
                    {{ "Cancel" }}
                @endif
                </span></p>
            <p>Price(1 day) : <span>{{ number_format($Price) }} VND</span></p>
            <form action="" method="POST">
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <a href="{{ route('cancel.booking', ['order_id' => $order->invoice_id]) }}" value="cancel this booking" name="cancel" class="btn" onclick="return confirm('cancel this booking?');">Cancel Booking</a>
            </form>
        </div>
        @endforeach
        <div class="box" style="text-align: center;">
            <p style="padding-bottom: .5rem; text-transform:capitalize;">Book additional rooms!</p>
            <a href="../../home#reservation" class="btn">book new</a>
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
