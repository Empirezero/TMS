<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Fleet Management System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Konza TMS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                @php
                $unreadCount = Auth::user()->notifications()->whereNull('read_at')->count();
                @endphp

                <li class="nav-item dropdown">
                    <!-- Notification Icon -->
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        @if($unreadCount > 0)
                        <span class="badge bg-danger badge-number">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                        @endif
                    </a>
                    <!-- End Notification Icon -->

                    <!-- Notification Dropdown Items -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="max-width: 330px;">
                        <li class="dropdown-header d-flex justify-content-between align-items-center py-2 px-3">
                            <span>You have {{ $unreadCount }} new notification{{ $unreadCount == 1 ? '' : 's' }}</span>
                            @if($unreadCount > 0)
                            <form method="POST" action="{{ route('notifications.readAll') }}" class="m-0 ms-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="badge rounded-pill bg-success p-2 border-0 text-white" style="cursor: pointer;">
                                    Mark all read
                                </button>
                            </form>
                            @endif
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- Dynamic Notification List (Scrollable container to prevent breaking page layout) -->
                        <div class="overflow-auto" style="max-height: 350px;">
                            @forelse(Auth::user()->notifications()->latest()->take(8)->get() as $notification)
                            <li class="notification-item py-2.5 px-3 d-flex align-items-start {{ is_null($notification->read_at) ? 'bg-light' : '' }}">
                                @if(is_null($notification->read_at))
                                <i class="bi bi-exclamation-circle text-warning me-3 pt-1"></i>
                                @else
                                <i class="bi bi-info-circle text-secondary me-3 pt-1"></i>
                                @endif
                                <div>
                                    <h4 class="mb-1 fs-6 fw-semibold text-dark">{{ $notification->data['title'] ?? 'Notification' }}</h4>
                                    @if(!empty($notification->data['body']))
                                    <p class="mb-1 text-muted small" style="line-height: 1.4;">{{ $notification->data['body'] }}</p>
                                    @endif
                                    <p class="mb-0 text-muted extra-small" style="font-size: 11px;">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @empty
                            <li class="py-4 text-center text-muted small">
                                No notifications yet.
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @endforelse
                        </div>

                        <li class="dropdown-footer py-2 text-center">
                            <a href="{{ route('notifications.index') }}">Show all notifications</a>
                        </li>

                    </ul>
                    <!-- End Notification Dropdown Items -->
                </li>
                <!-- End Notification Nav -->
                <li class="nav-item dropdown pe-3">
                    <!-- Profile Image & Toggle -->
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a>
                    <!-- End Profile Image Icon -->

                    <!-- Profile Dropdown Items -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->email }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <!-- Authentication / Sign Out Form Integration -->
                            <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->


            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">


            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('servicerequests.index') ? '' : 'collapsed' }}" href="{{ route('servicerequests.index') }}">
                    <i class="bi bi-tools"></i>
                    <span>Service Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('vehiclerequests.*') ? '' : 'collapsed' }}" href="{{ route('vehiclerequests.index') }}">
                    <i class="bi bi-truck"></i>
                    <span>Vehicle Requests</span>
                </a>
            </li>
            @if(Auth::user()->role !== 'staff')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('fuels.index') ? '' : 'collapsed' }}" href="{{ route('fuels.index') }}">
                    <i class="bi bi-fuel-pump"></i>
                    <span>Fuel</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->role === 'system_admin' || Auth::user()->role === 'transport_officer')
            <li class="nav-heading">ADMINISTRATION</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('vehicles.index') ? '' : 'collapsed' }}" href="{{ route('vehicles.index') }}">
                    <i class="bi bi-car-front"></i>
                    <span>Vehicles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('services.index') ? '' : 'collapsed' }}" href="{{ route('services.index') }}">
                    <i class="bi bi-wrench"></i>
                    <span>Service</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('servicestations.index') ? '' : 'collapsed' }}" href="{{ route('servicestations.index') }}">
                    <i class="bi bi-geo-alt"></i>
                    <span>Service Stations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('inspections.index') ? '' : 'collapsed' }}" href="{{ route('inspections.index') }}">
                    <i class="bi bi-ev-front"></i>
                    <span>Inspections</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.index') ? '' : 'collapsed' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li><!-- End Users Page Nav -->
            @endif

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <div class="container-fluid mt-3 px-0">
            <!-- Validation Error Alert Card Block -->
            @if ($errors->any())
            <div class="alert alert-danger bg-danger-subtle border-danger-subtle text-danger d-flex align-items-start p-3 mb-4 rounded shadow-sm animate__animated animate__fadeIn" role="alert">
                <!-- Bootstrap Info Circle Icon -->
                <i class="bi bi-exclamation-triangle-fill fs-5 me-2.5 flex-shrink-0 pt-0.5"></i>
                <div>
                    <span class="fw-bold d-block mb-1">Please correct the following errors:</span>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- Action Success Feedback Banner Block -->
            @if (session('success'))
            <div class="alert alert-success bg-success-subtle border-success-subtle text-success d-flex align-items-center p-3 mb-4 rounded shadow-sm animate__animated animate__fadeIn" role="alert">
                <!-- Bootstrap Success Check Circle Icon -->
                <i class="bi bi-check-circle-fill fs-5 me-2.5 flex-shrink-0"></i>
                <div>
                    <span class="fw-bold">Success!</span> {{ session('success') }}
                </div>
            </div>
            @endif
        </div>

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Technopolis Development Authority</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../assets/vendor/quill/quill.js"></script>
    <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>

    @stack('scripts')

</body>

</html>