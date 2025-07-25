<!DOCTYPE html>
<html lang="{{ 'app.locale' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <div id="app"></div>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>


</head>
<body>
    <div class="content">
    @yield('content')
    </div>

    
</body>
</html>