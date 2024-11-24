<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto d-flex align-items-center">
        <!-- Notification Dropdown -->
        <li class="nav-item dropdown mr-8" id="notification-dropdown">
            <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="notification-count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">
                    Notifikasi
                    <span id="unread-count" class="float-right text-muted text-sm"></span>
                </span>
                <div id="notification-list" class="notification-container">
                    <!-- Notifications will be populated here -->
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" id="mark-all-read" class="dropdown-item dropdown-footer">Tandai Semua Sudah Dibaca</a>
            </div>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link d-flex align-items-center" data-user="{{ Auth::user()->name }}" href="#"
                role="button" data-toggle="dropdown">
                <div class="user-panel mt-0 pb-0 mb-2 d-flex align-items-center">
                    <div class="info pr-2">
                        <span class="d-block" style="color: black;">👋 Hallo Selamat Datang,
                            {{ Auth::user()->name }}</span>
                    </div>
                    <div class="image">
                        <img src="{{ asset('auth-views/assets/media/logos/user.jpg') }}" class="img-circle elevation-2"
                            alt="User Image" style="width: 30px; height: 30px;">
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- Custom CSS -->
<style>
    .navbar-nav .nav-item {
        margin-left: 10px;
    }

    .user-panel .info {
        white-space: nowrap;
    }

    .notification-item {
        padding: 12px 15px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-item.unread {
        background-color: #e8f4fe;
    }

    .notification-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .notification-title {
        font-size: 0.9rem;
        margin-bottom: 3px;
        color: #333;
    }

    .notification-message {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 5px;
    }

    .notification-time {
        font-size: 0.75rem;
    }

    .badge.navbar-badge {
        position: absolute;
        top: 5px;
        right: 3px;
        font-size: 0.6rem;
        padding: 2px 4px;
        background-color: #ffd900;
    }

    #notification-dropdown .dropdown-menu {
        width: 300px;
        max-height: 400px;
        overflow-y: auto;
    }
</style>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let notificationDropdown = $('#notification-dropdown');

        function loadNotifications() {
            $.ajax({
                url: '/dashboard/notifications',
                method: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        updateNotificationUI(response.data);
                    } else {
                        showErrorMessage('Gagal memuat notifikasi');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading notifications:', error);
                    showErrorMessage('Gagal memuat notifikasi');
                }
            });
        }

        function updateNotificationUI(notifications) {
            const notificationList = $('#notification-list');
            notificationList.empty();

            const unreadCount = notifications.filter(n => !n.read_at).length;
            $('#notification-count').text(unreadCount > 0 ? unreadCount : '');

            if (notifications.length === 0) {
                notificationList.html(`
                    <div class="dropdown-item text-center">
                        <i class="fas fa-bell-slash mr-2"></i>
                        <span>Tidak ada notifikasi</span>
                    </div>
                `);
                return;
            }

            notifications.forEach(notification => {
                const isUnread = !notification.read_at;
                const notificationHtml = `
                    <div class="dropdown-item notification-item ${isUnread ? 'unread' : ''}" 
                         data-id="${notification.id}">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon mr-3">
                                <i class="fas ${getNotificationIcon(notification.type)}"></i>
                            </div>
                            <div class="notification-content flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <strong class="notification-title">${notification.title}</strong>
                                    ${isUnread ? '<span class="badge badge-primary badge-pill">Baru</span>' : ''}
                                </div>
                                <p class="notification-message mb-1">${notification.message}</p>
                                <small class="notification-time text-muted">
                                    ${moment(notification.created_at).fromNow()}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                `;
                notificationList.append(notificationHtml);
            });
        }

        function getNotificationIcon(type) {
            switch (type) {
                case 'transaction':
                    return 'fa-shopping-cart';
                case 'payment':
                    return 'fa-money-bill';
                case 'custom':
                    return 'fa-paint-brush';
                default:
                    return 'fa-bell';
            }
        }

        // Handle clicking notification
        $(document).on('click', '.notification-item', function() {
            const notificationId = $(this).data('id');

            $.ajax({
                url: `/dashboard/notifications/read/${notificationId}`,
                method: 'POST',
                success: function(response) {
                    if (response.status === 'success') {
                        loadNotifications();
                    }
                }
            });
        });

        // Handle mark all as read
        $('#mark-all-read').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: '/dashboard/notifications/read-all',
                method: 'POST',
                success: function(response) {
                    if (response.status === 'success') {
                        loadNotifications();
                    }
                }
            });
        });

        // Load notifications initially and set refresh interval
        loadNotifications();
        setInterval(loadNotifications, 30000); // Refresh every 30 seconds
    });
</script>
