<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher()" x-init="init()">
<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{str_replace('-',' ',env('APP_NAME'))}}</title>
    <link rel="preload" href="{{asset('videos/video.mp4')}}" as="video">
    <link rel="preload" href="{{asset('css/video-overlay.css')}}" as="style">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('css/video-overlay.css')}}">
    <script src="{{asset('js/darkMode.js')}}"></script>
</head>

<body :class="themeClass" class="overflow-x-hidden bg-background/95">

{{--@dd(auth()->user()->roles())--}}
@session('error')

<x-error> {!! session('error') !!} .</x-error>

@endsession
<!--===Loader===-->
<x-preloader/>
<!--===End loader===-->
<!-- ========== HEADER ========== -->
{{$slot}}
<!-- ========== END FOOTER ========== -->
<div id="video-overlay" class="video-overlay">
    <div class="video-container">
        <span id="close-button" class="close-button">&times;</span>
        <video id="demo-video" class="max-w-full h-auto" controls>
            <source src="{{asset('videos/video.mp4')}}" type="video/mp4">
            Votre navigateur ne prend pas en charge la balise vidéo.
        </video>
    </div>
</div>
<!--===Script section===-->
<script src="{{asset('js/anchor.js')}}"></script>

<script>
    const watchDemoButton = document.getElementById('watch-demo');
    const videoOverlay = document.getElementById('video-overlay');
    const demoVideo = document.getElementById('demo-video');
    const closeButton = document.getElementById('close-button');

    watchDemoButton.addEventListener('click', () => {
        videoOverlay.classList.add('show');
    });

    videoOverlay.addEventListener('click', (event) => {
        if (event.target === videoOverlay || event.target === closeButton) {
            videoOverlay.classList.remove('show');
            demoVideo.pause();
        }
    });
</script>
@stack('scripts')
@livewireScripts
</body>
</html>
