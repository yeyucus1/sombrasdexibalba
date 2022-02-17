@extends('layouts.login.base')
@section('content')

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">¿Olvidaste tu contraseña? recupera tu cuenta con tu correo electronico</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group">
                    <input name="email" class="form-control {{$errors->any()&& $errors->has('email')?'is-inalid':''}}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @if($errors->any()&& $errors->has('email'))
                    <div class="text-danger">
                        {{$errors->first('email')}}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary btn-block">Solicitar nueva contraseña</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{route('login')}}">Iniciar sesión</a>
            </p>
            <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Registrate</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
