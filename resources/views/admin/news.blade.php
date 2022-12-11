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
        <section class="col-sm-9 justify-content-between row ms-5 px-5 py-3">
            <div>
                <div class="news-list row m-auto">
                    @foreach ($posts as $post)
                        <div class="col-md-9 news-item rounded shadow border p-4  m-5">
                            <button type="button" class="btn-close" style="float: right" aria-label="Close"></button>
                            <h3 class="mb-3">{{ $post->title }}</h3>
                            <p>{{ $post->message }}</p>
                            <p class="date">{{ $post->created_at }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
