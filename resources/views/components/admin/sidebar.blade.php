<div class="bg-light border-end vh-100" id="sidebar-wrapper">
    <div class="sidebar-heading p-3 bg-dark text-white">
        مرحباً، {{ Auth::user()->name }}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#side">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="list-group list-group-flush" id="side">
        <a href="{{ route('dashboard.index') }}" class="list-group-item list-group-item-action bg-light">الرئيسية</a>
        <a href="{{ route('dashboard.products.index') }}" class="list-group-item list-group-item-action bg-light">المنتجات</a>
        <a href="{{ route('dashboard.categories.index') }}" class="list-group-item list-group-item-action bg-light">التصنيفات</a>
        <a href="{{ route('dashboard.orders.index') }}" class="list-group-item list-group-item-action bg-light">الطلبات</a>
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action bg-light text-danger"
           onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
            تسجيل الخروج
        </a>
        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
