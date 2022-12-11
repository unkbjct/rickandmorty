@extends('layouts.main')

@section('title')
    Авторизация
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('public/js/watch.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('public/css/admin/admin.css') }}">
@endsection

@section('main-content')
    <main class="main my-5 row px-5">
        @include('admin.layouts.navigation')
        <section class="col-sm-9 admin-settings shadow rounded border justify-content-between row ms-5 py-3">
            <form method="POST" action="{{ route('account.change.password') }}" class="col-5 ms-5">
                @csrf
                <h2 class="my-5">Изменить пароль</h2>
                <div class="form-group mb-3">
                    <label for="oldPasswd">Старый пароль</label>
                    <input type="password" name="oldPasswd" class="form-control" id="oldPasswd" placeholder="Password">
                </div>
                <div class="form-group mb-3">
                    <label for="newPasswd">Новый пароль</label>
                    <input type="password" name="newPasswd" class="form-control" id="newPasswd" placeholder="Password">
                </div>
                <div class="form-group mb-3">
                    <label for="confirmNewPasswd">Подтверждение пароля</label>
                    <input type="password" name="confirmNewPasswd" class="form-control" id="confirmNewPasswd" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
            <form method="POST" action="{{ route('account.change.email') }}" class="col-5 me-5">
                @csrf
                <h2 class="my-5">Изменить почту</h2>
                <div class="mb-3">
                    <label for="email" class="form-label">Почта</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" id="email" placeholder="name@example.com">
                </div>
                <div class="form-group mb-3">
                    <label for="passwd">Пароль</label>
                    <input type="password" name="passwd" class="form-control" id="passwd" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </section>
    </main>
@endsection
