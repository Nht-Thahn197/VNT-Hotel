<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - H2T Hotel</title>

    <link href="img/icon2.jpg" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('css/style2.css')}}">
</head>
<body>

<section class="header">
    <div class="flex">
        <a href="{{route('home.index')}}" class="logo">H2T Hotel</a>
        <a href="{{route('customer.login')}}" class="btn">Log out</a>
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>

    <nav class="navbar">
        <a href="home#home">home</a>
        <a href="home#about">about</a>
        <a href="home#reservation">reservation</a>
        <a href="home#gallery">gallery</a>
        <a href="home#contact">contact</a>
        <a href="home#reviews">reviews</a>
        @foreach($customers as $customer)
        <a href="{{route('home.booking', $customer->id)}}">my bookings</a>
        @endforeach
    </nav>
</section>
    <!-- home section starts  -->
<section class="home" id="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
{{--            <div class="box swiper-slide">--}}
{{--                <img src="{{asset('img/home-img-1.jpg')}}" alt="">--}}
{{--                <div class="flex">--}}
{{--                    <h3>luxurious rooms</h3>--}}
{{--                    <a href="#availability" class="btn">check availability</a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="box swiper-slide">
                <img src="{{asset('img/home-img-2.jpg')}}" alt="">
                <div class="flex">
                    <h3>foods and drinks</h3>
                    <a href="#reservation" class="btn">make a reservation</a>
                </div>
            </div>
            <div class="box swiper-slide">
                <img src="{{asset('img/home-img-3.jpg')}}" alt="">
                <div class="flex">
                    <h3>luxurious halls</h3>
                    <a href="#contact" class="btn">contact us</a>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<!-- home section ends -->
<!-- availability section starts  -->
{{--<section class="availability" id="availability">--}}
{{--    <form action="" method="post">--}}
{{--        <div class="flex">--}}
{{--            <div class="box">--}}
{{--                <p>check in <span>*</span></p>--}}
{{--                <input type="date" name="check_in" class="input" required>--}}
{{--            </div>--}}
{{--            <div class="box">--}}
{{--                <p>check out <span>*</span></p>--}}
{{--                <input type="date" name="check_out" class="input" required>--}}
{{--            </div>--}}
{{--            <div class="box">--}}
{{--                <p>People <span>*</span></p>--}}
{{--                <select name="adults" class="input" required>--}}
{{--                    <option value="1">1 people</option>--}}
{{--                    <option value="2">2 people</option>--}}
{{--                    <option value="3">3 people</option>--}}
{{--                    <option value="4">4 people</option>--}}
{{--                    <option value="5">5 people</option>--}}
{{--                    <option value="6">6 people</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="box">--}}
{{--                <p>Payment Method <span>*</span></p>--}}
{{--                <select name="method" class="input" required>--}}
{{--                    <option value="-">Unpaid</option>--}}
{{--                    <option value="1">Cash</option>--}}
{{--                    <option value="2">Tranfer</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="box">--}}
{{--                <p>rooms <span>*</span></p>--}}
{{--                <select name="rooms" class="input" required>--}}
{{--                    <option value="1">1 room</option>--}}
{{--                    <option value="2">2 rooms</option>--}}
{{--                    <option value="3">3 rooms</option>--}}
{{--                    <option value="4">4 rooms</option>--}}
{{--                    <option value="5">5 rooms</option>--}}
{{--                    <option value="6">6 rooms</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <input type="submit" value="check availability" name="check" class="btn">--}}
{{--    </form>--}}
{{--</section>--}}
<!-- availability section ends -->
<!-- about section starts  -->
<section class="about" id="about">
    <div class="row">
        <div class="image">
            <img src="{{asset('img/about-img-1.jpg')}}" alt="">
        </div>
        <div class="content">
            <h3>best staff</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi laborum maxime eius aliquid temporibus unde?</p>
            <a href="#reservation" class="btn">make a reservation</a>
        </div>
    </div>
    <div class="row revers">
        <div class="image">
            <img src="{{asset('img/about-img-2.jpg')}}" alt="">
        </div>
        <div class="content">
            <h3>best foods</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi laborum maxime eius aliquid temporibus unde?</p>
            <a href="#contact" class="btn">contact us</a>
        </div>
    </div>
    <div class="row">
        <div class="image">
            <img src="{{asset('img/about-img-3.jpg')}}" alt="">
        </div>
        <div class="content">
            <h3>swimming pool</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi laborum maxime eius aliquid temporibus unde?</p>
            <a href="#availability" class="btn">check availability</a>
        </div>
    </div>
</section>
<!-- about section ends -->
<!-- services section starts  -->
<section class="services">
    <div class="box-container">
        <div class="box">
            <img src="{{asset('img/icon-1.png')}}" alt="">
            <h3>food & drinks</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, sunt?</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-2.png')}}" alt="">
            <h3>outdoor dining</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, sunt?</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-3.png')}}" alt="">
            <h3>beach view</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, sunt?</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-4.png')}}" alt="">
            <h3>decorations</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, sunt?</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-5.png')}}" alt="">
            <h3>swimming pool</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, sunt?</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-6.png')}}" alt="">
            <h3>resort beach</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, sunt?</p>
        </div>
    </div>
</section>
<!-- services section ends -->
<!-- reservation section starts  -->
<section class="reservation" id="reservation">
    <form action="{{ route('home.store') }}" method="post">
        @csrf
        <h3>make a reservation</h3>
        <div class="flex">
            @foreach($customers as $customer)
                <div class="box">
                    <p>your name:<span>*</span></p>
                    <input value="{{$customer->name}}" type="text" name="name" maxlength="50" required placeholder="enter your name" class="input">
                </div>
            <div class="box">
                <p>Your Email:</p>
                <input value="{{$customer->email}}" type="text" name="name" maxlength="50" required placeholder="enter your name" class="input">
            </div>
            <div class="box">
                <p>Your Phone Number:</p>
                <input value="{{$customer->phone}}" type="text" name="name" maxlength="50" required placeholder="enter your name" class="input">
            </div>
                @endforeach
            <div class="box">
                <p>check in <span>*</span></p>
                <input type="datetime-local" name="check_in" class="input" required>
            </div>
            <div class="box">
                <p>check out <span>*</span></p>
                <input type="datetime-local" name="check_out" class="input" required>
            </div>
            <div class="box">
                <p>People <span>*</span></p>
                <select name="people" class="input" required>
                    <option value="1" selected>1 People</option>
                    <option value="2">2 people</option>
                    <option value="3">3 people</option>
                    <option value="4">4 people</option>
                    <option value="5">5 people</option>
                    <option value="6">6 people</option>
                </select>
            </div>
            <div class="box">
                <p>Type Room <span>*</span></p>
                <select name="roomtype_id" class="input" required>
                    @foreach($typerooms as $typeroom)
                        @if($typeroom->id != 2)
                            <option value="{{ $typeroom->id }}">
                                {{ $typeroom->name }} - {{ number_format($typeroom->price)  }} (1 day) VND
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="box">
                <p>Payment Method <span>*</span></p>
                <select name="paymentmethod" class="input" required>
                    <option value="0" selected>Chưa Thanh Toán</option>
                    <option value="1">Cash</option>
                    <option value="2">Tranfer</option>
                </select>
            </div>
        </div>
        <input type="submit" value="book now" name="book" class="btn">
    </form>
</section>
<!-- reservation section ends -->
<!-- gallery section starts  -->
<section class="gallery" id="gallery">
    <div class="swiper gallery-slider">
        <div class="swiper-wrapper">
            <img src="{{asset('img/gallery-img-1.jpg')}}" class="swiper-slide" alt="">
            <img src="{{asset('img/gallery-img-2.webp')}}" class="swiper-slide" alt="">
            <img src="{{asset('img/gallery-img-3.webp')}}" class="swiper-slide" alt="">
            <img src="{{asset('img/gallery-img-4.webp')}}" class="swiper-slide" alt="">
            <img src="{{asset('img/gallery-img-5.webp')}}" class="swiper-slide" alt="">
            <img src="{{asset('img/gallery-img-6.webp')}}" class="swiper-slide" alt="">
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- gallery section ends -->
<!-- contact section starts  -->
<section class="contact" id="contact">
    <div class="row">
        <form action="" method="post">
            <h3>send us message</h3>
            <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
            <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
            <input type="number" name="number" required maxlength="10" min="0" max="9999999999" placeholder="enter your number" class="box">
            <textarea name="message" class="box" required maxlength="1000" placeholder="enter your message" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>
        <div class="faq">
            <h3 class="title">frequently asked questions</h3>
            <div class="box active">
                <h3>how to cancel?</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus sunt aspernatur excepturi eos! Quibusdam, sapiente.</p>
            </div>
            <div class="box">
                <h3>is there any vacancy?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ipsam neque quaerat mollitia ratione? Soluta!</p>
            </div>
            <div class="box">
                <h3>what are payment methods?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ipsam neque quaerat mollitia ratione? Soluta!</p>
            </div>
            <div class="box">
                <h3>how to claim coupons codes?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ipsam neque quaerat mollitia ratione? Soluta!</p>
            </div>
            <div class="box">
                <h3>what are the age requirements?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ipsam neque quaerat mollitia ratione? Soluta!</p>
            </div>
        </div>
    </div>
</section>
<!-- contact section ends -->
<!-- reviews section starts  -->
<section class="reviews" id="reviews">
    <div class="swiper reviews-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide box">
                <img src="{{asset('img/admin1.jpg')}}" alt="">
                <h3>Nhật Thành</h3>
                <p>The Chairman of 2T Corporation, a leading company in Vietnam in services and distribution.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-2.png')}}" alt="">
                <h3>Hoàng Thụ</h3>
                <p>Production director of 2T company.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-3.png')}}" alt="">
                <h3>john deo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates blanditiis optio dignissimos eaque aliquid explicabo.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-4.png')}}" alt="">
                <h3>john deo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates blanditiis optio dignissimos eaque aliquid explicabo.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-5.png')}}" alt="">
                <h3>john deo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates blanditiis optio dignissimos eaque aliquid explicabo.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-6.png')}}" alt="">
                <h3>john deo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates blanditiis optio dignissimos eaque aliquid explicabo.</p>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- reviews section ends  -->

@include('layout.user_footer')

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- custom js file link  -->
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
