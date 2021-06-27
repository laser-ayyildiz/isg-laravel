<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="shortcut icon" href="/images/osgb_amblem.ico">
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    <title>@yield('title')Özgür OSGB</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/fonts/ionicons.min.css">
    <link rel="stylesheet" href="/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
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

        a i {
            color: black;
        }

    </style>
    @stack('styles')

</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="min-height: 50px;">
        <a class="navbar-brand" href="{{ route('admin.home') }}"><b>Özgür OSGB</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown no-arrow active">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-building"></i>
                        İşletmeler
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('admin.companies.index') }}"><i
                                class="fas fa-stream mr-1"></i>İşletme Listesi</a>
                        <a class="dropdown-item" href="{{ route('admin.change_validate') }}"><i
                                class="fas fa-exchange-alt mr-1"></i>Değişiklik Talepleri</a>
                        <a class="dropdown-item" href="{{ route('admin.deleted_companies') }}"><i
                                class="fas fa-eraser mr-1"></i>Arşiv</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.settings') }}"><i class="fas fa-wrench"></i>
                        Ayarlar
                    </a>
                </li>

                <li class="nav-item dropdown no-arrow active">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        Çalışanlar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('admin.osgb_employees') }}"><i
                                class="fas fa-stream mr-1"></i>Çalışan Listesi</a>
                        <a class="dropdown-item" href="{{ route('admin.deleted_employees') }}"><i
                                class="fas fa-eraser mr-1"></i>Silinen Çalışanlar</a>
                        <a class="dropdown-item" href="{{ route('admin.authentication') }}"><i
                                class="fas fa-user-edit mr-1"></i>Yetkilendir</a>
                    </div>
                </li>

            </ul>
            <div class="form-inline my-2 my-lg-0" style="list-style: none;">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('notifications') }}" data-bs-hover-animate="rubberBand"><i
                            class="fas fa-bell fa-fw" style="color:black "></i></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('messages') }}" data-bs-hover-animate="rubberBand"> <i
                            class="fas fa-envelope" style="color: black"></i><span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <div class="nav-item">
                        <a href="{{ route('profile.index') }}" class="nav-link" title="Profil">
                            <span style="color:black;"
                                class="d-none d-lg-inline mr-2 text-600 text-white">{{ Str::of(auth()->user()->name)->title()->limit(30) }}</span><img
                                class="rounded-circle img-profile" width="25px" height="25px"
                                src="{{ Auth::user()->profile_photo_path }}"></a>
                </li>
                <div class="d-none d-sm-block topbar-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li class="nav-item"><a style="color: rgb(92, 90, 90);" title="Çıkış" class="nav-link"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"><i
                                class="fas fa-sign-out-alt"></i><span class="text-white">&nbsp;Çıkış</span></a></li>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-2">
        @yield('content')
    </div>

    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © ÖzgürOSGB 2021</span></div>
        </div>
    </footer>
    </div>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    @stack('scripts')
</body>

</html>