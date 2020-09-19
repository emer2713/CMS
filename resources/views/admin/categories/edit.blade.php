@extends('admin.master')
@section('title', 'Editar categoria')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories') }}">
            <i class="far fa-folder-open"></i>
            Categorias
        </a>
    </li>

@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title">
                            <i class="fas fa-edit"></i>
                            Editar categoria
                        </h2>
                    </div>

                    <div class="inside">

                        {!! Form::open(['url' => '/admin/category/'.$cat->id.'/edit']) !!}

                            <div class="row" style="padding: 16px;">

                                <div class="col-md-12 ">
                                    {!! Form::label('name','Nombre:') !!}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-keyboard"></i>
                                            </span>
                                        </div>
                                        {!! Form::text('name', $cat->name, [ 'class' => 'form-control']) !!}
                                    </div>
                                </div>


                                <div class="col-md-12 mt16">
                                    {!! Form::label('module','Módulo:') !!}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-layer-group"></i>
                                            </span>
                                        </div>
                                        {!! Form::select('module',  getModulesArray(), $cat->module, ['class' => 'custom-select']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mt16">
                                    {!! Form::label('file','Ícono:') !!}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-image"></i>
                                            </span>
                                        </div>
                                        {!! Form::text('file', $cat->file, [ 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                            </div>

                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>

    </div>

@stop


