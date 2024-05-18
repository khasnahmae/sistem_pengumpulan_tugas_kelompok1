<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="shortcut icon" href="{{ asset('mazer/assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/iconly.css') }}">
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('mazer/assets/compiled/svg/logo.svg') }}"
                                    alt="Logo"></a>
                        </div>
                        <div class="theme-toggle d-flex align-items-center mt-2 gap-2">
                            <!-- Theme Toggle Icons -->
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                                class="iconify iconify--system-uicons" width="20" height="20"
                                viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <!-- SVG Path -->
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                                class="iconify iconify--mdi" width="20" height="20">
                                <!-- SVG Path -->
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <!-- Sidebar items based on user role -->
                        @switch(auth()->user()->role)
                            @case('admin')
                                <li class="sidebar-item {{ strpos(request()->url(), 'akun') !== false ? 'active' : '' }}">
                                    <a class="sidebar-link" href="/akun">
                                        <i class="iconly-boldUser"></i>
                                        <span>Data Akun</span>
                                    </a>
                                </li>
                                <!-- Other admin links -->
                            @break

                            @case('dosen')
                                <li class="sidebar-item {{ strpos(request()->url(), 'datamhs') !== false ? 'active' : '' }}">
                                    <a class="sidebar-link" href="/datamhs">
                                        <i class="iconly-boldUser"></i>
                                        <span>Data Mahasiswa</span>
                                    </a>
                                </li>
                                <!-- Other dosen links -->
                            @break

                            @case('mahasiswa')
                                <li class="sidebar-item {{ strpos(request()->url(), 'tugasmhs') !== false ? 'active' : '' }}">
                                    <a class="sidebar-link" href="/tugasmhs">
                                        <i class="iconly-boldBook"></i>
                                        <span>Data Tugas</span>
                                    </a>
                                </li>
                                <!-- Other mahasiswa links -->
                            @break

                            @default
                        @endswitch
                    </ul>
                </div>
            </div>
        </div>

        <div id="main" class="layout-navbar">
            <header class="mb-3">
                <nav class="navbar navbar-expand navbar-light bg-white">
                    <a class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-lg-0 mb-2 ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @switch(auth()->user()->role)
                                        @case('dosen')
                                            <li><a class="dropdown-item" href="/profildsn">Profile</a></li>
                                        @break

                                        @case('mahasiswa')
                                            <li><a class="dropdown-item" href="/profilmhs">Profile</a></li>
                                        @break

                                        @default
                                    @endswitch
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" onclick="confirmLogout()">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <main class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Logout',
                text: 'Apakah anda ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/logout';
                }
            });
        }
    </script>
</body>

</html>
