@extends('layouts.main')

@section('title')
    Расписание серий
@endsection

@section('scripts')
    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('public/css/timetable.css') }}">
@endsection

@section('main-content')
<main class="container-sm mt-4 px-5">
    <div class="table-list m-auto">
        <h1 class="mb-5">Расписание серий Рик и Морти: </h1>
        @foreach ($seasons as $season)
        <table class="table table-striped shadow mb-5 table-item">
            <thead class="thead-dark">
              <tr>
                <th class="px-3 check-mark" scope="col" style="width: 50px"><img src="{{asset('public/storage/img/icons/done-32.png')}}" alt=""></th>
                <th scope="col" style="width: 50px"></th>
                <th scope="col" class="w-50">{{$season->season}} Сезон</th>
                <th scope="col"></th>
                {{-- <th scope="col"></th> --}}
              </tr>
            </thead>
            <tbody>
                
                @foreach ($episodes as $episode)
                    @if($episode->season == $season->season)
                    <tr>
                        <th class="px-3 check-mark" scope="row">@if($episode->published) <img src="{{asset('public/storage/img/icons/done-32.png')}}" alt=""> @endif</th>
                        <td class="td-first-child">{{$episode->number}}</td>
                        <td>{{$episode->name}}</td>
                        <td style="color: rgb(102, 102, 102)">{{$episode->date_published}}</td>
                        {{-- <td style="color: rgb(102, 102, 102)"><a class="link hidden" href="#">Смотреть</a></td> --}}
                    </tr>
                    @endif
                @endforeach
    
            </tbody>
          </table>
        @endforeach
    </div>
</main>
@endsection