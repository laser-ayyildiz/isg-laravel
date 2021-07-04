<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    <title>@yield('company')Özgür OSGB</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/fonts/ionicons.min.css">
    <link rel="stylesheet" href="/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="/company/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .dropdown-menu {
            position: absolute;
            background-color: #f9f9f9;
            min-width: 180px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-menu a:hover {
            background-color: #ddd;
        }

        .dropdown:hover>.dropdown-menu {
            display: block;
        }
    </style>
    @stack('styles')

</head>

<body id="page-top">
    @php
    $role = null;
    if (auth()->user()->hasRole('Admin'))
    $role = 'admin';

    elseif (auth()->user()->hasRole('User'))
    $role = 'user';

    elseif (auth()->user()->hasRole('CompanyAdmin'))
    $role = 'company-admin';
    @endphp

    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/redirect">
                <div class="sidebar-brand-text mx-3">Özgür OSGB</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{ route($role . '.company',['id' => request()->segment(3)]) }}">
                    <i class="fas fa-fw fa-building"></i>
                    <span>@yield('company')</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Detaylar
            </div>
            <li class="nav-item {{ request()->segment(4) == "informations" ? 'active' : '' }}">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseInformations"
                    aria-expanded="true" aria-controls="collapseInformations">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>Bilgiler</span>
                </a>
                <div id="collapseInformations" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bilgiler:</h6>
                        <a class="collapse-item" id="info_item"
                            href="{{ route($role . '.company.informations.index',['id' => request()->segment(3)]) }}">Temel
                            Bilgiler</a>
                        <a class="collapse-item" id="osgb_item"
                            href="{{ route($role . '.company.informations.osgb',['id'=>request()->segment(3)])}} ">OSGB
                            Çalışanları</a>
                        <a class="collapse-item" id="formal_item"
                            href="{{ route($role . '.company.informations.formal',['id' => request()->segment(3)]) }}">Devlet
                            Bilgileri</a>
                        <a class="collapse-item" id="acc_item"
                            href="{{ route($role . '.company.informations.acc',['id' => request()->segment(3)]) }}">Muhasebe
                            Bilgileri</a>

                    </div>
                </div>
            </li>

            <li class="nav-item {{ request()->segment(4) == "employees" ? 'active' : '' }}">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseEmployees"
                    aria-expanded="true" aria-controls="collapseEmployees">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Çalışanlar</span>
                </a>
                <div id="collapseEmployees" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Çalışanlar</h6>
                        <a class="collapse-item" id="emp_item"
                            href="{{ route($role . '.company.employees',['id' => request()->segment(3)]) }}">Çalışan
                            Listesi</a>
                        @if ($role !== 'company-admin')
                        <a class="collapse-item" id="emp_miss_docs_item"
                            href="{{ route($role . '.company.employees.withMissingDocuments',['id' => request()->segment(3)]) }}">Evrakları
                            Eksik
                            Çalışanlar</a>
                        @endif
                        <a class="collapse-item" id="emp_del_item"
                            href="{{ route($role . '.company.employees.deleted',['id' => request()->segment(3)]) }}">Silinen
                            Çalışanlar</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Dokümanlar
            </div>

            <li class="nav-item">
                <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseDocs" aria-expanded="true"
                    aria-controls="collapseDocs">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>İsg Dokümanları</span>
                </a>
                <div id="collapseDocs" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Dokümantasyon</h6>
                        <a class="collapse-item" id="mandatory_files_item"
                            href="{{ route($role . '.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">Zorunlu
                            Dokümanlar</a>
                        <a class="collapse-item" id="notebook_copies_item"
                            href="{{ route($role . '.company.documents.notebookCopies',['id' => request()->segment(3)]) }}">Defter
                            Nüshaları</a>
                        <a class="collapse-item" id="observation_reports_item"
                            href="{{ route($role . '.company.documents.observationReports',['id' => request()->segment(3)]) }}">Saha
                            Gözlem Raporları</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow"
                    style="min-height: 50px;">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="form-inline my-2 my-lg-0 ml-auto" style="list-style: none;">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('notifications') }}"
                                data-bs-hover-animate="rubberBand"><i class="fas fa-bell fa-fw"
                                    style="color: black"></i></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('messages') }}" data-bs-hover-animate="rubberBand">
                                <i class="fas fa-envelope" style="color: black"></i><span
                                    class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <div class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link" title="Profil">
                                    <span style="color:black;"
                                        class="d-none d-lg-inline mr-2 text-600">{{ auth()->user()->name }}</span><img
                                        class="rounded-circle img-profile" width="25px" height="25px"
                                        src="{{ Auth::user()->profile_photo_path }}"></a>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li class="nav-item"><a style="color: black;" title="Çıkış" class="nav-link"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                        class="fas fa-sign-out-alt"></i><span>&nbsp;Çıkış</span></a></li>
                        </form>
                    </div>

                </nav>
                <div class="container-fluid mt-2">
                    @yield('content')
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ÖzgürOSGB 2021</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery.easing.min.js"></script>
    <script src="/company/js/sb-admin-2.min.js"></script>
    <script>
        const pathArray = window.location.pathname.split('/');
        if (pathArray.includes("informations"))
            $("#collapseInformations").addClass("show");
        else if (pathArray.includes("employees"))
            $("#collapseEmployees").addClass("show");
        else if (pathArray.includes("documents"))
            $("#collapseDocs").addClass("show");
    </script>
    @stack('scripts')
</body>

</html>