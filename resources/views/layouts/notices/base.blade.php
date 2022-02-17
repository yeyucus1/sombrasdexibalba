<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xibalba | Log in</title>
    @include('layouts.login.partials.styles')
</head>
<body class="hold-transition">
<div class="justify-content-center">
    <div class="custom-login-logo">
        <a href="{{route('home')}}">
            <img src="{{asset("template_guest/images/logo_xibalba.png")}}" alt="logo">
        </a>
    </div>
    <div class="card card-widget notices-card">
        <div class="card-header">
            <div class="user-block">
                @yield('title')
            </div>
            <!-- /.user-block -->
            <div class="card-tools">
                <button type="button" class="btn btn-tool" onclick="history.back()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- post text -->
            @yield('content')

        </div>
    </div>
</div>

@include('layouts.login.partials.scripts')

</body>
</html>
