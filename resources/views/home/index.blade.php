<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Khách sạn Việt Thành</title>

    <link href="{{asset('favicon-home.ico')}}" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('css/style2.css')}}">
</head>
<body>

<section class="header">
    <div class="flex">
        <a href="{{route('home.index')}}" class="logo">Khách sạn Việt Thành</a>
        @if(session()->has('customer'))
        <a href="{{route('customer.logout')}}" class="btn">Đăng xuất</a>
        @else
        <a href="{{route('customer.login')}}" class="btn">Đăng nhập</a>
        @endif
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>

    <nav class="navbar">
        <a href="home#home">Trang chủ</a>
        <a href="home#about">Giới thiệu</a>
        <a href="home#reservation">Đặt phòng</a>
        <a href="home#gallery">Thư Viện ảnh</a>
        <a href="home#contact">Liên hệ</a>
        <a href="home#reviews">Đánh giá</a>
        @if(session()->has('customer'))
        <a href="{{route('home.booking', session('customer')->id)}}">Lịch sử</a>
        @endif
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
                    <h3>Thức ăn và đồ uống</h3>
                    <a href="#reservation" class="btn">Đặt Phòng</a>
                </div>
            </div>
            <div class="box swiper-slide">
                <img src="{{asset('img/home-img-3.jpg')}}" alt="">
                <div class="flex">
                    <h3>Hội trường sang trọng</h3>
                    <a href="#contact" class="btn">Liên hệ</a>
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
            <h3>Nhân viên thân thiện</h3>
            <p>Đội ngũ nhân viên chuyên nghiệp, thân thiện và nhiệt tình phục vụ khách hàng.</p>
            <a href="#reservation" class="btn">Đặt phòng</a>
        </div>
    </div>
    <div class="row revers">
        <div class="image">
            <img src="{{asset('img/about-img-2.jpg')}}" alt="">
        </div>
        <div class="content">
            <h3>Đồ ăn ngon nhất</h3>
            <p>Thực đơn đa dạng với các món ăn truyền thống và hiện đại, được chế biến bởi đầu bếp chuyên nghiệp.</p>
            <a href="#contact" class="btn">Liên hệ</a>
        </div>
    </div>
    <div class="row">
        <div class="image">
            <img src="{{asset('img/about-img-3.jpg')}}" alt="">
        </div>
        <div class="content">
            <h3>Tiệc bể bơi</h3>
            <p>Không gian tiệc bể bơi sang trọng, lý tưởng cho các sự kiện đặc biệt và buổi tiệc ngoài trời.</p>
            <a href="#availability" class="btn">Tham khảo</a>
        </div>
    </div>
</section>
<!-- about section ends -->
<!-- services section starts  -->
<section class="services">
    <div class="box-container">
        <div class="box">
            <img src="{{asset('img/icon-1.png')}}" alt="">
            <h3>Thức ăn & đồ uống</h3>
            <p>Thực đơn đa dạng với các món ăn truyền thống và hiện đại, được chế biến bởi đầu bếp chuyên nghiệp.</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-2.png')}}" alt="">
            <h3>Ăn ngoài trời</h3>
            <p>Không gian ăn ngoài trời sang trọng, lý tưởng cho các bữa tiệc và sự kiện ngoài trời.</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-3.png')}}" alt="">
            <h3>Khung cảnh bãi biển</h3>
            <p>Khung cảnh biển tuyệt đẹp, mang lại cảm giác thư giãn và yên bình cho khách hàng.</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-4.png')}}" alt="">
            <h3>Trang trí</h3>
            <p>Không gian trang trí tinh tế, tạo nên sự sang trọng và ấm cúng cho mọi dịp.</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-5.png')}}" alt="">
            <h3>Tiệc bể bơi</h3>
            <p>Không gian bể bơi hiện đại, lý tưởng cho các hoạt động thể thao và thư giãn.</p>
        </div>
        <div class="box">
            <img src="{{asset('img/icon-6.png')}}" alt="">
            <h3>Resort biển</h3>
            <p>Khung cảnh resort biển tuyệt đẹp, mang lại cảm giác thư giãn và yên bình cho khách hàng.</p>
        </div>
    </div>
</section>
<!-- services section ends -->
<!-- reservation section starts  -->
<section class="reservation" id="reservation">
    @if(session()->has('customer'))
    <form action="{{ route('home.store') }}" method="post">
        @csrf
        <h3>Đặt phòng</h3>
        <div class="flex">
            <div class="box">
                <p>Họ & tên:<span>*</span></p>
                <input value="{{session('customer')->name}}" type="text" name="name" maxlength="50" required readonly class="input">
            </div>
            <div class="box">
                <p>Email:<span>*</span></p>
                <input value="{{session('customer')->email}}" type="text" name="email" maxlength="50" required readonly class="input">
            </div>
            <div class="box">
                <p>Số điện thoại:<span>*</span></p>
                <input value="{{session('customer')->phone}}" type="text" name="phone" maxlength="50" required readonly class="input">
            </div>
            <div class="box">
                <p>Check in <span>*</span></p>
                <input type="datetime-local" name="check_in" class="input" required>
            </div>
            <div class="box">
                <p>Check out <span>*</span></p>
                <input type="datetime-local" name="check_out" class="input" required>
            </div>
            <div class="box">
                <p>Số người <span>*</span></p>
                <select name="people" class="input" required>
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="box">
                <p>Loại phòng <span>*</span></p>
                <select name="roomtype_id" class="input" required>
                    @foreach($typerooms as $typeroom)
                        <option value="{{ $typeroom->id }}">
                            {{ $typeroom->name }} - {{ number_format($typeroom->price_night) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <input type="submit" value="Đặt phòng" name="book" class="btn">
    </form>
    @else
    <div style="padding:16px 0;">
        <a href="{{route('customer.login')}}" class="btn">Đăng nhập để đặt phòng</a>
    </div>
    @endif
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
        <form action="{{ route('contact.store') }}" method="post">
            @csrf
            <h3>Liên hệ với chúng tôi</h3>
            <input type="text" name="name" required maxlength="50" placeholder="Nhập họ tên của bạn" class="box">
            <input type="email" name="email" required maxlength="50" placeholder="Nhập email của bạn" class="box">
            <input type="number" name="number" required maxlength="10" min="0" max="9999999999" placeholder="Nhập số điện thoại của bạn" class="box">
            <textarea name="message" class="box" required maxlength="1000" placeholder="Nhập tin nhắn của bạn" cols="30" rows="10"></textarea>
            <input type="submit" value="Gửi tin nhắn" name="send" class="btn">
        </form>
        <div class="faq">
            <h3 class="title">Câu hỏi thường gặp</h3>
            <div class="box active">
                <h3>Hủy đặt phòng thế nào?</h3>
                <p>Để hủy đặt phòng, bạn cần liên hệ với chúng tôi qua số điện thoại hoặc email trong vòng 24 giờ kể từ thời điểm đặt phòng. Chúng tôi sẽ xử lý yêu cầu hủy phòng của bạn trong vòng 24 giờ làm việc.</p>
            </div>
            <div class="box">
                <h3>Có phòng trống không?</h3>
                <p>Chúng tôi luôn cập nhật tình trạng phòng trống. Bạn có thể kiểm tra tình trạng phòng trống khi đặt phòng hoặc liên hệ với chúng tôi qua số điện thoại hoặc email.</p>
            </div>
            <div class="box">
                <h3>Phương thức thanh toán?</h3>
                <p>Chúng tôi chấp nhận nhiều phương thức thanh toán như tiền mặt, chuyển khoản ngân hàng, và các phương thức thanh toán trực tuyến.</p>
            </div>
            <div class="box">
                <h3>Làm thế nào để sử dụng mã giảm giá?</h3>
                <p>Khi đặt phòng, bạn có thể nhập mã giảm giá vào ô "Mã giảm giá" trong phần đặt phòng. Mã giảm giá sẽ được áp dụng vào tổng số tiền thanh toán của bạn.</p>
            </div>
            <div class="box">
                <h3>Độ tuổi tối thiểu?</h3>
                <p>Khách hàng từ 18 tuổi trở lên mới có thể đặt phòng. Nếu bạn là trẻ em dưới 18 tuổi, bạn cần có sự đồng ý của người giám hộ.</p>
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
                <p>Chúng tôi luôn cung cấp dịch vụ tốt nhất cho khách hàng.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-2.png')}}" alt="">
                <h3>Hoàng Thụ</h3>
                <p>Chúng tôi luôn cung cấp dịch vụ tốt nhất cho khách hàng.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-3.png')}}" alt="">
                <h3>john deo</h3>
                <p>Chúng tôi luôn cung cấp dịch vụ tốt nhất cho khách hàng.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-4.png')}}" alt="">
                <h3>john deo</h3>
                <p>Chúng tôi luôn cung cấp dịch vụ tốt nhất cho khách hàng.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-5.png')}}" alt="">
                <h3>john deo</h3>
                <p>Chúng tôi luôn cung cấp dịch vụ tốt nhất cho khách hàng.</p>
            </div>
            <div class="swiper-slide box">
                <img src="{{asset('img/pic-6.png')}}" alt="">
                <h3>john deo</h3>
                <p>Chúng tôi luôn cung cấp dịch vụ tốt nhất cho khách hàng.</p>
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
@if(session('contact_success'))
<script>
    swal("Thành công", "{{ session('contact_success') }}", "success");
</script>
@endif
</body>
</html>
