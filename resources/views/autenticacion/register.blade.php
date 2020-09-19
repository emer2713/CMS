@extends('autenticacion.master')

@section('title', 'Login')

@section('content')
    <div class="box box_register shadow">

        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ asset('/media/imagenes/logo.png') }}">
            </a>
        </div>

        <div class="inside">

            {!! Form::open(['route' => 'register']) !!}

                <label for="name" class="mt16">Nombre:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <label for="lastname" class="mt16">Apellidos:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                </div>

                <label for="email" class="mt16">Correo electrónico:</label>
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

                <label for="cpassword" class="mt16">Confirmar password:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    {!! Form::password('cpassword', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Registrarse', ['class' => 'btn btn-success mt16']) !!}

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
                <a href="{{ url('/login') }}">Ya tengo una cuenta, ingresar.</a>
            </div>

        </div>

    </div>
@stop
