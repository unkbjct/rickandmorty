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
    <link rel="stylesheet" href="{{ asset('public/css/admin/login.css') }}">
@endsection

@section('main-content')
    <main class="container-sm mt-4 px-5">
        <div class="login-content mx-auto my-5 p-5">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('account.menage.login') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    {{-- <?dd($email)?> --}}
                    <input type="email" @if(Session::has('email')) value="{{ Session::get('email') }}" @endif name="email" class="form-control" id="email" aria-describedby="emailHelp"
                        placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group mb-3">
                    <label for="passwd">Password</label>
                    <input type="password" name="passwd" class="form-control" id="passwd" placeholder="Password">
                </div>
                <div class="form-check ">
                    <input type="checkbox" name="stayInSystem" class="form-check-input" id="stayInSystem">
                    <label class="form-check-label" for="stayInSystem">Stay in the system</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>
@endsection
