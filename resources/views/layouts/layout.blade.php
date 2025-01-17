<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Zone</title>
    @yield('css')
   <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
   <link rel="stylesheet" href="{{asset('assets/css/Responsive.css')}}" />
   {{-- <link rel="stylesheet" href="{{asset('admin/assets/css/event.css')}}" />
   <link rel="stylesheet" href="{{asset('admin/assets/css/location.css')}}" />
   <link rel="stylesheet" href="{{asset('admin/assets/css/store.css')}}" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
</head>

<body>
    <!-- navbar -->
    <header>
        <h2 class="logo"><span>CAR</span>ZONE</h2>
        <!-- icon menu -->
        <i id="btnMenu" class="fa-solid fa-bars" id="btnMenu"></i>
        <nav class="navigation">
            <a href="{{route('home')}}">Home</a>
            <a href="{{route('store') }}">Store</a>
            <a href="{{route('location')}}">Location</a>
            <a href="{{route('event')}}">Event</a>
            <button class="btnLogin">Login</button>
        </nav>
    </header>

    <div class="overlady"></div>
    <div class="wrapper">
        <span class="icon-close">
            <!-- icon close -->
            <i class="fa-solid fa-xmark"></i>
        </span>
        <!-- form -->

        <!-- login -->
        <div class="from-box login">
            <h2>Login</h2>
            <form action="">
                <div class="input-box">
                    <span class="icon">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" placeholder=" " />
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" placeholder=" " />
                    <label>Password</label>
                </div>
                <div class="remember-forget">
                    <label><input type="checkbox" />Remember me</label>
                    <a href="#">Forget Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>
                        Don't have an account?
                        <a href="#" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
        <!-- Registeration -->
        <div class="from-box register">
            <h2>Registeration</h2>
            <form action="">
                <div class="input-box">
                    <span class="icon">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" placeholder=" " required />
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" placeholder=" " required />
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" placeholder=" " required />
                    <label>Password</label>
                </div>
                <div class="remember-forget">
                    <label><input type="checkbox" />
                        I agree to the terms & condition
                    </label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>
                        Already have an account?
                        <a href="#" class="login-link">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <!-- button to scroll -->
    <button id="btnScroll"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>

    <!-- about us -->
    <div class="main">
       @yield('content')

        <footer>
            <div class="footer-container">
                <div class="footer-logo">
                    <h2>CAR <span>ZONE</span></h2>
                    <p>Your trusted car service center. Excellence is our drive.</p>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('store')}}">Store</a></li>
                        <li><a href="{{route('location')}}">Location</a></li>
                        <li><a href="{{route('event')}}">Events</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <p>Email: support@carzone.com</p>
                    <p>Phone: 01557775652</p>
                    <p>Address: 23 Hamdi Shousha Street, Al-Marg</p>
                </div>
                <div class="footer-social">
                    <h3>Follow Us</h3>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Car Zone. All Rights Reserved.</p>
            </div>
        </footer>

    </div>



    <script src="{{asset('assets/JS/script.js')}}"></script>
</body>

</html>
