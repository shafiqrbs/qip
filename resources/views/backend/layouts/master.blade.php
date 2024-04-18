<!doctype html>
<html lang="{{session()->get('locale')}}">
<head>

    <!-- meta item -->
    @include('backend.layouts.head')
    <!-- Favicons -->
    @include('backend.layouts.headimage')
    <!-- Bootstrap core CSS -->
    @include('backend.layouts.css')
    @stack('CustomStyle')
</head>
<body id="{{session()->get('locale')}}" class="app is-collapsed">



<div class="sidebar">
    <div class="sidebar-inner">
        <!-- logo part -->
       @include('backend.layouts.logo')
        <!-- menu part -->
        @include('backend.layouts.nav')
    </div>
</div>

<div class="container-wide">
    <!-- top nav part -->
    @include('backend.layouts.topnav')

    <!-- body part -->
    @yield('body')

    <!-- footer part -->
    @include('backend.layouts.footer')
    <!-- js part -->
    @include('backend.layouts.js')
    @stack('PerPageCustomJs')

</div>
</body>
</html>
