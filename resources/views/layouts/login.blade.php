<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  @stack('prepend-style')
  @include('includes.home.style')
  @stack('after-style')
</head>
<body class="hold-transition login-page">
    @yield('content')

    {{-- script --}}
    @stack('prepend-script')
    @include('includes.home.script')
    @stack('addon-script')
</body>
</html>
