<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xibalba | Log in</title>
    @include('layouts.login.partials.styles')
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="custom-login-logo">
        <a href="{{route('home')}}">
            <img src="{{asset("template_guest/images/logo_xibalba.png")}}" alt="logo">
        </a>
    </div>
    @yield('content')
</div>
<!-- /.login-box -->

@include('layouts.login.partials.scripts')

</body>
</html>
