<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسهيل الزواج</title>
    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts: Cairo for beautiful Arabic typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            font-size: 1.15rem;
            color: #2d3748;
            overflow-x: hidden;
        }
        
        /* Layout wrapper */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background-color: #0d6efd; /* Primary Color */
            color: white;
            transition: all 0.3s;
            min-height: 100vh;
            z-index: 1000;
        }
        
        #sidebar.active {
            margin-right: -280px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.1);
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li a {
            padding: 15px 20px;
            font-size: 1.15rem;
            display: block;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 600;
        }
        #sidebar ul li a:hover, #sidebar ul li.active > a {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        #sidebar ul li a i {
            margin-left: 10px;
            width: 25px;
            text-align: center;
        }

        /* Content Area */
        #content {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
            padding: 20px;
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            #sidebar {
                margin-right: -280px;
                position: fixed;
                right: 0;
                top: 0;
                height: 100vh;
                overflow-y: auto;
            }
            #sidebar.active {
                margin-right: 0;
            }
            .mobile-toggle {
                display: block !important;
            }
            /* Backdrop when sidebar is open on mobile */
            .sidebar-backdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            .sidebar-backdrop.active {
                display: block;
            }
        }
        
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #0d6efd;
            cursor: pointer;
        }

        /* Generic utilities */
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 2rem;
        }
        .card-header {
            border-top-right-radius: 15px !important;
            border-top-left-radius: 15px !important;
            padding: 1.5rem;
        }
        .form-control, .form-select {
            font-size: 1.2rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.3);
        }
        .btn {
            font-size: 1.2rem;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar Backdrop for mobile -->
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <a href="{{ url('/') }}" class="text-white text-decoration-none d-block">
                    <i class="fa-solid fa-ring fa-2x mb-2"></i>
                    <h3>تسهيل الزواج</h3>
                </a>
            </div>

            <ul class="list-unstyled components">
                @auth

                    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> الرئيسية</a>
                    </li>
                    <li class="{{ request()->routeIs('applicants.*') ? 'active' : '' }}">
                        <a href="{{ route('applicants.index') }}"><i class="fa-solid fa-users"></i> إدارة الحالات</a>
                    </li>
                    @if(auth()->user()->role === 'super_admin')
                        <li class="{{ request()->routeIs('associations.*') ? 'active' : '' }}">
                            <a href="{{ route('associations.index') }}"><i class="fa-solid fa-building-ngo"></i> إدارة الجمعيات</a>
                        </li>
                        <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}"><i class="fa-solid fa-user-tie"></i> إدارة المستخدمين</a>
                        </li>
                        <li class="{{ request()->routeIs('activities.*') ? 'active' : '' }}">
                            <a href="{{ route('activities.index') }}"><i class="fa-solid fa-clock-rotate-left"></i> سجل الأنشطة</a>
                        </li>
                    @endif
                    <li class="mt-4 px-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100"><i class="fa-solid fa-right-from-bracket me-2"></i> تسجيل الخروج</button>
                        </form>
                    </li>
                @else
                    <li class="{{ request()->routeIs('login') ? 'active' : '' }}">
                        <a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> دخول الموظفين</a>
                    </li>
                    <li class="{{ request()->routeIs('public.case.create') ? 'active' : '' }}">
                        <a href="{{ route('public.case.create') }}"><i class="fa-solid fa-hand-holding-heart"></i> طلب مساعدة (للمستفيدين)</a>
                    </li>
                @endauth
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Header -->
            <header class="bg-white shadow-sm mb-4 px-4 py-3 d-flex justify-content-between align-items-center rounded">
                <div class="d-flex align-items-center">
                    <button type="button" id="sidebarCollapse" class="btn btn-light d-md-none ms-3">
                        <i class="fa-solid fa-bars fs-4 text-primary"></i>
                    </button>
                    @auth
                        @if(auth()->user()->association && auth()->user()->association->logo)
                            <img src="{{ Storage::url(auth()->user()->association->logo) }}" alt="شعار الجمعية" class="rounded border shadow-sm me-3 object-fit-cover bg-white p-1" style="width: 50px; height: 50px;">
                            <h5 class="mb-0 fw-bold text-primary d-none d-md-block">{{ auth()->user()->association->name }}</h5>
                        @endif
                    @endauth
                </div>
                
                @auth
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle ms-2 object-fit-cover shadow-sm border p-1 bg-light" style="width: 45px; height: 45px;">
                        @else
                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center ms-2 shadow-sm border" style="width: 45px; height: 45px;">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                        <span class="d-none d-md-inline fw-bold">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-start shadow border-0 mt-3 text-end" aria-labelledby="dropdownUser">
                        <li>
                            <a class="dropdown-item fw-bold text-secondary py-2" href="{{ route('profile.edit') }}">
                                <i class="fa-solid fa-user-pen ms-2"></i> الملف الشخصي (تعديل الحساب)
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-bold py-2">
                                    <i class="fa-solid fa-right-from-bracket ms-2"></i> تسجيل الخروج
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </header>

            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var sidebar = document.getElementById('sidebar');
            var sidebarCollapse = document.getElementById('sidebarCollapse');
            var backdrop = document.getElementById('sidebarBackdrop');

            if(sidebarCollapse) {
                sidebarCollapse.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                    if(backdrop) backdrop.classList.toggle('active');
                });
            }

            if(backdrop) {
                backdrop.addEventListener('click', function () {
                    sidebar.classList.remove('active');
                    backdrop.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>
