<!-- header section starts  -->

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
        <a href="{{route('home.index')}}">Trang chủ</a>
        <a href="{{route('home.index')}}#about">Giới thiệu</a>
        <a href="{{route('home.index')}}#reservation">Đặt phòng</a>
        <a href="{{route('home.index')}}#gallery">Thư viện ảnh</a>
        <a href="{{route('home.index')}}#contact">Liên hệ</a>
        <a href="{{route('home.index')}}#reviews">Đánh giá</a>
        @if(session()->has('customer'))
        <a href="{{route('home.booking', session('customer')->id)}}">Lịch sử</a>
        @endif
    </nav>

</section>

<!-- header section ends -->
