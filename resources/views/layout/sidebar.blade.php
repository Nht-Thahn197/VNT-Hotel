<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{route('dashboard')}}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-success"><i class="fa fa-user-edit me-2"></i>H2T Hotel</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{asset('img/admin11.jpg')}}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ optional(session('admin'))->name ?? 'Admin' }}</h6>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{route('dashboard')}}" class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa fa-home me-2"></i>Trang chủ</a>
            <a href="{{route('admin.index')}}" class="nav-item nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}"><i class="fa fa-user-tie me-2"></i>Nhân viên</a>
            <a href="{{route('customer.index')}}" class="nav-item nav-link {{ request()->routeIs('customer.*') ? 'active' : '' }}"><i class="fa fa-user-friends me-2"></i>Khách hàng</a>
            <a href="{{route('booking.index')}}" class="nav-item nav-link {{ request()->routeIs('booking.*') ? 'active' : '' }}"><i class="fa fa-calendar-check me-2"></i>Đặt phòng</a>
            <a href="{{route('invoice.index')}}" class="nav-item nav-link {{ request()->routeIs('invoice.*') || request()->routeIs('invoicedetail.*') ? 'active' : '' }}"><i class="fa fa-file-invoice me-2"></i>Hóa đơn</a>
            <a href="{{route('room.index')}}" class="nav-item nav-link {{ request()->routeIs('room.*') ? 'active' : '' }}"><i class="fa fa-bed me-2"></i>Phòng</a>
            <a href="{{route('floor.index')}}" class="nav-item nav-link {{ request()->routeIs('floor.*') ? 'active' : '' }}"><i class="fa fa-layer-group me-2"></i>Tầng</a>
            <a href="{{route('typeroom.index')}}" class="nav-item nav-link {{ request()->routeIs('typeroom.*') ? 'active' : '' }}"><i class="fa fa-tags me-2"></i>Loại phòng</a>
            <a href="{{route('service.index')}}" class="nav-item nav-link {{ request()->routeIs('service.*') ? 'active' : '' }}"><i class="fa fa-concierge-bell me-2"></i>Dịch vụ</a>
        </div>
    </nav>
</div>
