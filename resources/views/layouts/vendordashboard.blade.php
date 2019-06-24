<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets2/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title', 'Dashboard | DIANNE')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-color="white" data-active-color="danger">

        <div class="logo">
            <div class="logo-image-small">
                <img src="/img/diannelogo.png" width="80" height="80" style="margin-left: 70px; margin-top:20px;">
                <h4 style="margin-top: 20px; margin-left: 40px">Dashboard</h4>
            </div>
        </div>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li{{ request()->is('/vendor/dashboard') ? ' class=active' : '' }}>
                    <a href="/vendor/dashboard">
                        <i class="nc-icon nc-single-02"></i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li{{ request()->is('/vendor/summary') ? ' class=active' : '' }}>
                    <a href="/vendor/summary">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>Summary</p>
                    </a>
                </li>
                <li{{ request()->is('/vendor/portfolio') ? 'class=active' : '' }}>
                    <a href="/vendor/portfolio">
                        <i class="nc-icon nc-album-2"></i>
                        <p>Vendor Portfolio</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#bookings">
                        <i class="nc-icon nc-badge"></i>
                        <p>Bookings
                            <b class="caret"></b>
                        </p>
                    </a>

                    <div class="collapse" id="bookings">
                        <ul class="nav">
                            <li>
                                <a href="/vendor/bookings/new">
                                    <span class="sidebar-mini-icon"><i class="nc-icon nc-diamond"></i></span>
                                    <span class="sidebar-normal">New Bookings</span>
                                </a>
                            </li>
                            <li>
                                <a href="/vendor/bookings">
                                    <span class="sidebar-mini-icon"><i class="nc-icon nc-satisfied"></i></span>
                                    <span class="sidebar-normal">Manage</span>
                                </a>
                            </li>
                            <li>
                                <a href="/vendor/bookings/history">
                                    <span class="sidebar-mini-icon"><i class="nc-icon nc-bell-55"></i></span>
                                    <span class="sidebar-normal">History</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li{{ request()->is('/vendor/clients') ? 'class=active' : '' }}>
                    <a href="/vendor/clients">
                        <i class="nc-icon nc-circle-10"></i>
                        <p>My Clients</p>
                    </a>
                </li>
                <li{{ request()->is('/vendor/income') ? 'class=active' : '' }}>
                    <a href="/vendor/income">
                        <i class="nc-icon nc-money-coins"></i>
                        <p>Income</p>
                    </a>
                </li>
                <li{{ request()->is('/vendor/feedback') ? 'class=active' : '' }}>
                    <a href="/vendor/feedback">
                        <i class="nc-icon nc-satisfied"></i>
                        <p>Feedbacks</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="/vendor/dashboard">Dianne</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link btn-magnify" href="/marketplace">
                                <i class="nc-icon nc-shop"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Marketplace</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-magnify" href="#">
                                <i class="nc-icon nc-chat-33"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Messages</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-rotate" href="#">
                                <i class="nc-icon nc-tap-01"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Report</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="nc-icon nc-settings-gear-65"></i>
                                <p>
                                    <span class="d-lg-none d-md-block"></span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

<!--   Core JS Files   -->
<script src="/assets2/js/core/jquery.min.js"></script>
<script src="/assets2/js/core/popper.min.js"></script>
<script src="/assets2/js/core/bootstrap.min.js"></script>
<script src="/assets2/js/plugins/perfect-scrollbar.jquery.min.js"></script>

<!-- Chart JS -->
<script src="/assets2/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="/assets2/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets2/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="/assets2/demo/demo.js"></script>

<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
    });
</script>

<link href="/vendorstyles/style.css" rel="stylesheet"/>
<link href="/assets2/css/bootstrap.min.css" rel="stylesheet" />
<link href="/assets2/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
</body>

</html>