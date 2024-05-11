<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMT</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('templates/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('templates/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="sidebar-brand-text mx-3">S.M.T</div>
            </a>

            <!-- Top Nav Item Divider -->
            <hr class="sidebar-divider my-0">

            {{-- Nav Item Dashboard --}}
            <li class="{{ strpos(request()->url(), 'beranda') !== false ? 'nav-item active' : 'nav-item' }}">
                <a class="nav-link" href="/beranda">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            {{-- End Nav Item Dashboard --}}

            {{-- Logic Nav Item --}}
            @switch(auth()->user()->role)
                {{-- Jika Role Admin --}}
                @case('admin')
                    {{-- Akun Nav Item --}}
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Akun
                    </div>
                    <li class="{{ strpos(request()->url(), 'akun') !== false ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="/akun">
                            <i class="fas fa-user-tie"></i>
                            <span>Data Akun</span></a>
                    </li>
                    {{-- End Dosen Nav Item --}}

                    {{-- Dosen Nav Item --}}
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Dosen
                    </div>
                    <li class="{{ strpos(request()->url(), 'dosen') !== false ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="/dosen">
                            <i class="fas fa-user-tie"></i>
                            <span>Data Dosen</span></a>
                    </li>
                    {{-- End Dosen Nav Item --}}

                    {{-- Mahasiswa Nav Item --}}
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Mahasiswa
                    </div>
                    <li class="{{ strpos(request()->url(), 'mahasiswa') !== false ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="/mahasiswa">
                            <i class="fas fa-user-graduate"></i>
                            <span>Data Mahasiswa</span></a>
                    </li>
                    {{-- End Mahasiswa Nav Item --}}
                @break

                {{-- Jika Role Dosen --}}
                @case('dosen')
                    {{-- Mahasiswa Nav Item --}}
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Mahasiswa
                    </div>
                    <li class="{{ strpos(request()->url(), 'datamhs') !== false ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="/datamhs">
                            <i class="fas fa-user-graduate"></i>
                            <span>Data Mahasiswa</span></a>
                    </li>
                    {{-- End Mahasiswa Nav Item --}}

                    {{-- Tugas Nav Item --}}
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Tugas
                    </div>
                    <li class="{{ strpos(request()->url(), 'tugas') !== false ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="/tugas">
                            <i class="fas fa-fw fa-tasks"></i>
                            <span>Data Tugas</span></a>
                    </li>
                    {{-- End Tugas Nav Item --}}
                @break

                {{-- Jika Role Mahasiswa --}}
                @case('mahasiswa')
                    {{-- Tugas Nav Item --}}
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Tugas
                    </div>
                    <li class="{{ strpos(request()->url(), 'tugasmhs') !== false ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="/tugasmhs">
                            <i class="fas fa-fw fa-tasks"></i>
                            <span>Data Tugas</span></a>
                    </li>
                    {{-- End Tugas Nav Item --}}
                @break

                @default
            @endswitch
            {{-- End Logic Nav Item --}}

            <!-- Bottom Nav Item Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="d-none d-md-inline text-center">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar static-top mb-4 bg-white shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Pill Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right animated--grow-in shadow"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Pemberitahuan
                                </h6>
                                {{--
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item small text-center text-gray-500" href="#">Show All
                                    Alerts</a> --}}
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="d-none d-lg-inline small mr-2 text-gray-600">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('templates/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right animated--grow-in shadow"
                                aria-labelledby="userDropdown">
                                @switch(auth()->user()->role)
                                    @case('dosen')
                                        <a class="dropdown-item" href="/profildsn">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    @break

                                    @case('mahasiswa')
                                        <a class="dropdown-item" href="/profilmhs">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    @break

                                    @default
                                @endswitch
                                <a class="dropdown-item" onclick="confirmLogout()">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright my-auto text-center">
                        <span>Copyright &copy; KELOMPOK 1 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('templates/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('templates/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('templates/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('templates/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('templates/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('templates/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('templates/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('templates/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('templates/js/demo/datatables-demo.js') }}"></script>


    {{-- KUMPULAN ALERT --}}
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
                    // Jika pengguna mengonfirmasi logout, arahkan ke tautan logout
                    window.location.href = '/logout';
                }
            });
        }
    </script>

</body>

</html>
