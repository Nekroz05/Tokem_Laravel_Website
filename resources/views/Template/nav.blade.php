<nav class="navbar">

    <a href="{{ route('home') }}" class="logo"><img src="storage/Assets/logo.png" alt=""></a>

    <div class="mid-nav flex">
        @if (Auth::check() && Auth::User()->role == 2)
            <a class="me-4 text-decoration-none fs-5 p-0 fw-bold" href="{{ route('products') }}"> Manage Products </a>
            <a class="me-4 text-decoration-none fs-5 p-0 fw-bold" href="{{ route('category') }}"> Add Category </a>
        @else
            @if (Auth::check())
                <a class="me-4 text-decoration-none fs-5 p-0 fw-bold" href="{{ route('history') }}"> My Transaction </a>
            @endif
            <a class="me-4 text-decoration-none fs-5 p-0 fw-bold" href="{{ route('products') }}"> Products </a>
        @endif

        <a class="me-4 text-decoration-none fs-5 p-0 fw-bold" href="{{ route('about') }}"> About Us </a>

    </div>

    <div class="right-nav flex">
        {{-- {{ DD(Auth::check()); }} --}}
        @if (Auth::check())
            @if (Auth::user()->role == 2)
                <a class="mx-4 btn btn-primary rounded-4" href="{{ route('logout') }}">Sign Out</a>
                <a class="me-4 text-decoration-none fs-4 p-0 fw-bold" href="{{ route('profile') }}">
                    {{ Auth::user()->name }} </a>
            @else
                <a class="mx-4 btn btn-primary rounded-4" href="{{ route('cart') }}">My Cart</a>
                <a class="mx-4 btn btn-primary rounded-4" href="{{ route('logout') }}">Sign Out</a>
                <a class="me-4 text-decoration-none fs-4 p-0 fw-bold" href="{{ route('profile') }}">
                    {{ Auth::user()->name }} </a>
            @endif
        @else
            <a class="mx-4 btn btn-primary rounded-4" href="{{ route('login') }}">Sign In</a>
            <a class="mx-4 btn btn-primary rounded-4" href="{{ route('create') }}">Sign Up</a>
        @endif

    </div>

</nav>
