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


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="stylesheet" href="/css/dark.css" type="text/css" />
    <link rel="stylesheet" href="/css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />

    <!-- Font Awesome kit-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <title>@yield('title', 'Dianne | Welcome')</title>

</head>

<body>
    <nav class="navbar navbar-expand-md fixed-top" style = "margin-bottom: 10px">

        <button class="navbar-toggler navbar-light" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapse_target">
            <a class="navbar-brand"><img src="/img/diannelogo.png" width="70" height="70" alt="Dianne Logo"></a>


        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                @auth('vendor')
                    <a class="nav-link" href="{{ route('vendor.dashboard') }}">Home</a>
                @endauth

                @auth('admin')
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Home</a>
                @endauth

                @auth('web')
                    <a class="nav-link" href="/dashboard">Home</a>
                @endauth
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/marketplace"><li>Vendors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about"><li>About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact"><li>Contact Us</a>
            </li>
            <li class="nav-item-dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    @auth('vendor')
                    {{ Auth::guard('vendor')->user()->first_name }}
                    @endauth

                    @auth('admin')
                    {{ Auth::guard('admin')->user()->first_name }}
                    @endauth

                    @auth('web')
                    {{ Auth::user()->bride_first_name }}
                    @endauth
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @auth('vendor')
                        <a class="dropdown-item" href="{{ route('vendor.dashboard') }}">Dashboard</a>
                    @endauth

                    @auth('admin')
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    @endauth

                    @auth('web')
                        <a class="dropdown-item" href="/dashboard">Dashboard</a>
                    @endauth
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        </div>
    </nav>


<div class="container-fluid">
    @yield('content')
</div>
    @yield('js')

<!--FOOTER -->
    <footer class="page-footer myfooter font-small sticky-bottom border-top pt-5">
        <div class="container-fluid padding">
            <div class="row text-center">
                <div class="col-md-4">
                    <img src="/img/diannelogo.png" width="70" height="70" alt="Dianne Logo">
                    <hr class="dark">
                    <p>000-000-0000</p>
                    <p>dianneph@gmail.com</p>
                    <p>2544 Taft Ave</p>
                    <p>Malate, Manila, 1004</p>
                    <p>Metro Manila, Philippines</p>
                </div>
                <div class="col-md-4">
                    <hr class="dark">
                    <h5>Quick Links</h5>
                    <hr class="dark">
                    <ul class="footer-links">
                           <li><a class="nav-link" href="index"><li class="current">Home</a></li>
                        <li>
                            <a class="nav-link"  href="marketplace"><li>Vendors</a>
                        </li>
                        <li>
                            <a class="nav-link"  href="register"><li>Sign Up as a Soon To Wed</a>
                        </li>
                        <li>
                            <a class="nav-link"  href="vendor/register"><li>Subcribe to be a Vendor</a>
                        </li>
                        <li>
                            <a class="nav-link"  href="login"><li>Login</a>
                        </li>
                        <li>
                            <a class="nav-link"  href="about"><li>About Us</a>
                        </li>
                        <li>
                            <a class="nav-link"  href="contact"><li>Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <hr class="dark">
                    <h5>&copy; De La Salle-College of Saint Benilde</h5>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>