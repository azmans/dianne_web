<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--responsive-->
    <meta name="viewport" content="width=device-width">
    <!--SEOs-->
    <meta name="description" content= "Wedding Planning">
    <meta name="keywords" content="dianne, wedding planner">
    <meta name="author" content="Sarah Azman, Beatrice Ignacio, Hyein Jung, Ian Patrick Rodriguez">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <title>@yield('title', 'Dianne | Welcome')</title>

</head>

<body>
<!--SIDEBAR-->
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
                    <li{{ request()->is('admin.dashboard') ? ' class=active' : '' }}>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#user_management">
                            <i class="nc-icon nc-settings-gear-65"></i>
                            <p>User Management
                                <b class="caret"></b>
                            </p>
                        </a>

                        <div class="collapse" id="user_management">
                            <ul class="nav">
                                <li>
                                    <a href="/admin/vendors">
                                        <span class="sidebar-mini-icon"><i class="nc-icon nc-diamond"></i></span>
                                        <span class="sidebar-normal">Vendors</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/soon-to-weds">
                                        <span class="sidebar-mini-icon"><i class="nc-icon nc-satisfied"></i></span>
                                        <span class="sidebar-normal">Soon-to-weds</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/reports/soon-to-weds">
                                        <span class="sidebar-mini-icon"><i class="nc-icon nc-bell-55"></i></span>
                                        <span class="sidebar-normal">Soon-to-wed Reports</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/reports/vendors">
                                        <span class="sidebar-mini-icon"><i class="nc-icon nc-tap-01"></i></span>
                                        <span class="sidebar-normal">Vendor Reports</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/audits">
                                        <span class="sidebar-mini-icon"><i class="nc-icon nc-tap-01"></i></span>
                                        <span class="sidebar-normal">Audits</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/blacklist">
                                        <span class="sidebar-mini-icon"><i class="nc-icon nc-key-05"></i></span>
                                        <span class="sidebar-normal">Blacklist</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li{{ request()->is('vendors') ? ' class=active' : '' }}>
                        <a href="/admin/vendors/approve">
                            <i class="nc-icon nc-bulb-63"></i>
                            <p>New Vendors</p>
                        </a>
                    </li>
                    <li{{ request()->is('content-management') ? ' class=active' : '' }}>
                        <a href="/#">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>Manage Content</p>
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
                        <a class="navbar-brand" href="#pablo">Dianne</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link btn-magnify" href="marketplace">
                                    <i class="nc-icon nc-shop"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Marketplace</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn-magnify" href="#pablo">
                                    <i class="nc-icon nc-chat-33"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Messages</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn-rotate" href="#pablo">
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
    <script src="/assets/js/core/jquery.min.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

    <!-- Chart JS -->
    <script src="/assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>

        <!-- CSS Files -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
</body>
</html>