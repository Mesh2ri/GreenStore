<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom pt-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('website.home') }}"><span class="text-success">Green Store</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('website.home') }}">الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('website.products') }}">المنتجات</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.orders.index') }}">طلباتي</a></li>
                @endauth
                <li class="nav-item"><a class="nav-link" href="{{ route('website.contact') }}">تواصل معنا</a></li>
            </ul>

            <ul class="navbar-nav me-auto">
                <!-- سلة المشتريات -->
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart.view') }}">
                        🛒 السلة
                        @php
                            $cartCount = is_array(session('cart')) ? array_sum(array_column(session('cart'), 'quantity')) : 0;
                        @endphp
                        @if ($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                                <span class="visually-hidden">عدد المنتجات في السلة</span>
                            </span>
                        @endif
                    </a>
                </li>

                <!-- تسجيل الدخول / تسجيل الخروج -->
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a></li>
                @else
                    <li class="nav-item d-flex align-items-center">
                        <span class="nav-link">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </div>
</nav>
