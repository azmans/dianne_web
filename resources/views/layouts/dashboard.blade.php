<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('title', 'Dashboard | DIANNE')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
                <li{{ request()->is('dashboard') ? ' class=active' : '' }}>
                    <a href="/dashboard">
                        <i class="nc-icon nc-single-02"></i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li{{ request()->is('summary') ? ' class=active' : '' }}>
                    <a href="/summary">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>Summary</p>
                    </a>
                </li>
                <li{{ request()->is('couple-page') ? ' class=active' : '' }}>
                    <a href="/couple-page">
                        <i class="nc-icon nc-album-2"></i>
                        <p>Couple Page</p>
                    </a>
                </li>
                <li{{ request()->is('budget-tracker') ? ' class=active' : '' }}>
                    <a href="/budget-tracker">
                        <i class="nc-icon nc-tag-content"></i>
                        <p>Budget Tracker</p>
                    </a>
                </li>
                <li{{ request()->is('guestlist') ? ' class=active' : '' }}>
                    <a href="/guestlist">
                        <i class="nc-icon nc-bullet-list-67"></i>
                        <p>Guest List Manager</p>
                    </a>
                </li>
                <li{{ request()->is('my-vendors') ? ' class=active' : '' }}>
                    <a href="/my-vendors">
                        <i class="nc-icon nc-circle-10"></i>
                        <p>My Vendors</p>
                    </a>
                </li>
                <li{{ request()->is('booking-requests') ? ' class=active' : '' }}>
                    <a href="/booking-requests">
                        <i class="nc-icon nc-book-bookmark"></i>
                        <p>Booking Requests</p>
                    </a>
                </li>
                <li>
                    <a href="./upgrade.html">
                        <i class="nc-icon nc-satisfied"></i>
                        <p>Feedbacks</p>
                    </a>
                </li>
                <li{{ request()->is('payments') ? ' class=active' : '' }}>
                    <a href="/payments">
                        <i class="nc-icon nc-money-coins"></i>
                        <p>Payments</p>
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
                    <a class="navbar-brand" href="/dashboard">Dianne</a>
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
                                    <span class="d-lg-none d-md-block">Some Actions</span>
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
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="/assets/demo/demo.js"></script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
    });
</script>

<!-- Dynamic star rating system -->
<!--<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>-->

<!-- CSS Files -->
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="/assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
</body>

</html>