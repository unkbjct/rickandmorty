@extends('layouts.main')

@section('scripts')
    <script src="{{ asset('public/js/jquery-3.6.1.slim.min.js') }}"></script>
    <script src="{{ asset('public/js/welcome.js') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/donations.css') }}">
@endsection

@section('main-content')
<main class="container-sm mt-5">
    <div class="donations-content m-auto border p-4 rounded shadow-sm">
        <div class="thanks text-align-center">
            <h1 class="display-2">Спасибо</h1>
            <p>что посещаете данный интернет ресурс. Разработчику очень приятно!</p>
        </div>
        <blockquote class="blockquote">
            <p class="mb-0">Сайт был создан как курсовая работа, как говориться <em>"на коленках"</em>. 
                Но в какой-то момент мне понравилось то что выходит, и я начал вкладывать душу в то что я делаю. 
                Так же могу сказать что данный проект был вдохновлен кое-кем, а точнее <a href="https://animatron.tv/" class="link">вот этим</a>, так что можно смело сказать <span class="text-uppercase">СПИЗЖЕНО</span>.
                <br><br>

                Если у вас есть какие-нибудь пожелания или же наоборот - критика, вы можете описать ее в <a href="https://animatron.tv/" class="link">данной форме</a>. Так же если вы хотите купить студенту (разработчику) чашку кофе (ну или пачку сигарет), вы можете пожертвовать ему прямо здесь.
                Сайт будет потихоньку обновляться и модерироваться. Всем добра и позитива!!</p>
          </blockquote>
        <p></p>
    </div>
</main>
@endsection