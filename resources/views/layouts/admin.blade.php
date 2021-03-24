<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shortcut icon" href="/images/osgb_amblem.ico">
    </link>

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
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>

<body id="page-top">
    <nav class="navbar shadow navbar-expand mb-3 bg-warning topbar static-top">
        <img width="55" height="40" class="rounded-circle img-profile" src="/images/nav_brand.jpg" />
        <a class="navbar-brand" title="Anasayfa" style="color: black;" href="/admin"><b>Özgür OSGB</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span></button>

        <ul class="navbar-nav navbar-expand mr-auto">
            <li class="nav-item">
                <div class="dropdown no-arrow">
                    <a style="color:black;" class="nav-link btn btn-warning dropdown-toggle" type="button"
                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-building"></i><span>&nbsp;İşletmeler</span></a>
                    <div class="dropdown-content" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" type="button" href="{{ route('companies') }}"><i
                                class="fas fa-stream"></i><span>&nbsp;İşletme Listesi</span></a>
                        <a class="dropdown-item" type="button" href="{{ route('deleted_companies') }}"><i
                                class="fas fa-eraser"></i><span>&nbsp;Silinen İşletmeler</span></a>
                        <a class="dropdown-item" type="button" href="{{ route('change_validate') }}"><i
                                class="fas fa-exchange-alt"></i><span>&nbsp;Onay Bekleyenler</span></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a style="color: black;" class="nav-link btn-warning" href="{{ route('reports') }}"><i
                        class="fas fa-folder"></i><span>&nbsp;Raporlar</span></a>
            </li>
            <li class="nav-item">
                <a style="color: black;" class="nav-link btn-warning" href=""><i
                        class="fas fa-calendar-alt"></i><span>&nbsp;Takvim</span></a>
            </li>
            <li class="nav-item"><a style="color: black;" class="nav-link btn-warning" href="{{ route('settings') }}"><i
                        class="fas fa-wrench"></i><span>&nbsp;Ayarlar</span></a></li>
            <li class="nav-item">
                <div class="dropdown no-arrow">
                    <button style="color:black;" class="nav-link btn btn-warning dropdown-toggle" type="button"
                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fas fa-users"></i><span>&nbsp;Çalışanlar</span></button>
                    <div class="dropdown-content" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" type="button" href="{{ route('osgb_employees') }}"><i
                                class="fas fa-stream"></i><span>&nbsp;Çalışan Listesi</span></a>
                        <a class="dropdown-item" type="button" href="{{ route('deleted_employees') }}"><i
                                class="fas fa-eraser"></i><span>&nbsp;Silinen Çalışanlar</span></a>
                        <a class="dropdown-item" type="button" href="{{ route('authentication') }}"><i
                                class="fas fa-user-edit"></i><span>&nbsp;Yetkilendir</span></a>
                    </div>
                </div>
            </li>

        </ul>
        <ul class="nav navbar-nav navbar-expand flex-nowrap ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown no-arrow">

                    <a href="{{ route('notifications') }}" title="Bildirimler" class="nav-link" data-bs-hover-animate="rubberBand">
                        <i style="color: black;" class="fas fa-bell fa-fw"></i>
                        <span class="badge badge-danger badge-counter"></span></a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown no-arrow">
                    <a style="color: black;" title="Mesajlar" href="{{ route('messages') }}" class="dropdown-toggle nav-link"
                        data-bs-hover-animate="rubberBand">
                        <i style="color: black;" class="fas fa-envelope fa-fw"></i>

                        <span class="badge badge-danger badge-counter"></span></a>
                </div>
                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                </div>
            </li>
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item">
                <div class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link" title="Profil">
                        <span style="color:black;" class="d-none d-lg-inline mr-2 text-600"></span><img
                            class="rounded-circle img-profile" src=""></a>
            </li>
            <div class="d-none d-sm-block topbar-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li class="nav-item"><a style="color: black;" title="Çıkış" class="nav-link" href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"><i
                            class="fas fa-sign-out-alt"></i><span>&nbsp;Çıkış</span></a></li>
            </form>


            </div>
        </ul>
    </nav>
    <div class="container-fluid">
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
    <script src="/js/chart.min.js"></script>
    <script src="/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="/js/theme.js"></script>
    <script type="text/javascript">
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script>
        $(document).ready(function() {
          $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
              $('#show_hide_password input').attr('type', 'password');
              $('#show_hide_password i').addClass("fa-eye-slash");
              $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
              $('#show_hide_password input').attr('type', 'text');
              $('#show_hide_password i').removeClass("fa-eye-slash");
              $('#show_hide_password i').addClass("fa-eye");
            }
          });
        });

    </script>
    <script>
        function myFunction() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("dataTable");
          tr = table.getElementsByTagName("tr");

          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }
    </script>

