@extends('layouts.main')

@section('scripts')
    <script src="{{ asset('public/js/jquery-3.6.1.slim.min.js') }}"></script>
    <script src="{{ asset('public/js/welcome.js') }}"></script>
@endsection

@section('main-content')
<main class="container-sm mt-5">
    <div class="row">
        @foreach ($seasons as $season)
        <div class="col">
            <a class="link-to-season" href="#season-{{$season->number}}">
                <div class="d-flex justify-content-center">
                    <img src="{{asset($season->img)}}" class="season-image rounded float-left" height="200px">
                </div>
            </a>
            <h3 class="lead text-center mt-1">{{$season->number}} сезон</h3>
        </div>
        @endforeach
    </div>

    @foreach ($seasons as $season)
    <div class="season mt-5 p-2" data-season="season-{{$season->number}}">
        <div class="d-flex flex-wrap mt-3">
            <iframe width="560" height="315" src="{{$season->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="info mx-5">
                <h1 class="display-6 ">{{$season->number}} cезон </h1>
                <p class="mt-3">Количество серий: {{$season->count_episodes}}</p>
                <p>Дата вахода: {{$season->date}}</p>
                <p>Перевод на русский: <a href="{{$season->translate_url}}" class="link-info">{{$season->translate_name}}</a></p>
                <a href="{{route('watch', ['season' => $season->number, 'episode' => 1])}}"><button type="button" class="Aligned-flex-item btn btn-primary">Смотреть</button></a>
            </div>
        </div>
    </div>
    @endforeach


</main>
@endsection