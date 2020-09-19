@extends('autenticacion.master')

@section('title', 'Login')

@section('content')
    <div class="box box_login shadow">

        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ asset('/media/imagenes/logo.png') }}">
            </a>
        </div>

        <div class="inside">

            {!! Form::open(['route' => 'login']) !!}

                <label for="email">Correo electrónico:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                    </div>
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <label for="password" class="mt16">Password:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Ingresar', ['class' => 'btn btn-success mt16']) !!}

            {!! Form::close() !!}

            @if (Session::has('message'))
                <div class="container">
                    <div class="alert alert-{{ Session::get('typealert') }}" style="display: none;">
                        {{ Session::get('message') }}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <script>
                            $('.alert').slideDown();
                            setTimeout(function() {
                                $('.alert').slideUp();
                            }, 3000);
                        </script>
                    </div>
                </div>
            @endif

            <div class="footer mt16">
                <a href="{{ url('/register') }}">¿No tienes una cuenta?, Registrarte.</a>
                <a href="{{ url('/recover') }}">Recuperar contraseña.</a>
            </div>

        </div>

    </div>
@stop
