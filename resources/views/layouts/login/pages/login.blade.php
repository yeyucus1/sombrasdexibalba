@extends('layouts.login.base')
@section('content')

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Inicio de Sesión</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mt-3">
                    <input type="email" name="email" class="form-control {{$errors->has('email')?'is-invalid':''}}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @if ($errors->has('email'))
                    <div id="password-error" class="error text-danger " for="email" style="display: block;">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <div class="input-group mt-3">
                    <input type="password" name="password" class="form-control {{$errors->has('password')?'is-invalid':''}}" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @if ($errors->has('password'))
                    <div id="password-error" class="error text-danger " for="email" style="display: block;">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="{{route('password.request')}}">¿Olvidaste tu contraseña?</a>
            </p>
            <p class="mb-0">
                ¿No tienes una cuenta?<a href="{{route('register')}}" class="text-center">Registrate</a>
            </p>
        </div>
    </div>

@endsection
