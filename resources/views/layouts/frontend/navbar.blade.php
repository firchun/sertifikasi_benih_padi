<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img loading="prelaod" decoding="async" class="img-fluid" width="80" src="{{ asset('img/logo2.png') }}"
                alt="SIS Benih Padi">
            <span class="fw-bold text-success" style="font-size: 20px;">SIS Benih Padi</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"> <a class="nav-link {{ request()->is('/') ? 'text-primary ' : '' }}"
                        href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item"> <a class="nav-link {{ request()->is('maps') ? 'text-primary ' : '' }}"
                        href="{{ url('/maps') }}">Lokasi Penangkar</a>
                </li>
                <li class="nav-item"> <a class="nav-link {{ request()->is('stoks') ? 'text-primary ' : '' }}"
                        href="{{ url('/stoks') }}">Stok Benih</a>
                </li>
                <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle show" href="#"
                        id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">Informasi</a>
                    <ul class="dropdown-menu show" aria-labelledby="navbarDropdown" data-bs-popper="none">
                        <li><a class="dropdown-item {{ request()->is('varietas-unggulan') ? 'text-primary ' : '' }}"
                                href="{{ url('/varietas-unggulan') }}">Varietas
                                Unggulan</a>
                        </li>
                        <li><a class="dropdown-item {{ request()->is('lahan') ? 'text-primary ' : '' }}"
                                href="{{ url('/lahan') }}">Pemanfaatan Lahan Pertanian</a>
                        </li>
                        <li><a class="dropdown-item {{ request()->is('penanaman-padi') ? 'text-primary ' : '' }}"
                                href="{{ url('/penanaman-padi') }}">Penanaman Benih Padi</a>
                        </li>
                    </ul>
                </li>
            </ul>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Log In</a>
                <a href="{{ route('register') }}" class="btn btn-primary ms-2 ms-lg-3">Sign Up</a>
            @else
                <a href="{{ route('home') }}" class="btn btn-primary ms-2 ms-lg-3">Dashboard</a>
            @endguest
        </div>
    </div>
</nav>
