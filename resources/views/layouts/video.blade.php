
<!DOCTYPE html>
<html lang="en" id="video-html">
<head>
    <script src="{{ asset('public/js/jquery-3.6.1.slim.min.js') }}"></script>
    <script src="{{ asset('public/js/video.js') }}"></script>
    <link class="css" rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/watch.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body style="overflow: hidden;">
    <div class="video-content">
        <video id="video" style="width: 100%" src="{{asset($currentEpisode->url)}}"></video>
        <div id="controls" class="px-2 hidden">
            <span id="progress">
                <span id="total">
                    <span id="buffered"><span id="current">​</span></span>
                </span>
            </span>
            <div class="controls-buttons">
                {{-- <span id="playpause" class="paused" >Play</span> --}}
                <span id="playing">
                    <img id="playpause" class="paused" src="{{ asset('public/storage/img/icons/play-50.png') }}" alt="">
                </span>
                <span id="time">
                    <span id="currenttime">00:00</span> / 
                    <span id="duration">00:00</span>
                </span>
                <div class="ridht-control">
                    <span id="volume" >
                        <img id="dynamic" src="{{ asset('public/storage/img/icons/sound-50.png')}}" alt="">
                    </span>
                    <span id="screen-mode">
                        <img id="screen" src="{{ asset('public/storage/img/icons/full-screen-50.png')}}" alt="">
                    </span>
                </div>
            </div>
        </div>
    </div>
</body >
</html>

