<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISKES</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('admin/assets/images/logos/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/styles.min.css')}}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <!-- Sertakan pustaka DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .loading-text {
            font-size: 18px;
            color: #333;
        }

        .chart {
            width: 519px !important;
            height: 519px !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="flash-data" data-flashdata="{{session('flash')}}"></div>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img" style="text-align: center;">
                        <img style="text-align: center;" src="{{asset('admin/assets/images/logos/logo.png')}}" width="130" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>

                </div>
                <br>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <img src="{{asset('admin/assets/images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12" style="text-align: center;">
                            @if (auth()->user()->role == "sekolah")
                            <b>{{auth()->user()->detailSekolah->nama}}</b>
                            @else
                            <b>{{auth()->user()->detailUser->nama}}</b>
                            @endif
                            <p>
                                @if (auth()->user()->role == "admindinkes")
                                Admin Dinas Kesehatan
                                @elseif (auth()->user()->role == "petugasdinkes")
                                Petugas Dinas Kesehatan
                                @elseif (auth()->user()->role == "sekolah")
                                Admin Sekolah
                                @elseif (auth()->user()->role == "walikelas")
                                Guru Kelas
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                    @if (auth()->user()->role == "admindinkes")
                    <ul id="sidebarnav">
                        <li class="sidebar-item ">
                            <a class="sidebar-link {{ request()->is('admindinkes') ? 'active' : '' }}" href="{{Route('indexAdminDinkes')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">manajemen petugas</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('admindinkes/search-petugas-kesehatan*') || request()->is('admindinkes/list-petugas-kesehatan*') || request()->is('admindinkes/form-add-petugas-kesehatan') || request()->is('admindinkes/detail-petugas-kesehatan*') || request()->is('admindinkes/form-update-petugas-kesehatan*') ? 'active' : '' }}" href="{{Route('indexPetugasKesehatan')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Petugas Kesehatan</span>
                            </a>
                        </li>
                    </ul>
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">manajemen sekolah</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('admindinkes/list-sekolah*') || request()->is('admindinkes/form-add-sekolah') || request()->is('admindinkes/detail-sekolah/*') || request()->is('admindinkes/form-update-sekolah/*') ? 'active' : '' }}" href="{{Route('indexSekolah')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-school"></i>
                                </span>
                                <span class="hide-menu">Sekolah</span>
                            </a>
                        </li>
                    </ul>
                    @elseif (auth()->user()->role == "sekolah")
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">manajemen kelas</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('sekolah/list-kelas*') || request()->is('sekolah/form-add-kelas') || request()->is('sekolah/detail-kelas/*') || request()->is('sekolah/form-update-kelas/*') ? 'active' : '' }}" href="{{Route('indexKelas')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-door"></i>
                                </span>
                                <span class="hide-menu">Kelas</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('sekolah/list-wali-kelas*') || request()->is('sekolah/form-add-wali-kelas') || request()->is('sekolah/detail-wali-kelas/*') || request()->is('sekolah/form-update-wali-kelas/*') ? 'active' : '' }}" href="{{Route('indexWaliKelas')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Wali Kelas</span>
                            </a>
                        </li>
                    </ul>
                    @elseif (auth()->user()->role == "walikelas")
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">manajemen siswa</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('walikelas/list-siswa*') || request()->is('walikelas/form-add-siswa') || request()->is('walikelas/detail-siswa/*') || request()->is('walikelas/form-update-siswa/*') ? 'active' : '' }}" href="{{Route('indexSiswa')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Siswa</span>
                            </a>
                        </li>
                    </ul>
                    @endif
                    <ul id="sidebarnav">
                        <li class="sidebar-item ">
                            <a class="sidebar-link" href="{{Route('logout')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-logout"></i>
                                </span>
                                <span class="hide-menu">Keluar</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <h4>
                    @yield('title')
                </h4>
                <hr>
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{asset('admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('admin/assets/js/app.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/simplebar/dist/simplebar.js')}}"></script>
    <script src="{{asset('admin/assets/js/dashboard.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
<script>
    // untuk get data error atau success
    const flashdata = $('.flash-data').data('flashdata');

    if (flashdata == 'successAdd') {
        Swal.fire({
            title: 'Berhasil',
            text: 'Data berhasil ditambahkan',
            icon: 'success'
        });
    }

    if (flashdata == 'successDelete') {
        Swal.fire({
            title: 'Berhasil',
            text: 'Data berhasil dihapus',
            icon: 'success'
        });
    }

    if (flashdata == 'successUpdate') {
        Swal.fire({
            title: 'Berhasil',
            text: 'Data berhasil diubah',
            icon: 'success'
        });
    }

    if (flashdata == 'errorAdd') {
        Swal.fire({
            title: 'Gagal',
            text: 'Data gagal ditambahkan',
            icon: 'error'
        });
    }

    if (flashdata == 'errorUpdate') {
        Swal.fire({
            title: 'Gagal',
            text: 'Data gagal diubah',
            icon: 'error'
        });
    }

    if (flashdata == 'errorDelete') {
        Swal.fire({
            title: 'Gagal',
            text: 'Data gagal dihapus',
            icon: 'error'
        });
    }

    if (flashdata == 'errorExistingClass') {
        Swal.fire({
            title: 'Gagal',
            text: 'Kelas telah terdaftar di dalam database',
            icon: 'error'
        });
    }

    if (flashdata == 'errorExistingData') {
        Swal.fire({
            title: 'Gagal',
            text: 'Data terdaftar di dalam database',
            icon: 'error'
        });
    }
</script>

<script>
    function confirmSetujui(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        const role = event.currentTarget.getAttribute('data-role');
        console.log(id);
        console.log(role);
        const url = "{!! url('superadmin/process-delete-admin') !!}/" + role;
        console.log(url);
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan tindakan penghapusan jika dikonfirmasi
                window.location.href = url + "/" + id;
            }
        });
    }
</script>

<script>
    function confirmDeleteUser(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        const role = event.currentTarget.getAttribute('data-role');
        console.log(id);
        console.log(role);
        const url = "{!! url('superadmin/process-delete-user') !!}/" + role;
        console.log(url);
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan tindakan penghapusan jika dikonfirmasi
                window.location.href = url + "/" + id;
            }
        });
    }
</script>

<script>
    function updatePassword(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        const role = event.currentTarget.getAttribute('data-role');
        console.log(id);
        console.log(role);
        const url = "{!! url('superadmin/process-reset-password') !!}/" + role;
        console.log(url);
        Swal.fire({
            title: 'Reset Password',
            text: 'Password akan ter-reset menjadi NIP saat ini',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan tindakan penghapusan jika dikonfirmasi
                window.location.href = url + "/" + id;
            }
        });
    }
</script>

<script>
    function updatePasswordRoleAdmin(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        const role = event.currentTarget.getAttribute('data-role');
        console.log(id);
        console.log(role);
        const url = "{!! url('admin/process-reset-password') !!}/" + role;
        console.log(url);
        Swal.fire({
            title: 'Reset Password',
            text: 'Password akan ter-reset menjadi NIP saat ini',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan tindakan penghapusan jika dikonfirmasi
                window.location.href = url + "/" + id;
            }
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fileInput = document.getElementById('fileInput');
        var pdfPreview = document.getElementById('pdfPreview');

        fileInput.addEventListener('change', function() {
            var file = fileInput.files[0];

            if (file && file.type === 'application/pdf') {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var pdfData = e.target.result;

                    // Tampilkan pratinjau PDF
                    displayPDF(pdfData);
                };

                reader.readAsDataURL(file);
            } else {
                // Reset pratinjau jika file tidak valid
                pdfPreview.src = '';
            }
        });

        function displayPDF(data) {
            pdfPreview.src = data;
        }
    });
</script>

@yield('script')

</html>