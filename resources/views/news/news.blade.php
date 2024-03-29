@extends('layouts.main')

@section('title')
    Расписание серий
@endsection

@section('scripts')
   
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('public/css/news.css') }}">
@endsection

@section('main-content')
<main class="container-sm mt-4 px-5">
    <div class="news-list row m-auto">
        <div class="col news-item rounded shadow border p-4  m-5">
            <h3 class="mb-3">Огурчики и межгалактические коктейли в кулинарной книге по "Рик и Морти"</h3>
            <p>AdultSwim решила не ограничиваться мультсериалом, комиксами, фигурками и другим мерчом, и анонсировала выпуск кулинарной книги по "Рик и Морти". Занимаются ей Джеймс Асмус и Август Крейг, а приготовить можно будет множество знакомых блюд. Особенно фанатов должны порадовать Solenya — да, можно будет сделать огурчика Рика. Всего будет 50 рецептов: от закусок до напитков.</p>
            <p class="date">2022-09-16 20:04:52</p>
        </div>
        <div class="w-100"></div>
        <div class="col news-item rounded shadow border p-4  m-5">
            <h3 class="mb-3">Российский художник показал, как мог бы выглядеть "Рик и Морти" от советских мультипликаторов</h3>
            <p class="">Российский художник Prokky, работающий на Союзмультфильме, показал, как мог бы выглядеть мультсериал "Рик и Морти", если бы им занимались советские мультипликаторы. Он создал тред в твиттере, который довольно быстро стал популярным. Сейчас у него почти шесть тысяч лайков. В нем он показал, как мог выглядеть мультфильм от Александра Татарского и Игоря Ковалева, авторов "Следствие ведут колобки", Давида Черкасского ("Остров сокровищ"), Леонида Носырева ("Антошка") и Аркадия Шера "Каникулы в Простоквашино".</p>
            <p class="date">2022-09-16 20:04:52</p>
        </div>
        <div class="w-100"></div>
        <div class="col news-item rounded shadow border p-4 m-5">
            <h3 class="mb-3">Рик становится Кратосом в новой рекламе God of War Ragnarok</h3>
            <p>Adult Swim опубликовал забавную рекламу God of War Ragnarok с Риком и Морти из одноименного анимационного шоу. Персонажи, как обычно, отправились в новое приключение — в девять миров. Как обычно, приключение на 20 минут, вошли и вышли.</p>
            <p class="date">2022-09-16 20:04:52</p>
        </div>
        <div class="w-100"></div>
    </div>
</main>
@endsection