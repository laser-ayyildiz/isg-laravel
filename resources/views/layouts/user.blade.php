<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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
    @stack('styles')

</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-warning" style="min-height: 60px;">
        <a class="navbar-brand" href="{{ route('user.home') }}"><b>Özgür OSGB</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('user.companies.index') }}"><i
                        class="fas fa-building mr-1" style="color: black"></i>İşletme Listesi</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('user.deleted_companies') }}"><i
                        class="fas fa-eraser mr-1" style="color: black"></i>Arşiv</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0" style="list-style: none;">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('notifications') }}" data-bs-hover-animate="rubberBand"><i
                            class="fas fa-bell fa-fw" style="color: black"></i></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('messages') }}" data-bs-hover-animate="rubberBand"> <i
                            class="fas fa-envelope" style="color: black"></i><span class="sr-only">(current)</span></a>
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
