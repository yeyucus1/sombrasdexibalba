@extends('layouts.login.base')
@section('content')
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrate</p>

            <form class="form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group mt-3">
                    <input type="text"
                           name="name"
                           value="{{old('name')}}"
                           class="form-control {{$errors->has('name')?'is-invalid':''}}"
                           placeholder="Nombre">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @if($errors->has('name'))
                    <div class="text-danger">
                        {{$errors->first('name')}}
                    </div>
                @endif
                <div class="input-group mt-3">
                    <input type="text"
                           name="lastname"
                           value="{{old('lastname')}}"
                           class="form-control {{$errors->has('lastname')?'is-invalid':''}}"
                           placeholder="Apellido">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @if($errors->has('lastname'))
                    <div class="text-danger">
                        {{$errors->first('lastname')}}
                    </div>
                @endif
                <div class="input-group mt-3">
                    <input type="text"
                           name="pseudonym"
                           value="{{old('pseudonym')}}"
                           class="form-control {{$errors->has('pseudonym')?'is-invalid':''}}"
                           placeholder="Pseudonimo">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @if($errors->has('pseudonym'))
                    <div class="text-danger">
                        {{$errors->first('pseudonym')}}
                    </div>
                @endif
                <div class="input-group mt-3">
                    <input type="email"
                           name="email"
                           value="{{old('email')}}"
                           class="form-control {{$errors->has('email')?'is-invalid':''}}"
                           placeholder="Correo electronico">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @if($errors->has('email'))
                    <div class="text-danger">
                        {{$errors->first('email')}}
                    </div>
                @endif
                <div class="input-group mt-3">
                    <input type="password"
                           name="password"
                           class="form-control {{$errors->has('password')?'is-invalid':''}}"
                           placeholder="Contraseña">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @if($errors->has('password'))
                    <div class="text-danger">
                        {{$errors->first('password')}}
                    </div>
                @endif
                <div class="input-group mt-3">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control {{$errors->has('password_confirmation')?'is-invalid':''}}"
                           placeholder="Confirmación de contraseña">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @if($errors->has('password_confirmation'))
                    <div class="text-danger">
                        {{$errors->first('password_confirmation')}}
                    </div>
                @endif
                <div class="row mt-3">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <p>Al Crear una cuenta en <b>sombras de xibalba</b> aceptas los <a href="{{route('notices.terms')}}">Terminos</a> y <a href="{{route('notices.privacy')}}">Aviso de privacidad</a></p>
                    </div>
                </div>
            </form>

            <a href="{{route('login')}}" class="text-center">
                Iniciar sesión
            </a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
@endsection
