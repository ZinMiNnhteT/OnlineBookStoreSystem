<!DOCTYPE html>
<html>
<head>
    @include('home.css')
</head>
@yield('styles')
<body>
    <div class="hero_area">
        @include('home.header')
        @include('home.slider')
    </div>

    @yield('content')

    @include('home.contact')

    @include('home.footer')
</body>

</html>
