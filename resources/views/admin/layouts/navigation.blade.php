<section class="col-sm-2 pe-4">
    <ul class="navbar-nav admin-navbar border shadow rounded mb-5">
        <a href="{{ route('admin') }}">
            <li class="@if (Route::current()->getName() == 'admin') _active-nav-item @endif nav-item rounded-top px-5 py-3">
                <p>Личный кабинет</p>
            </li>
        </a>
        <a href="{{route('admin.episodes')}}">
            <li class="nav-item px-5 py-3">
                <p>Серии</p>
            </li>
        </a>
        <li class="nav-item px-5 py-3">
            <p>Сезоны</p>
        </li>
        <a href="{{ route('admin.news.view') }}">
            <li class="@if (Route::current()->getName() == 'admin.news.view') _active-nav-item @endif nav-item px-5 py-3">
                <p>Новости</p>
            </li>
        </a>
        <a href="{{ route('account.logout') }}">
            <li class="nav-item rounded-bottom px-5 py-3">
                <p>Выйти</p>
            </li>
        </a>
    </ul>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success') !== null)
        <div class="alert alert-success">
            <ul>
                <li>{{ session('success') }}</li>
            </ul>
        </div>
    @endif
</section>
