<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Other head elements -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Other head elements -->
</head>
<body>
    <!-- Content -->
    @yield('content')
    <!-- Other scripts -->
</body>
</html>
