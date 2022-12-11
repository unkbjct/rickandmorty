@extends('layouts.main')

@section('title')
    {{ "{$currentEpisode->season} сезон, {$currentEpisode->number} серия" }}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/watch.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('public/css/watch.css') }}">
@endsection

@section('main-content')
<main class="container-sm mt-4 px-5">
    <h1 class="text-center lead mb-4">  {{ "{$currentEpisode->season} сезон {$currentEpisode->number} серия.  {$currentEpisode->name}"}}</h1>
    <div class="parent-iframe">
        <iframe id="iframe" style="width: 100%" src="{{route('video', ['season' => $currentEpisode->season, 'episode' => $currentEpisode->number])}}" frameborder="0"></iframe>
    </div>
    <div class="controls-episodes d-flex justify-content-center mb-5 mt-2 mx-5">
        <div class="controls-episode-item prev">
            @if ($currentEpisode->tech_description == 'first' )
            <button class="btn btn-success" style="opacity: 0;" disabled type="button">предыдущая серия</button>
            @else 
            <a style="width: 100%" class="gap-2" href="{{route('watch', ['season' => $prevEpisode->season, 'episode' => $prevEpisode->number])}}"><button class="btn btn-success" type="button">предыдущая серия</button></a>
            @endif
        </div>
        <div class="controls-episode-item d-flex justify-content-center current">
            <div class="dropup">
                <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown" type="button" id="dropdownMenuButton"
                  data-mdb-toggle="dropdown" aria-expanded="false">
                  {{ "{$currentEpisode->season} сезон {$currentEpisode->number} серия"}}
                </button>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($seasons as $season)
                    <li>
                        <a class="dropdown-item" href="{{route('watch', ['season' => $season->season, 'episode' => 1])}}">{{$season->season}} сезон &raquo;</a>
                        <ul class="dropdown-menu dropdown-submenu">
                            @foreach ($episodes as $episode)
                            @if ($episode->season == $season->season)
                            <li>
                                <a class="dropdown-item" href="{{route('watch', ['season' => $season->season, 'episode' => $episode->number])}}">{{$episode->number}} серия. {{$episode->name}} </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
              </div>
        </div>
        <div class="controls-episode-item next">
            @if ($currentEpisode->tech_description == 'last' )
            <button class="btn btn-outline-success" style="opacity: 0;" disabled type="button">Следующия серия</button>
            @else 
            <a style="width: 100%" class="gap-2" href="{{route('watch', ['season' => $nextEpisode->season, 'episode' => $nextEpisode->number])}}"><button class="btn btn-success" type="button">Следующия серия</button></a>
            @endif
        </div>
    </div>

    <div class="comment-content p-5">

        <div class=" d-flex justify-content-between mb-4">
            <h3>Комментарии </h3>
            <button id="btn-add-new-comment" class="btn btn-warning">Оставить комментарий</button>
        </div>

        <ul class="comments-list p-0">
            @each('comment.show', $comments, 'comment')
        </ul>
        <form id="form-add-comment" class="border rounded shadow-sm p-3 mb-3" method="POST" action="{{route('comment.create', ['season' => $currentEpisode->season, 'episode' => $currentEpisode->number])}}">
            <span class="cross"><img id="cross-img" src="{{asset('public/storage/img/icons/cross.png')}}" alt=""></span> 
            @csrf
            <input type="hidden" name="parent_id" id="parent_id">
            <div class="mb-3"> 
                <label for="name" class="form-label">Имя</label> 
                <input type="text" autocomplete="off" @if(null !==session('name')) value="{{session('name')}}" @endif class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Сыендук"> 
                <div id="emailHelp" class="form-text">Скорее никнейм, который будет отображаться на сайте!</div> 
            </div> 
            <div class="mb-3"> 
                <label for="email" class="form-label">Почта</label> 
                <input type="email" autocomplete="off" @if(null !==session('email')) value="{{session('email')}}" @endif class="form-control" id="email" name="email" aria-describedby="emailHelp" 
                    placeholder="styx1man2@gmail.com"> 
                <div id="emailHelp" class="form-text">Почта не будет опубликована!</div> 
            </div> 
            <div class="mb-3"> 
                <label for="message" class="form-label">Коментарий</label> 
                <textarea maxlength="400" class="form-control" id="message" name="message" rows="3"></textarea> 
            </div> 
            @if(null == session('name'))
            <div class="mb-3 form-check"> 
                <input type="checkbox" class="form-check-input" name="saveData" id="saveData"> 
                <label class="form-check-label" for="saveData">Сохранить данные в браузере для следующих комментариев</label> 
            </div>
            @endif
            <button type="submit" class="btn btn-primary">Оставить коментарий</button> 
        </form>
    </div>
</main>
@endsection