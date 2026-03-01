<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0 text-white">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
    </form>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="position-relative me-lg-2">
                    <i class="fa fa-envelope"></i>
                    <span id="message-notification-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;"></span>
                </span>
                <span class="d-none d-lg-inline-flex">Tin nhắn</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0" style="min-width: 280px;">
                <div id="message-notification-list"></div>
                <div id="message-notification-empty" class="dropdown-item text-center">Chưa có tin nhắn mới</div>
                <hr class="dropdown-divider">
                <a href="{{ route('messages.index') }}" class="dropdown-item text-center">Xem tất cả tin nhắn</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" id="booking-notification-toggle">
                <span class="position-relative me-lg-2">
                    <i class="fa fa-bell"></i>
                    <span id="booking-notification-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;"></span>
                </span>
                <span class="d-none d-lg-inline-flex">Thông báo</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0" style="min-width: 260px;">
                <div id="booking-notification-list"></div>
                <div id="booking-notification-empty" class="dropdown-item text-center">Chưa có thông báo mới</div>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bars"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="{{ route('cashier.index') }}" class="dropdown-item">Thu ngân</a>
                <a href="{{route('admin.logout')}}" class="dropdown-item">Đăng xuất</a>
            </div>
        </div>
    </div>
</nav>

<script>
    (function () {
        const badge = document.getElementById('booking-notification-badge');
        const list = document.getElementById('booking-notification-list');
        const empty = document.getElementById('booking-notification-empty');

        if (!badge || !list || !empty) {
            return;
        }

        let lastId = Number(localStorage.getItem('booking_last_id') || 0);
        let initialized = lastId > 0;
        let audioCtx = null;
        let audioEnabled = false;

        const enableAudio = function () {
            if (!audioCtx) {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
            audioEnabled = true;
            document.removeEventListener('click', enableAudio, true);
            document.removeEventListener('keydown', enableAudio, true);
        };

        document.addEventListener('click', enableAudio, true);
        document.addEventListener('keydown', enableAudio, true);

        const playSound = function () {
            if (!audioEnabled || !audioCtx) {
                return;
            }
            const oscillator = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();
            oscillator.type = 'sine';
            oscillator.frequency.value = 880;
            gainNode.gain.value = 0.08;
            oscillator.connect(gainNode);
            gainNode.connect(audioCtx.destination);
            oscillator.start();
            oscillator.stop(audioCtx.currentTime + 0.2);
        };

        const renderEmpty = function () {
            badge.style.display = 'none';
            list.innerHTML = '';
            empty.style.display = 'block';
        };

        const renderMessage = function (count, message) {
            badge.style.display = 'inline-block';
            badge.textContent = count > 9 ? '9+' : String(count);
            empty.style.display = 'none';

            list.innerHTML = '';
            const item = document.createElement('a');
            item.href = "{{ route('booking.index') }}";
            item.className = 'dropdown-item';
            item.innerHTML = '<h6 class="fw-normal mb-0">' + message + '</h6><small>Vừa xong</small>';
            list.appendChild(item);

            const divider = document.createElement('hr');
            divider.className = 'dropdown-divider';
            list.appendChild(divider);

            const viewAll = document.createElement('a');
            viewAll.href = "{{ route('booking.index') }}";
            viewAll.className = 'dropdown-item text-center';
            viewAll.textContent = 'Xem tất cả đặt phòng';
            list.appendChild(viewAll);
        };

        const poll = async function () {
            try {
                const response = await fetch("{{ route('booking.notifications') }}?last_id=" + lastId, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) {
                    return;
                }
                const data = await response.json();
                const latestId = Number(data.latest_id || 0);
                const newCount = Number(data.new_count || 0);
                const message = data.message || 'Có 1 đặt phòng mới';

                if (!initialized) {
                    initialized = true;
                    lastId = latestId;
                    localStorage.setItem('booking_last_id', String(lastId));
                    renderEmpty();
                    return;
                }

                if (newCount > 0) {
                    renderMessage(newCount, message);
                    playSound();
                } else {
                    renderEmpty();
                }

                lastId = latestId;
                localStorage.setItem('booking_last_id', String(lastId));
            } catch (error) {
                // Ignore polling errors to avoid console noise.
            }
        };

        poll();
        setInterval(poll, 15000);
    })();

    (function () {
        const badge = document.getElementById('message-notification-badge');
        const list = document.getElementById('message-notification-list');
        const empty = document.getElementById('message-notification-empty');

        if (!badge || !list || !empty) {
            return;
        }

        let lastId = Number(localStorage.getItem('message_last_id') || 0);
        let initialized = lastId > 0;

        const renderEmpty = function () {
            badge.style.display = 'none';
            list.innerHTML = '';
            empty.style.display = 'block';
        };

        const renderMessages = function (messages, newCount) {
            if (!Array.isArray(messages) || messages.length === 0) {
                renderEmpty();
                return;
            }
            if (newCount > 0) {
                badge.style.display = 'inline-block';
                badge.textContent = newCount > 9 ? '9+' : String(newCount);
            } else {
                badge.style.display = 'none';
            }
            empty.style.display = 'none';
            list.innerHTML = '';
            messages.forEach(function (msg) {
                const item = document.createElement('a');
                item.href = "{{ route('messages.index') }}";
                item.className = 'dropdown-item';
                const timeText = msg.time_ago || 'Vừa xong';
                item.innerHTML = '<h6 class="fw-normal mb-0 message-new-text">Bạn có tin nhắn mới</h6><small>' + timeText + '</small>';
                list.appendChild(item);
            });
        };

        const poll = async function () {
            try {
                const response = await fetch("{{ route('messages.notifications') }}?last_id=" + lastId, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) {
                    return;
                }
                const data = await response.json();
                const latestId = Number(data.latest_id || 0);
                const newCount = Number(data.new_count || 0);

                if (!initialized) {
                    initialized = true;
                    lastId = latestId;
                    localStorage.setItem('message_last_id', String(lastId));
                    renderMessages(data.messages || [], 0);
                    return;
                }

                renderMessages(data.messages || [], newCount);
                lastId = latestId;
                localStorage.setItem('message_last_id', String(lastId));
            } catch (error) {
                // Ignore polling errors.
            }
        };

        poll();
        setInterval(poll, 15000);
    })();
</script>
