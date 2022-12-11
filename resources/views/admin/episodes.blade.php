@extends('layouts.main')

@section('title')
    Авторизация
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('public/js/jquery-3.6.1.slim.min.js') }}"></script>

    <script src="{{ asset('public/js/admin/main.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('public/css/admin/admin.css') }}">
@endsection

@section('main-content')
    <!-- Modal -->
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
        <section class="col-sm-9 justify-content-between row ms-5 px-5 py-3">
            <div>
                <div class="news-list m-auto">

                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">Серия</th>
                                <th scope="col">Название</th>
                                <th scope="col">Настройки</th>
                                <th scope="col">Настройки</th>

                            </tr>
                        </thead>
                        @foreach ($seasons as $season)
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">{{ "{$season->season} Сезон" }}</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            @foreach ($episodes as $episode)
                                @if ($episode->season == $season->season)
                                    <tr>
                                        <td>{{ $episode->number }}</td>
                                        <td>{{ $episode->name }}</td>
                                        <td>
                                            @if ($episode->published)
                                                <p>Опубликована</p>
                                            @else
                                                <p>НЕ Опубликована</p>
                                            @endif
                                        </td>
                                        <td style="text-align: end" class="pe-5">
                                            <div class="btn-group " role="group" aria-label="Basic example"
                                                style="height: 40px">
                                                @if (!$episode->published)
                                                    <button type="button" class="btn btn-success">Опубликовать</button>
                                                @endif
                                                <a href="{{ route('admin.episode.current', ['episode' => $episode->id]) }}">
                                                    <button style="height: 100%" type="button" class="btn btn-warning"><img
                                                            style="height: 100%"
                                                            src="{{ asset('public/storage/img/icons/admin/edit.png') }}"
                                                            alt="">
                                                    </button>
                                                </a>
                                                @if (!$episode->published)
                                                    <button data-episode-name="{{ $episode->name }}"
                                                        data-episode-number="{{ $episode->number }}"
                                                        data-episode-season="{{ $episode->season }}"
                                                        data-id-episode="{{ $episode->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#modalRemove" type="button"
                                                        class="btn btn-danger btn-remove-episode"><img style="height: 100%"
                                                            src="{{ asset('public/storage/img/icons/admin/remove.png') }}"
                                                            alt="">
                                                    </button>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
