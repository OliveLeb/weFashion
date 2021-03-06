<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>We Fashion</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="icon" href="{{asset('images/logo/shirt.ico')}}" type="image/x-icon">
</head>
<body>
        <header class="container">
            @include('partials.menu')
        </header>
        <main class="container-fluid py-5">
            <div class="col-md-12">
                @yield('content')
            </div>
        </main>

        @includeWhen($showFooter,'partials.footer')

    @section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    @show
</body>
</html>
