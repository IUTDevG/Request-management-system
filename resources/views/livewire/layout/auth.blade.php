<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Sign-up page</title>
</head>
<body>
<div class="flex sm:px-0 px-5  overflow-hidden sm:overflow-x-hidden">
    <!-- Left Pane -->
    <div class="hidden lg:flex items-center justify-center flex-1">
        <div class="w-full text-center">
            <img src="{{asset('images/login.jpg')}}" class="w-full h-full object-cover" alt="login image">
        </div>
    </div>
    <!-- Right Pane -->
    {{ $slot }}
</div>
</body>
</html>
