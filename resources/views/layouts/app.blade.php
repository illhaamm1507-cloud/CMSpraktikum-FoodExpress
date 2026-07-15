<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FoodExpress</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f8f9fa;
        }

        /* ==========================
           NAVBAR
        =========================== */

        .navbar{
            background:#198754 !important;
            padding:15px 0;
            box-shadow:0 5px 15px rgba(0,0,0,.15);
        }

        .navbar-brand{
            font-size:30px;
            font-weight:bold;
            color:#fff !important;
        }

        .navbar-nav .nav-link{
            color:#fff !important;
            font-size:16px;
            font-weight:500;
            margin:0 8px;
            transition:.3s;
        }

        .navbar-nav .nav-link:hover{
            color:#ffc107 !important;
        }

        .navbar-nav .nav-link.active{
            color:#ffc107 !important;
            font-weight:bold;
        }

        .dropdown-menu{
            border-radius:12px;
        }

        .btn-login{
            border-radius:30px;
            padding:8px 22px;
            font-weight:bold;
        }

        /* ==========================
           CARD
        =========================== */

        .food-card{
            border:none;
            border-radius:20px;
            overflow:hidden;
            transition:.3s;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        .food-card:hover{
            transform:translateY(-10px);
            box-shadow:0 15px 35px rgba(0,0,0,.2);
        }

        .food-image{
            width:100%;
            height:250px;
            object-fit:cover;
        }

        .category-card{
            border:none;
            border-radius:15px;
            transition:.3s;
        }

        .category-card:hover{
            transform:translateY(-5px);
        }

        /* ==========================
           HERO
        =========================== */

        .hero{
            background:
            linear-gradient(rgba(0,0,0,.5),rgba(0,0,0,.5)),
            url('https://images.unsplash.com/photo-1504674900247-0877df9cc836');

            background-size:cover;
            background-position:center;
            min-height:600px;

            display:flex;
            align-items:center;

            color:white;
        }

        .hero-text{
            max-width:700px;
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">

    <div class="container">

        <a class="navbar-brand" href="/">
            🍔 FoodExpress
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto align-items-center">

    {{-- HOME --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
            href="/">
            Home
        </a>
    </li>

    @auth

        {{-- ================= ADMIN ================= --}}
        @if(Auth::user()->isAdmin())

            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}"
                    href="{{ route('kategori.index') }}">
                    Kategori
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('makanan*') ? 'active' : '' }}"
                    href="{{ route('makanan.index') }}">
                    Makanan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('pesanan*') ? 'active' : '' }}"
                    href="{{ route('pesanan.index') }}">
                    Pesanan
                </a>
            </li>

        {{-- ================= CUSTOMER ================= --}}
        @else

            <li class="nav-item">
                <a class="nav-link {{ request()->is('cart*') ? 'active' : '' }}"
                    href="/cart">
                    Keranjang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('pesanan-saya') ? 'active' : '' }}"
                    href="{{ route('pesanan.saya') }}">
                    Pesanan Saya
                </a>
            </li>

        @endif

        {{-- ================= DROPDOWN USER ================= --}}
        <li class="nav-item dropdown ms-3">

            <a class="nav-link dropdown-toggle fw-bold"
                href="#"
                role="button"
                data-bs-toggle="dropdown">

                👤 {{ Auth::user()->name }}

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                @if(Auth::user()->isAdmin())

                    <li>
                        <a class="dropdown-item"
                            href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                @else

                    <li>
                        <a class="dropdown-item"
                            href="{{ route('pesanan.saya') }}">
                            Pesanan Saya
                        </a>
                    </li>

                @endif

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <form method="POST"
                        action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="dropdown-item text-danger">
                            Logout
                        </button>

                    </form>

                </li>

            </ul>

        </li>

    @else

        {{-- GUEST --}}
        <li class="nav-item ms-3">

            <a href="{{ route('login') }}"
                class="btn btn-light text-success btn-login">
                Login
            </a>

        </li>

        <li class="nav-item ms-2">

            <a href="{{ route('register') }}"
                class="btn btn-warning btn-login">
                Register
            </a>

        </li>

    @endauth

</ul>

        </div>

    </div>

</nav>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>