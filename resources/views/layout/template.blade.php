<!doctype html>
<html lang="en">
<!-- Mirrored from satoshi.webpixels.io/pages/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Jan 2025 03:36:45 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
    <meta name="color-scheme" content="dark light">
    <title>Satoshi – Web3 and Finance Dashboard Theme</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/assets/css/utility.css">
    <link rel="stylesheet" href="../../cdn.jsdelivr.net/npm/bootstrap-icons%401.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f=satoshi@900,700,500,300,401,400&amp;display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <script defer="defer" data-domain="satoshi.webpixels.io" src="../../plausible.io/js/script.outbound-links.js"></script>
</head>

<body class="bg-body-tertiary">
    <div class="modal fade" id="depositLiquidityModal" tabindex="-1" aria-labelledby="depositLiquidityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content overflow-hidden">
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-lg-row h-lg-100 gap-1">
        <nav class="flex-none navbar navbar-vertical navbar-expand-lg navbar-light bg-transparent show vh-lg-100 px-0 py-2"
            id="sidebar">
            <div class="container-fluid px-3 px-md-4 px-lg-6"><button class="navbar-toggler ms-n2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button> <a
                    class="navbar-brand d-inline-block py-lg-1 mb-lg-5" href="#"><img
                        src="https://satoshi.webpixels.io/img/logos/logo-dark.svg" class="logo-dark h-rem-8 h-rem-md-10"
                        alt="..."> <img src="https://satoshi.webpixels.io/img/logos/logo-light.svg"
                        class="logo-light h-rem-8 h-rem-md-10" alt="..."></a>
                <div class="dropdown-divider"></div>

                @if (auth()->user()->hasRole('admin'))
<div class="collapse navbar-collapse overflow-x-hidden" id="sidebarCollapse">
    <ul class="navbar-nav">
        <!-- Dashboards Section -->
        <li class="nav-item my-1">
            <a class="nav-link d-flex align-items-center rounded-pill" href="/dashboard" role="button" aria-expanded="true" aria-controls="sidebar-dashboards">
                <i class="bi bi-house-door-fill"></i> <!-- Icon updated -->
                <span>Dashboards</span>
            </a>
        </li>
        
        <!-- Mahasiswa Section -->
        <li class="nav-item my-1">
            <a class="nav-link d-flex align-items-center rounded-pill" href="#sidebar-pages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-pages">
                <i class="bi bi-person-fill"></i> <!-- Icon updated -->
                <span>Mahasiswa</span>
            </a>
            <div class="collapse" id="sidebar-pages">
                <ul class="nav nav-sm flex-column mt-1">
                    <li><a class="nav-item nav-link" href="/jurusan">Jurusan</a></li>
                    <li><a class="nav-item nav-link" href="/kelas">Kelas</a></li>
                    <li><a class="nav-item nav-link" href="/matkul">Mata Kuliah</a></li>
                </ul>
            </div>
        </li>

        <!-- Dosen Section -->
        <li class="nav-item my-1">
            <a class="nav-link d-flex align-items-center rounded-pill" href="#sidebar-account" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-account">
                <i class="bi bi-person-circle"></i> <!-- Icon updated -->
                <span>Dosen</span>
            </a>
            <div class="collapse" id="sidebar-account">
                <ul class="nav nav-sm flex-column mt-1">
                    <li class="nav-item"><a href="/dosen/admin" class="nav-link">Dosen</a></li>
                    <li class="nav-item"><a href="/penentuan" class="nav-link">Penentuan Dosen</a></li>
                </ul>
            </div>
        </li>

        <!-- User Section -->
        <li class="nav-item my-1">
            <a class="nav-link d-flex align-items-center rounded-pill" href="#sidebar-other" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar-other">
                <i class="bi bi-person-lines-fill"></i> <!-- Icon updated -->
                <span>User</span>
            </a>
            <div class="collapse" id="sidebar-other">
                <ul class="nav nav-sm flex-column mt-1">
                    <li class="nav-item"><a href="/user" class="nav-link">User</a></li>
                </ul>
            </div>
        </li>
    </ul>

    <!-- Divider and Logout Section -->
    <hr class="navbar-divider my-5 opacity-70">
    <div class="mt-auto"></div>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item d-flex align-items-center" href="/logout">
        <i class="bi bi-box-arrow-right me-2"></i> Log out
    </a>
</div>
@endif

                @if (auth()->user()->hasRole('mahasiswa'))
                <div class="collapse navbar-collapse overflow-x-hidden" id="sidebarCollapse">
                    <ul class="navbar-nav">
                        <!-- Dashboard Link -->
                        <li class="nav-item my-1">
                            <a class="nav-link d-flex align-items-center rounded-pill" href="/dashboard/mahasiswa" role="button" aria-expanded="true" aria-controls="sidebar-dashboards">
                                <i class="bi bi-house-fill"></i>
                                <span>Dashboards</span>
                                <span class="badge badge-sm rounded-pill me-n2 bg-success-subtle text-success ms-auto"></span>
                            </a>
                        </li>
            
                        <!-- Data Diri Link -->
                        <li class="nav-item my-1">
                            <a class="nav-link d-flex align-items-center rounded-pill" href="/data_diri/mahasiswa" role="button" aria-expanded="true" aria-controls="sidebar-datadiri">
                                <i class="bi bi-person-fill"></i>
                                <span>Data Diri</span>
                                <span class="badge badge-sm rounded-pill me-n2 bg-success-subtle text-success ms-auto"></span>
                            </a>
                        </li>
            
                        <!-- Pengajuan Skripsi Link -->
                        <li class="nav-item my-1">
                            <a class="nav-link d-flex align-items-center rounded-pill" href="/skripsi/mahasiswa" role="button" aria-expanded="true" aria-controls="sidebar-skripsi">
                                <i class="bi bi-file-earmark-text"></i>
                                <span>Pengajuan Skripsi</span>
                                <span class="badge badge-sm rounded-pill me-n2 bg-warning-subtle text-warning ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            
                <div class="dropdown-divider"></div>
            
                <!-- Logout Link -->
                <a class="dropdown-item d-flex align-items-center" href="/logout">
                    <i class="bi bi-box-arrow-right me-2"></i> Log out
                </a>
            @endif
            

                @if (auth()->user()->hasRole('dosen'))
                <div class="collapse navbar-collapse overflow-x-hidden" id="sidebarCollapse">
                    <ul class="navbar-nav">
                        <!-- Dashboard Link -->
                        <li class="nav-item my-1">
                            <a class="nav-link d-flex align-items-center rounded-pill" href="/dashboard-dosen" role="button" aria-expanded="true" aria-controls="sidebar-dashboards">
                                <i class="bi bi-house-fill"></i>
                                <span>Dashboards</span>
                                <span class="badge badge-sm rounded-pill me-n2 bg-success-subtle text-success ms-auto"></span>
                            </a>
                        </li>
            
                        <!-- Pengajuan Skripsi Link -->
                        <li class="nav-item my-1">
                            <a class="nav-link d-flex align-items-center rounded-pill" href="/absensi/dosen" role="button" aria-expanded="true" aria-controls="sidebar-skripsi">
                                <i class="bi bi-file-earmark-text"></i>
                                <span>abzenzi</span>
                                <span class="badge badge-sm rounded-pill me-n2 bg-warning-subtle text-warning ms-auto"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            
                <div class="dropdown-divider"></div>
            
                <!-- Logout Link -->
                <a class="dropdown-item d-flex align-items-center" href="/logout">
                    <i class="bi bi-box-arrow-right me-2"></i> Log out
                </a>
                @endif

            </div>
        </nav>
        <div class="flex-lg-fill overflow-x-auto ps-lg-1 vstack vh-lg-100 position-relative">
            <div class="d-none d-lg-flex py-3">
                <div class="hstack flex-fill justify-content-end flex-nowrap gap-6 ms-auto px-6 px-xxl-8">
                    @if (auth()->user()->hasRole('admin'))
                        <a class="btn btn-secondary" href="/register/admin_dosen" role="button">ADD Dosen
                            </a>
                    @endif
                    <div class="dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-sun-fill"></i>
                        </a>
                        <div class="dropdown-menu">
                            <button type="button" class="dropdown-item d-flex align-items-center"
                                data-bs-theme-value="light">Light</button>
                            <button type="button" class="dropdown-item d-flex align-items-center"
                                data-bs-theme-value="dark">Dark</button>
                            <button type="button" class="dropdown-item d-flex align-items-center"
                                data-bs-theme-value="auto">System</button>
                        </div>

                    </div>
                    <div class="dropdown"><a href="#" class="nav-link" id="dropdown-notifications"
                            data-bs-toggle="dropdown" aria-expanded="false"></i></a>
                        <div class="dropdown-menu dropdown-menu-end px-2" aria-labelledby="dropdown-notifications">
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="avatar text-bg-dark rounded-circle d-flex align-items-center justify-content-center"
                            href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="false"
                            aria-expanded="false">
                            <i class="bi bi-person-fill fs-4 text-white"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-header"><span class="d-block text-sm text-muted mb-1">Signed in
                                    as</span>
                                <span class="d-block text-heading fw-semibold">
                                    {{ auth()->user()->name ?? 'Guest' }}
                                </span>
                                <a class="" href="/logout" role="button">Log out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex-fill overflow-y-lg-auto scrollbar bg-body rounded-top-4 rounded-top-start-lg-4 rounded-top-end-lg-0 border-top border-lg shadow-2">
                <main class="container-fluid px-3 py-5 p-lg-6 p-xxl-8">
                    <div class="mb-6 mb-xl-10">

                        @yield('content')

                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="../../cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/main.js"></script>
    <script src="{{ asset('admin') }}/assets/js/switcher.js"></script>
</body>
<!-- Mirrored from satoshi.webpixels.io/pages/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Jan 2025 03:37:01 GMT -->

</html>
