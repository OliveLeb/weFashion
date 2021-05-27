<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WeFashion</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-12">
            @include('partials.menu')
        </div>
        <main class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </main>
        @include('partials.footer')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
