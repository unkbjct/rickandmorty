@extends('layouts.main')

@section('title')
    Авторизация
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
        <script src="{{asset('public/js/bootstrap.min.js')}}"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('public/js/jquery-3.6.1.slim.min.js') }}"></script>

    <script src="{{ asset('public/js/admin/main.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('public/css/admin/admin.css') }}">
@endsection

@section('main-content')
    <!-- Modal -->
    <div class="modal fade" id="modalPublish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Публикация серии</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <p>Вы действительно хотите опубликовать серию?</p>
                    <p>После публикации ее нельзя будет удалить и снять с публикации.</p>
                    <p>Убедитесь что серия настроена и готова к публикации!</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.episode.publish', ['episode' => $episode->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">Опубликовать</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalRemove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить данную серию?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">

                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.episode.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idEpisode" id="idEpisode">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
    <main class="main my-5 row px-5">
        @include('admin.layouts.navigation')
        <section class="col-sm-9 justify-content-between ms-5 px-5 py-3">
            <div class="dropdown mb-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ "{$episode->season} Сезон {$episode->number} Серия. {$episode->name}." }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="max-height: 300px; overflow-y: scroll;">
                    @foreach($allEpisodes as $oneEpisode)
                    <li><a class="dropdown-item" href="{{route('admin.episode.current', ['episode' => $oneEpisode->id])}}">{{ "{$oneEpisode->season} Сезон {$oneEpisode->number} Серия. {$oneEpisode->name}." }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="content-current-episode">
                <div class="card shadow">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h4>{{ "{$episode->season} Сезон {$episode->number} Серия. {$episode->name}." }}</h4>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#video" aria-expanded="false" aria-controls="video">Показать/Скрыть видео</button>
                    </div>

                    <div class="collapse card-image-top" id="video">
                        @if($episode->url === '-')
                        <p class="text-center text-muted py-5 bg-light bg-gradient">Файл видео не загружен!</p>
                        @else
                        <div class="parent-iframe">
                            <iframe
                                src="{{ route('video', ['season' => $episode->season, 'episode' => $episode->number]) }}"
                                frameborder="0"></iframe>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.episode.change', ['episode' => $episode->id])}}" method="POST" class="row">
                            @csrf
                            <div class="col-1">
                                <label for="season" class="form-label">Сезон</label>
                                <select class="form-select" id="season" name="season">
                                    @foreach ($seasons as $season)
                                    <option @if($season->id === $episode->season) selected @endif value="{{$season->id}}">{{$season->number}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <label for="number" class="form-label">Серия</label>
                                <input type="number" name="number" value="{{$episode->number}}" class="form-control" id="number">
                            </div>
                            <div class="col-5">
                                <label for="name" class="form-label">Название серии</label>
                                <input type="text" name="name" value="{{$episode->name}}" class="form-control" id="name">
                            </div>
                            <div class="col-3">
                                <label for="date_published" class="form-label">Дата публикации</label>
                                <input type="text" name="date_published" value="{{$episode->date_published}}" class="form-control" id="date_published">
                            </div>
                            <div class="col-2">
                                <label for="exampleFormControlInput1" class="form-label" style="opacity: 0">заглушка</label>
                                <div class="">
                                    <input type="checkbox" value="last" @if($episode->tech_description) checked @endif class="btn-check" name="tech_description" id="tech_description" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="tech_description">Последняя серия?</label><br>
                                </div>
                            </div>
                            <div class="col-12 mb-4"></div>
                            <div class="col-5">
                                <label for="prev_episode" class="form-label">Предыдущия серия</label>
                                <select class="form-select" id="prev_episode" name="prev_episode">
                                    @foreach($allEpisodes as $oneEpisode)
                                    <option @if($episode->prev_episode === $oneEpisode->id) selected @endif value="{{$oneEpisode->id}}">{{ "{$oneEpisode->season} Сезон {$oneEpisode->number} Серия. {$oneEpisode->name}." }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="next_episode" class="form-label">Следующия серия</label>
                                <select class="form-select" name="next_episode" id="next_episode" aria-label="Default select example">
                                    @foreach($allEpisodes as $oneEpisode)
                                    <option @if($episode->next_episode === $oneEpisode->id) selected @endif value="{{$oneEpisode->id}}">{{ "{$oneEpisode->season} Сезон {$oneEpisode->number} Серия. {$oneEpisode->name}." }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="exampleFormControlInput1" class="form-label" style="opacity: 0">заглушка</label>
                                <div class="">
                                    <input type="checkbox" class="btn-check" id="published" autocomplete="off">
                                    @if($episode->published)
                                    <button type="button" class="btn btn btn-success" disabled>опубликована</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="btn-group mt-5" style="opacity: 1;">
                                    <button type="submit" class="btn btn-warning">Сохранить</button>
                                    @if(!$episode->published)
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalPublish" class="btn btn btn-success">Опубликовать серию</button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalRemove" data-episode-name="{{ $episode->name }}" data-episode-number="{{ $episode->number }}" data-episode-season="{{ $episode->season }}" data-id-episode="{{ $episode->id }}" class="btn btn-remove-episode btn btn-danger">Удалить</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
