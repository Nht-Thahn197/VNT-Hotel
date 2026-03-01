<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thu ngân - VNT Hotel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{asset('favicon-home.ico')}}" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/cashier.css') }}" rel="stylesheet">
</head>
<body class="cashier-body" data-selected-room-id="{{ $selectedRoomId ?? 0 }}">
<div class="cashier-layout">
    <div class="cashier-left">
        <div class="cashier-left-header">
            <div class="cashier-tabs">
                <button class="cashier-tab is-active" type="button" data-tab="rooms">
                    <i class="fa-solid fa-bed"></i> Phòng
                </button>
                <button class="cashier-tab" type="button" data-tab="services">
                    <i class="fa-solid fa-concierge-bell"></i> Dịch vụ
                </button>
                <button class="cashier-tab" type="button" data-tab="bookings">
                    <i class="fa-regular fa-calendar-check"></i> Đặt trước
                </button>
            </div>
            <div class="cashier-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="cashier-search" type="text" placeholder="Tìm phòng / dịch vụ / khách">
            </div>
        </div>

        <div class="cashier-left-body">
            <div class="cashier-panel is-active" data-panel="rooms">
                <div class="cashier-section">
                    <div class="floor-chips">
                        <button class="chip is-active" type="button" data-floor="all">Tất cả</button>
                        @foreach($floors as $floor)
                            <button class="chip" type="button" data-floor="{{ $floor->id }}">{{ $floor->name }}</button>
                        @endforeach
                    </div>
                    <div class="status-filters">
                        <label>
                            <input type="radio" name="room-status" value="all" checked> Tất cả
                        </label>
                        <label>
                            <input type="radio" name="room-status" value="available"> Còn trống
                        </label>
                        <label>
                            <input type="radio" name="room-status" value="occupied"> Đang sử dụng
                        </label>
                    </div>
                </div>

                <div class="room-grid">
                    @forelse($rooms as $room)
                        @php
                            $status = (int) $room->status;
                            $statusLabels = [
                                0 => 'Còn trống',
                                1 => 'Đã đặt',
                                2 => 'Đang sử dụng',
                                3 => 'Đang dọn',
                                4 => 'Bảo trì',
                                5 => 'Ngừng sử dụng',
                            ];
                            $statusLabel = $statusLabels[$status] ?? 'Không rõ';
                            $isAvailable = $status === 0;
                            $occupancy = $isAvailable ? 'available' : 'occupied';
                            $statusClass = $isAvailable ? 'is-available' : 'is-occupied';
                            if ($status === 1) {
                                $statusClass = 'is-reserved';
                            } elseif ($status === 3) {
                                $statusClass = 'is-cleaning';
                            } elseif ($status === 4 || $status === 5) {
                                $statusClass = 'is-maintenance';
                            }
                            $floorLabel = $room->floor_name ?? ($room->floor_id ? 'Tầng ' . $room->floor_id : 'Chưa gán tầng');
                            $searchText = strtolower(trim(($room->name ?? '') . ' ' . ($room->room_type_name ?? '') . ' ' . $floorLabel));
                            $roomNumber = null;
                            if (!empty($room->name) && preg_match('/\d+/', $room->name, $matches)) {
                                $roomNumber = (int) $matches[0];
                            }
                            $roomPage = ($roomNumber !== null && $roomNumber > 506) ? 2 : 1;
                            $activeStart = $room->booking_time_start ?? null;
                            $activeEnd = $room->booking_time_end ?? null;
                            $reservedStart = $room->reserved_time_start ?? null;
                            $reservedEnd = $room->reserved_time_end ?? null;
                            $roomCheckinAt = $room->room_checkin_at ?? null;
                            $hasReserved = !empty($reservedStart) || !empty($reservedEnd);
                            $hasActive = !empty($activeStart);
                            $displayMode = $hasReserved && !$hasActive ? 'reserved' : 'active';
                            $showUsageLine = false;
                            if ($hasReserved || $hasActive) {
                                $occupancy = 'occupied';
                                if ($status === 0) {
                                    $statusLabel = $hasReserved ? 'Đã đặt' : 'Đang sử dụng';
                                    $statusClass = $hasReserved ? 'is-reserved' : 'is-occupied';
                                }
                            }
                            $usageHours = 0;
                            $usageLabel = '';
                            if ($displayMode === 'active') {
                                $startAtValue = $activeStart ?: $roomCheckinAt;
                                $showUsageLine = ($status === 2 || $hasActive || !empty($roomCheckinAt));
                                if ($showUsageLine) {
                                    if (!empty($startAtValue)) {
                                        $startAt = \Carbon\Carbon::parse($startAtValue);
                                        $now = now();
                                        if ($startAt->lessThanOrEqualTo($now)) {
                                            $usageMinutes = $startAt->diffInMinutes($now);
                                        } else {
                                            $usageMinutes = 0;
                                        }
                                    } else {
                                        $usageMinutes = 0;
                                    }

                                    if ($usageMinutes < 60) {
                                        $usageLabel = $usageMinutes . 'p';
                                    } else {
                                        $hours = intdiv($usageMinutes, 60);
                                        $minutes = $usageMinutes % 60;
                                        $usageLabel = sprintf('%dh%02dp', $hours, $minutes);
                                    }
                                }
                            }

                            $roomPriceHour = (float) ($room->room_price_hour ?? 0);
                            $roomPriceOvernight = (float) ($room->room_price_overnight ?? 0);
                            $roomPriceNight = (float) ($room->room_price_night ?? 0);
                            $roomCharge = $roomPriceNight;
                            $checkoutLabel = '';

                            if (!$hasReserved && !$hasActive && $status === 0) {
                                $roomCharge = 0;
                            }

                            if ($hasReserved) {
                                $startValue = $reservedStart ? \Carbon\Carbon::parse($reservedStart) : null;
                                $endValue = $reservedEnd ? \Carbon\Carbon::parse($reservedEnd) : null;
                                if ($endValue) {
                                    $checkoutLabel = $endValue->format('H:i d/m');
                                }
                                if ($startValue && $endValue) {
                                    $durationSeconds = $endValue->getTimestamp() - $startValue->getTimestamp();
                                    if ($durationSeconds <= 0) {
                                        $roomCharge = $roomPriceNight;
                                    } else {
                                        $hours = $durationSeconds / 3600;
                                        $startHour = (int) $startValue->format('H');
                                        $endHour = (int) $endValue->format('H');
                                        $isOvernight = ($startValue->format('Y-m-d') != $endValue->format('Y-m-d')) && ($startHour >= 21) && ($endHour <= 8);
                                        if ($hours < 6) {
                                            $quantity = (int) ceil($hours);
                                            $roomCharge = $quantity * $roomPriceHour;
                                        } elseif ($isOvernight) {
                                            $roomCharge = $roomPriceOvernight;
                                        } elseif ($hours >= 24) {
                                            $quantity = (int) ceil($hours / 24);
                                            $roomCharge = $quantity * $roomPriceNight;
                                        } else {
                                            $roomCharge = $roomPriceNight;
                                        }
                                    }
                                }
                            }
                        @endphp
                        <div class="room-card {{ ($selectedRoomId ?? 0) == (int) $room->id ? 'is-selected' : '' }}"
                             data-room-id="{{ $room->id }}"
                             data-room-name="{{ $room->name ?? '' }}"
                             data-floor="{{ $room->floor_id ?? 'unknown' }}"
                             data-status="{{ $occupancy }}"
                             data-status-code="{{ $status }}"
                             data-page="{{ $roomPage }}"
                             data-room-price="{{ $roomCharge }}"
                             data-name="{{ $searchText }}">
                            <div class="room-top">
                                <div class="room-title">{{ $room->name ?? 'Phòng' }}</div>
                                <div class="room-pill {{ $statusClass }}">{{ $statusLabel }}</div>
                            </div>
                            <div class="room-meta">
                                @if($displayMode === 'reserved')
                                    <span>Check out: {{ $checkoutLabel ?: '--' }}</span>
                                    @if(!empty($reservedStart) && !empty($reservedEnd))
                                        <span>Giá: {{ number_format($roomCharge) }} VNĐ</span>
                                    @endif
                                @elseif($showUsageLine)
                                    <span>Đã dùng: {{ $usageLabel }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Chưa có phòng.</div>
                    @endforelse
                </div>
                <div class="room-pagination-bottom">
                    <button class="page-btn" type="button" data-room-page="prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <span id="room-page-label">Trang 1 / 2</span>
                    <button class="page-btn" type="button" data-room-page="next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="empty-state is-hidden" data-empty="rooms">Không có phòng phù hợp.</div>
            </div>

            <div class="cashier-panel" data-panel="services">
                <div class="service-grid">
                    @forelse($services as $service)
                        @php
                            $image = $service->image ?? '';
                            $imageSrc = '';
                            if (!empty($image)) {
                                if (preg_match('/^https?:\\/\\//i', $image) || substr($image, 0, 1) === '/') {
                                    $imageSrc = $image;
                                } else {
                                    $imageSrc = asset('img/' . ltrim($image, '/'));
                                }
                            }
                            $searchText = strtolower(trim(($service->name ?? '') . ' ' . ($service->description ?? '')));
                        @endphp
                        <div class="service-card"
                             data-name="{{ $searchText }}"
                             data-service-id="{{ $service->id }}"
                             data-service-name="{{ $service->name ?? 'Dịch vụ' }}"
                             data-service-price="{{ $service->price ?? 0 }}">
                            <div class="service-media">
                                @if($imageSrc)
                                    <img src="{{ $imageSrc }}" alt="{{ $service->name ?? 'Dịch vụ' }}"
                                         onerror="this.style.display='none'; this.parentElement.classList.add('is-fallback');">
                                    <div class="service-fallback"><i class="fa-solid fa-mug-hot"></i></div>
                                @else
                                    <div class="service-fallback"><i class="fa-solid fa-mug-hot"></i></div>
                                @endif
                            </div>
                            <div class="service-body">
                                <div class="service-title">{{ $service->name ?? 'Dịch vụ' }}</div>
                                <div class="service-price">{{ number_format($service->price ?? 0) }} VNĐ</div>
                                @if(!empty($service->description))
                                    <div class="service-desc">{{ $service->description }}</div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Chưa có dịch vụ.</div>
                    @endforelse
                </div>
                <div class="empty-state is-hidden" data-empty="services">Không có dịch vụ phù hợp.</div>
            </div>

            <div class="cashier-panel" data-panel="bookings">
                <div class="booking-list">
                    @forelse($bookings as $booking)
                        @php
                            $start = $booking->time_start ? \Carbon\Carbon::parse($booking->time_start) : null;
                            $end = $booking->time_end ? \Carbon\Carbon::parse($booking->time_end) : null;
                            $searchText = strtolower(trim(($booking->customer_name ?? '') . ' ' . ($booking->room_name ?? '') . ' ' . ($booking->room_type_name ?? '')));
                        @endphp
                        <div class="booking-card {{ $booking->is_soon ? 'is-soon' : '' }}" data-name="{{ $searchText }}">
                            <div class="booking-time">
                                <div class="booking-hour">{{ $start ? $start->format('H:i') : '--:--' }}</div>
                                <div class="booking-date">{{ $start ? $start->format('d/m') : '' }}</div>
                            </div>
                            <div class="booking-info">
                                <div class="booking-name">{{ $booking->customer_name ?? 'Chưa rõ khách' }}</div>
                                <div class="booking-meta">
                                    <span>{{ $booking->room_name ?? 'Chưa gán phòng' }}</span>
                                    <span>{{ $booking->room_type_name ?? 'Chưa rõ loại phòng' }}</span>
                                    @if(!empty($booking->customer_phone))
                                        <span>{{ $booking->customer_phone }}</span>
                                    @endif
                                </div>
                                <div class="booking-range">
                                    {{ $start ? $start->format('d/m/Y H:i') : '' }} - {{ $end ? $end->format('d/m/Y H:i') : '' }}
                                </div>
                            </div>
                            @if($booking->is_soon)
                                <div class="booking-flag">Sắp đến {{ $booking->minutes_until ?? 0 }}p</div>
                            @endif
                        </div>
                    @empty
                        <div class="empty-state">Không có lịch đặt sắp tới.</div>
                    @endforelse
                </div>
                <div class="empty-state is-hidden" data-empty="bookings">Không có lịch đặt phù hợp.</div>
            </div>
        </div>
    </div>

    <aside class="cashier-right">
        <div class="order-head">
            <div class="order-title">#1</div>
            <div class="order-menu-wrap">
                <button class="order-menu" type="button" id="cashier-menu-toggle" aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="order-menu-dropdown" id="cashier-menu-dropdown">
                    <a href="{{ route('dashboard') }}">Quản lý</a>
                    <a href="{{ route('admin.logout') }}">Đăng xuất</a>
                </div>
            </div>
        </div>
        <div class="order-body">
            <div class="order-chip" id="cashier-selected-room">Chưa chọn phòng</div>
            <div class="order-items" id="cashier-order-items"></div>
            <div class="order-empty" id="cashier-order-empty">
                <h4>Chưa có dịch vụ trong đơn</h4>
                <p>Vui lòng chọn phòng hoặc dịch vụ ở bên trái.</p>
            </div>
        </div>
        <div class="order-footer">
            <div class="order-row">
                <span>Nhân viên</span>
                <strong>{{ optional(session('admin'))->name ?? 'Chưa xác định' }}</strong>
            </div>
            <div class="order-row">
                <span>Tổng tiền</span>
                <strong id="cashier-total">0</strong>
            </div>
            <div class="order-actions">
                <form id="cashier-checkin-form" method="post" action="{{ route('cashier.checkin') }}">
                    @csrf
                    <input type="hidden" name="room_id" id="cashier-room-id" value="">
                    <button class="order-btn" type="submit" id="cashier-status-btn">
                        <i class="fa-regular fa-bell"></i>
                        <span>Thông báo</span>
                    </button>
                </form>
                <button class="order-btn" type="button">
                    <i class="fa-regular fa-file-lines"></i> In tạm tính
                </button>
                <button class="order-btn primary" type="button" id="cashier-pay-btn">
                    <i class="fa-solid fa-credit-card"></i> Thanh toán
                </button>
            </div>
        </div>
        <div class="payment-drawer" id="cashier-payment-drawer" aria-hidden="true">
            <div class="payment-header">
                <div>
                    <h3>Thanh toán</h3>
                    <div class="payment-room" id="cashier-payment-room">Chưa chọn phòng</div>
                </div>
                <button class="drawer-close" type="button" id="cashier-payment-close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="payment-body">
                <div class="payment-row">
                    <span>Tổng tiền hàng</span>
                    <strong id="payment-subtotal">0</strong>
                </div>
                <div class="payment-row">
                    <span>Giảm giá</span>
                    <strong id="payment-discount">0</strong>
                </div>
                <div class="payment-row">
                    <span>Khuyến mãi</span>
                    <button class="payment-link" type="button">Chọn KM</button>
                </div>
                <div class="payment-row payment-total">
                    <span>Khách cần trả</span>
                    <strong id="payment-total">0</strong>
                </div>
                <div class="payment-methods">
                    <label>
                        <input type="radio" name="payment-method" value="cash" checked> Tiền mặt
                    </label>
                    <label>
                        <input type="radio" name="payment-method" value="transfer"> Chuyển khoản
                    </label>
                    <label>
                        <input type="radio" name="payment-method" value="card"> Thẻ
                    </label>
                </div>
                <div class="payment-qr is-hidden" id="payment-qr-box">
                    <div class="payment-qr-title">Quét mã để chuyển khoản</div>
                    <div class="payment-qr-card">
                        <img src="{{ asset('img/my-qr.jpg') }}" alt="QR thanh toán">
                    </div>
                    <div class="payment-qr-note">Ngân hàng MB - Nguyễn Phúc Nhật Thành</div>
                </div>
                <div class="payment-note is-hidden" id="payment-card-note">
                    Vui lòng dùng máy POS để thanh toán thẻ.
                </div>
            </div>
            <button class="order-btn primary payment-submit" type="button">
                <i class="fa-solid fa-credit-card"></i> Thanh toán
            </button>
        </div>
    </aside>
</div>
<div class="toast-container" id="cashier-toast-container"></div>

<script>
    (function () {
        const tabs = Array.from(document.querySelectorAll('.cashier-tab'));
        const panels = Array.from(document.querySelectorAll('.cashier-panel'));
        const searchInput = document.getElementById('cashier-search');
        const floorButtons = Array.from(document.querySelectorAll('.chip[data-floor]'));
        const statusInputs = Array.from(document.querySelectorAll('input[name="room-status"]'));
        const roomCards = Array.from(document.querySelectorAll('.room-card'));
        const serviceCards = Array.from(document.querySelectorAll('.service-card'));
        const bookingCards = Array.from(document.querySelectorAll('.booking-card'));
        const emptyRooms = document.querySelector('[data-empty="rooms"]');
        const emptyServices = document.querySelector('[data-empty="services"]');
        const emptyBookings = document.querySelector('[data-empty="bookings"]');
        const selectedLabel = document.getElementById('cashier-selected-room');
        const selectedInput = document.getElementById('cashier-room-id');
        const checkinForm = document.getElementById('cashier-checkin-form');
        const statusButton = document.getElementById('cashier-status-btn');
        const statusButtonLabel = statusButton ? statusButton.querySelector('span') : null;
        const statusButtonIcon = statusButton ? statusButton.querySelector('i') : null;
        const menuToggle = document.getElementById('cashier-menu-toggle');
        const menuDropdown = document.getElementById('cashier-menu-dropdown');
        const roomPageButtons = Array.from(document.querySelectorAll('[data-room-page]'));
        const roomPageLabel = document.getElementById('room-page-label');
        const orderItemsEl = document.getElementById('cashier-order-items');
        const orderEmptyEl = document.getElementById('cashier-order-empty');
        const orderTotalEl = document.getElementById('cashier-total');
        const paymentDrawer = document.getElementById('cashier-payment-drawer');
        const paymentClose = document.getElementById('cashier-payment-close');
        const paymentOpen = document.getElementById('cashier-pay-btn');
        const paymentSubmit = document.querySelector('.payment-submit');
        const paymentRoom = document.getElementById('cashier-payment-room');
        const paymentSubtotal = document.getElementById('payment-subtotal');
        const paymentDiscount = document.getElementById('payment-discount');
        const paymentTotal = document.getElementById('payment-total');
        const paymentMethodInputs = Array.from(document.querySelectorAll('input[name="payment-method"]'));
        const paymentQrBox = document.getElementById('payment-qr-box');
        const paymentCardNote = document.getElementById('payment-card-note');
        const cashierRight = document.querySelector('.cashier-right');
        const toastContainer = document.getElementById('cashier-toast-container');
        const csrfToken = '{{ csrf_token() }}';

        const showToast = (message, type = 'success') => {
            if (!toastContainer) {
                return;
            }
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.textContent = message;
            toastContainer.appendChild(toast);
            requestAnimationFrame(() => {
                toast.classList.add('is-visible');
            });
            setTimeout(() => {
                toast.classList.remove('is-visible');
                setTimeout(() => toast.remove(), 300);
            }, 2400);
        };

        let activeTab = 'rooms';
        let activeFloor = 'all';
        let activeStatus = 'all';
        let activePage = '1';
        let selectedStatusCode = null;
        let totalPages = 1;
        let currentRoomId = '';

        const orderItems = new Map();

        const updateEmpty = (cards, emptyEl) => {
            if (!emptyEl) {
                return;
            }
            const hasVisible = cards.some((card) => !card.classList.contains('is-hidden'));
            emptyEl.style.display = hasVisible ? 'none' : 'block';
        };

        const applyFilters = () => {
            const query = (searchInput?.value || '').trim().toLowerCase();

            if (activeTab === 'rooms') {
                roomCards.forEach((card) => {
                    const floorOk = activeFloor === 'all' || card.dataset.floor === activeFloor;
                    const statusOk = activeStatus === 'all' || card.dataset.status === activeStatus;
                    const pageOk = !card.dataset.page || card.dataset.page === activePage;
                    const nameOk = !query || (card.dataset.name || '').includes(query);
                    card.classList.toggle('is-hidden', !(floorOk && statusOk && pageOk && nameOk));
                });
                updateEmpty(roomCards, emptyRooms);
            }

            if (activeTab === 'services') {
                serviceCards.forEach((card) => {
                    const nameOk = !query || (card.dataset.name || '').includes(query);
                    card.classList.toggle('is-hidden', !nameOk);
                });
                updateEmpty(serviceCards, emptyServices);
            }

            if (activeTab === 'bookings') {
                bookingCards.forEach((card) => {
                    const nameOk = !query || (card.dataset.name || '').includes(query);
                    card.classList.toggle('is-hidden', !nameOk);
                });
                updateEmpty(bookingCards, emptyBookings);
            }
        };

        const selectRoomCard = (card) => {
            if (!card) {
                orderItems.delete('room');
                renderOrderItems();
                return;
            }
            roomCards.forEach((item) => item.classList.remove('is-selected'));
            card.classList.add('is-selected');

            const roomName = card.dataset.roomName || 'Phòng';
            const roomId = card.dataset.roomId || '';
            const roomPrice = Number(card.dataset.roomPrice || 0);
            const isAvailableRoom = card.dataset.status === 'available';
            selectedStatusCode = card.dataset.statusCode ? Number(card.dataset.statusCode) : null;
            if (selectedLabel) {
                selectedLabel.textContent = 'Phòng ' + roomName;
            }
            if (paymentRoom) {
                paymentRoom.textContent = 'Phòng ' + roomName;
            }
            if (selectedInput) {
                selectedInput.value = roomId;
            }

            if (isAvailableRoom) {
                orderItems.clear();
                currentRoomId = roomId;
                renderOrderItems();
                closePaymentDrawer();
            } else {
                if (currentRoomId && currentRoomId !== roomId) {
                    orderItems.forEach((item, key) => {
                        if (key !== 'room') {
                            orderItems.delete(key);
                        }
                    });
                }
                currentRoomId = roomId;

                if (roomPrice > 0) {
                    orderItems.set('room', {
                        id: 'room',
                        name: 'Phòng ' + roomName,
                        price: roomPrice,
                        qty: 1,
                        isRoom: true,
                    });
                } else {
                    orderItems.delete('room');
                }
                renderOrderItems();
                closePaymentDrawer();
            }

            if (statusButton) {
                const isOccupied = selectedStatusCode === 2;
                statusButton.classList.toggle('is-checkout', isOccupied);
                statusButton.setAttribute('type', isOccupied ? 'button' : 'submit');
                if (statusButtonLabel) {
                    statusButtonLabel.textContent = isOccupied ? 'Check-out' : 'Thông báo';
                }
                if (statusButtonIcon) {
                    statusButtonIcon.className = isOccupied ? 'fa-solid fa-right-from-bracket' : 'fa-regular fa-bell';
                }
            }
        };

        const setActiveTab = (tab) => {
            activeTab = tab;
            tabs.forEach((btn) => btn.classList.toggle('is-active', btn.dataset.tab === tab));
            panels.forEach((panel) => panel.classList.toggle('is-active', panel.dataset.panel === tab));
            applyFilters();
        };

        tabs.forEach((btn) => {
            btn.addEventListener('click', () => setActiveTab(btn.dataset.tab));
        });

        floorButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                activeFloor = btn.dataset.floor;
                floorButtons.forEach((item) => item.classList.toggle('is-active', item === btn));
                applyFilters();
            });
        });

        statusInputs.forEach((input) => {
            input.addEventListener('change', () => {
                if (input.checked) {
                    activeStatus = input.value;
                    applyFilters();
                }
            });
        });

        const updatePageControls = () => {
            if (roomPageLabel) {
                roomPageLabel.textContent = `Trang ${activePage} / ${totalPages}`;
            }
            const prevBtn = roomPageButtons.find((btn) => btn.dataset.roomPage === 'prev');
            const nextBtn = roomPageButtons.find((btn) => btn.dataset.roomPage === 'next');
            if (prevBtn) {
                prevBtn.disabled = Number(activePage) <= 1;
            }
            if (nextBtn) {
                nextBtn.disabled = Number(activePage) >= totalPages;
            }
        };

        roomPageButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                const action = btn.dataset.roomPage;
                let nextPage = Number(activePage);
                if (action === 'prev') {
                    nextPage = Math.max(1, nextPage - 1);
                } else if (action === 'next') {
                    nextPage = Math.min(totalPages, nextPage + 1);
                } else if (!Number.isNaN(Number(action))) {
                    nextPage = Number(action);
                }
                activePage = String(nextPage);
                updatePageControls();
                applyFilters();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }

        roomCards.forEach((card) => {
            card.addEventListener('click', () => {
                selectRoomCard(card);
            });
        });

        const formatMoney = (value) => {
            if (Number.isNaN(value)) {
                return '0';
            }
            try {
                return new Intl.NumberFormat('vi-VN').format(value);
            } catch (error) {
                return value.toLocaleString('vi-VN');
            }
        };

        const updateTotals = () => {
            let total = 0;
            orderItems.forEach((item) => {
                total += item.price * item.qty;
            });
            const formatted = formatMoney(total) + ' VNĐ';
            if (orderTotalEl) {
                orderTotalEl.textContent = formatted;
            }
            if (paymentSubtotal) {
                paymentSubtotal.textContent = formatted;
            }
            if (paymentDiscount) {
                paymentDiscount.textContent = '0';
            }
            if (paymentTotal) {
                paymentTotal.textContent = formatted;
            }
        };

        const renderOrderItems = () => {
            if (!orderItemsEl) {
                return;
            }
            orderItemsEl.innerHTML = '';
            orderItems.forEach((item) => {
                const row = document.createElement('div');
                row.className = 'order-item';
                row.dataset.serviceId = item.id;
                row.dataset.itemType = item.isRoom ? 'room' : 'service';

                const main = document.createElement('div');
                main.className = 'order-item-main';

                const name = document.createElement('div');
                name.className = 'order-item-name';
                name.textContent = item.name;

                const price = document.createElement('div');
                price.className = 'order-item-price';
                price.textContent = formatMoney(item.price) + ' VNĐ';

                main.appendChild(name);
                main.appendChild(price);

                const controls = document.createElement('div');
                controls.className = 'order-item-controls';
                if (item.isRoom) {
                    controls.classList.add('is-static');
                    const qty = document.createElement('span');
                    qty.className = 'qty-value';
                    qty.textContent = 'x1';
                    controls.appendChild(qty);
                } else {
                    const decrease = document.createElement('button');
                    decrease.type = 'button';
                    decrease.className = 'qty-btn';
                    decrease.dataset.action = 'decrease';
                    decrease.textContent = '-';

                    const qty = document.createElement('span');
                    qty.className = 'qty-value';
                    qty.textContent = String(item.qty);

                    const increase = document.createElement('button');
                    increase.type = 'button';
                    increase.className = 'qty-btn';
                    increase.dataset.action = 'increase';
                    increase.textContent = '+';

                    controls.appendChild(decrease);
                    controls.appendChild(qty);
                    controls.appendChild(increase);
                }

                const total = document.createElement('div');
                total.className = 'order-item-total';
                total.textContent = formatMoney(item.price * item.qty) + ' VNĐ';

                let remove = null;
                if (!item.isRoom) {
                    remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'order-item-remove';
                    remove.dataset.action = 'remove';
                    remove.innerHTML = '&times;';
                }

                row.appendChild(main);
                row.appendChild(controls);
                row.appendChild(total);
                if (remove) {
                    row.appendChild(remove);
                }
                orderItemsEl.appendChild(row);
            });

            if (orderEmptyEl) {
                orderEmptyEl.classList.toggle('is-hidden', orderItems.size > 0);
            }
            updateTotals();
        };

        const addServiceToOrder = (card) => {
            if (!card) {
                return;
            }
            const serviceId = card.dataset.serviceId || '';
            const serviceName = card.dataset.serviceName || card.querySelector('.service-title')?.textContent || 'Dịch vụ';
            const servicePrice = Number(card.dataset.servicePrice || 0);
            if (!serviceId) {
                return;
            }
            const existing = orderItems.get(serviceId);
            if (existing) {
                existing.qty += 1;
            } else {
                orderItems.set(serviceId, {
                    id: serviceId,
                    name: serviceName,
                    price: servicePrice,
                    qty: 1,
                });
            }
            renderOrderItems();
        };

        serviceCards.forEach((card) => {
            card.addEventListener('click', () => addServiceToOrder(card));
        });

        if (orderItemsEl) {
            orderItemsEl.addEventListener('click', (event) => {
                const button = event.target.closest('button');
                if (!button) {
                    return;
                }
                const row = button.closest('.order-item');
                if (!row) {
                    return;
                }
                if (row.dataset.itemType === 'room') {
                    return;
                }
                const serviceId = row.dataset.serviceId;
                if (!serviceId || !orderItems.has(serviceId)) {
                    return;
                }
                const item = orderItems.get(serviceId);
                const action = button.dataset.action;
                if (action === 'increase') {
                    item.qty += 1;
                } else if (action === 'decrease') {
                    item.qty = Math.max(1, item.qty - 1);
                } else if (action === 'remove') {
                    orderItems.delete(serviceId);
                }
                renderOrderItems();
            });
        }

        const openPaymentDrawer = () => {
            if (!paymentDrawer || !cashierRight) {
                return;
            }
            cashierRight.classList.add('is-payment-open');
            paymentDrawer.setAttribute('aria-hidden', 'false');
        };

        const closePaymentDrawer = () => {
            if (!paymentDrawer || !cashierRight) {
                return;
            }
            cashierRight.classList.remove('is-payment-open');
            paymentDrawer.setAttribute('aria-hidden', 'true');
        };

        const updatePaymentMethodUI = () => {
            if (!paymentMethodInputs.length) {
                return;
            }
            const activeMethod = paymentMethodInputs.find((input) => input.checked)?.value || 'cash';
            if (paymentQrBox) {
                paymentQrBox.classList.toggle('is-hidden', activeMethod !== 'transfer');
            }
            if (paymentCardNote) {
                paymentCardNote.classList.toggle('is-hidden', activeMethod !== 'card');
            }
        };

        if (paymentOpen) {
            paymentOpen.addEventListener('click', openPaymentDrawer);
        }

        if (paymentClose) {
            paymentClose.addEventListener('click', closePaymentDrawer);
        }

        paymentMethodInputs.forEach((input) => {
            input.addEventListener('change', updatePaymentMethodUI);
        });

        const resetSelectedRoomUI = () => {
            roomCards.forEach((item) => item.classList.remove('is-selected'));
            if (selectedLabel) {
                selectedLabel.textContent = 'Chưa chọn phòng';
            }
            if (paymentRoom) {
                paymentRoom.textContent = 'Chưa chọn phòng';
            }
            if (selectedInput) {
                selectedInput.value = '';
            }
            selectedStatusCode = null;
            currentRoomId = '';
            orderItems.clear();
            renderOrderItems();
            updateTotals();
            closePaymentDrawer();
        };

        const updateRoomCardToAvailable = (roomId) => {
            const card = roomCards.find((item) => item.dataset.roomId === roomId);
            if (!card) {
                return;
            }
            card.dataset.status = 'available';
            card.dataset.statusCode = '0';
            const pill = card.querySelector('.room-pill');
            if (pill) {
                pill.className = 'room-pill is-available';
                pill.textContent = 'Còn trống';
            }
            const meta = card.querySelector('.room-meta');
            if (meta) {
                meta.innerHTML = '';
            }
        };

        if (paymentSubmit) {
            paymentSubmit.addEventListener('click', async () => {
                if (!selectedInput || !selectedInput.value) {
                    showToast('Vui lòng chọn phòng trước khi thanh toán.', 'error');
                    return;
                }
                if (selectedStatusCode !== 2) {
                    showToast('Phòng hiện không thể thanh toán.', 'error');
                    return;
                }

                const methodValue = paymentMethodInputs.find((input) => input.checked)?.value || 'cash';
                const serviceItems = [];
                orderItems.forEach((item) => {
                    if (!item.isRoom) {
                        serviceItems.push({
                            id: item.id,
                            name: item.name,
                            price: item.price,
                            qty: item.qty,
                        });
                    }
                });
                const payload = new FormData();
                payload.append('_token', csrfToken);
                payload.append('room_id', selectedInput.value);
                payload.append('method', methodValue);
                payload.append('items', JSON.stringify(serviceItems));

                try {
                    const response = await fetch('{{ route('cashier.checkout') }}', {
                        method: 'POST',
                        body: payload,
                    });
                    if (!response.ok) {
                        throw new Error('request-failed');
                    }
                    const data = await response.json();
                    if (!data || !data.ok) {
                        showToast(data?.message || 'Thanh toán thất bại.', 'error');
                        return;
                    }
                    updateRoomCardToAvailable(selectedInput.value);
                    resetSelectedRoomUI();
                    showToast('Thanh toán thành công', 'success');
                } catch (error) {
                    showToast('Thanh toán thất bại.', 'error');
                }
            });
        }

        if (statusButton) {
            statusButton.addEventListener('click', (event) => {
                if (statusButton.getAttribute('type') === 'button') {
                    event.preventDefault();
                    openPaymentDrawer();
                }
            });
        }

        if (checkinForm) {
            checkinForm.addEventListener('submit', (event) => {
                if (!selectedInput || !selectedInput.value) {
                    event.preventDefault();
                    alert('Vui lòng chọn phòng trước khi check-in.');
                    return;
                }
                if (selectedStatusCode !== null && selectedStatusCode !== 0) {
                    event.preventDefault();
                    alert('Phòng hiện không thể check-in.');
                }
            });
        }

        if (menuToggle && menuDropdown) {
            menuToggle.addEventListener('click', (event) => {
                event.stopPropagation();
                const isOpen = menuDropdown.classList.toggle('is-open');
                menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
            document.addEventListener('click', () => {
                menuDropdown.classList.remove('is-open');
                menuToggle.setAttribute('aria-expanded', 'false');
            });
            menuDropdown.addEventListener('click', (event) => {
                event.stopPropagation();
            });
        }

        const preselectedId = Number(document.body.dataset.selectedRoomId || 0);
        if (preselectedId) {
            const preselectedCard = roomCards.find((card) => Number(card.dataset.roomId) === preselectedId);
            if (preselectedCard) {
                selectRoomCard(preselectedCard);
            }
        }

        roomCards.forEach((card) => {
            const page = Number(card.dataset.page || 1);
            if (page > totalPages) {
                totalPages = page;
            }
        });
        if (totalPages < 1) {
            totalPages = 1;
        }
        updatePageControls();
        applyFilters();
        updateTotals();
        updatePaymentMethodUI();
    })();
</script>
</body>
</html>
