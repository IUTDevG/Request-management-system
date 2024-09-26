@use('App\Enums\RoleType')
    <!DOCTYPE html>
<html lang="{{str_replace('_','-',app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - IUT de Douala</title>
    {{--    <script src="https://cdn.tailwindcss.com"></script>--}}
    @vite('resources/css/app.css')
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <!-- Production version -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
    </style>
    {{--<script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'iut-green': '#008751',
                        'iut-yellow': '#fcd116',
                        'iut-red': '#e8001e',
                    }
                }
            }
        }
    </script>--}}
</head>
<body class="antialiased bg-gray-100 min-h-screen flex items-center justify-center p-4">
<div class="relative z-10 max-w-4xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-iut-green via-iut-yellow to-iut-red"></div>
    <div class="flex flex-col md:flex-row">
        <div
            class="w-full md:w-1/2 bg-gradient-to-br from-iut-green to-green-700 p-8 flex flex-col justify-center items-center text-white relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="w-full h-full bg-repeat"
                     style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCI+CjxyZWN0IHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgZmlsbD0iI2ZmZiI+PC9yZWN0Pgo8cGF0aCBkPSJNMzYgMzRoLTJsMi0yaC0ydi0yaDJ2LTJoMnYyaDJ2Mmgt    MnoiIGZpbGwtb3BhY2l0eT0iMC4zIiBmaWxsPSIjZmZmIj48L3BhdGg+Cjwvc3ZnPg==');"></div>
            </div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-32 h-32 rounded-full bg-white p-1 mb-6 shadow-lg">
                    <div
                        class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center animate-pulse-slow">
                        <i data-lucide="book-open" class="w-16 h-16 text-iut-green"></i>
                    </div>
                </div>
                <h1 class="text-3xl font-bold mb-2 text-center">IUT de Douala</h1>
                <p class="text-lg mb-6 text-center">Institut Universitaire de Technologie</p>
                <div class="flex space-x-4">
                    <a href="{{ route('home') }}" wire:navigate.hover
                       class="bg-white text-iut-green px-6 py-3 rounded-full font-semibold hover:bg-iut-yellow hover:text-gray-800 transition duration-300 shadow-md">
                        <i data-lucide="home" class="inline-block mr-2 w-5 h-5"></i>Accueil
                    </a>
                    <a href="#" onclick="history.back(); return false;"
                       class="bg-iut-yellow text-gray-800 px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-iut-green transition duration-300 shadow-md">
                        <i data-lucide="arrow-left" class="inline-block mr-2 w-5 h-5"></i>Retour
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center items-center text-center">
            <h2 class="text-7xl font-bold text-gray-800 mb-4 animate-float">@yield('code')</h2>
            <p class="text-xl text-gray-600 mb-8">@yield('message')</p>
            <p class="text-gray-500 italic">{!! __('"L\'éducation est l\'arme la plus puissante pour changer le monde." - Nelson
                Mandela') !!}</p>
            {{--            @dd(RoleType::COMPUTER_CELL)--}}
            {{--            @dd(auth()->user()->getRole())--}}
            @if(View::getSection('code') === "403")
                @php
                    $route= (string)'';
                        $user = auth()->user()->getRole();
                       if($user === RoleType::STUDENT->value){
                        $route= route('student.home');
                       }elseif ($user=== RoleType::COMPUTER_CELL->value){
                           $route= url('admin');
                       }else{
                           $route= url('dashboard');
                       }
                @endphp
                <a href="{{$route}}"  wire:navigate.hover
                   class="mt-5 cursor-pointer bg-iut-yellow text-gray-800 px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-iut-green transition duration-300 shadow-md">Ma
                    session</a>

            @endif
        </div>
    </div>
</div>

<div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
    <div
        class="absolute top-1/4 left-1/4 w-64 h-64 bg-iut-yellow rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"></div>
    <div
        class="absolute top-3/4 right-1/4 w-64 h-64 bg-iut-green rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"
        style="animation-delay: 2s;"></div>
    <div
        class="absolute bottom-1/4 left-1/2 w-64 h-64 bg-iut-red rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"
        style="animation-delay: 4s;"></div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
