@extends('admin.master')
@section('title', 'Categorias')

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
                                <i class="fas fa-plus"></i>
                                Agregar categoria
                            </h2>
                        </div>
                    <div class="inside">

                        {!! Form::open(['url' => '/admin/category/add']) !!}

                            <div class="row" style="padding: 16px;">

                                <div class="col-md-12 ">
                                    {!! Form::label('name','Nombre:') !!}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-keyboard"></i>
                                            </span>
                                        </div>
                                        {!! Form::text('name', null, [ 'class' => 'form-control']) !!}
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
                                        {!! Form::select('module',  getModulesArray(), 0, ['class' => 'custom-select']) !!}
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
                                        {!! Form::text('file', null, [ 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                            </div>

                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title">
                            <i class="far fa-folder-open"></i>
                            Categoria
                        </h2>
                    </div>
                    <div class="inside">
                        <nav class="nav mt16">
                            @foreach (getModulesArray() as $m => $k)
                                <a href="{{ url('/admin/categories/'.$m) }}" class="nav-link">
                                    <i class="fas fa-list"></i>
                                    {{ $k }}</a>
                            @endforeach
                        </nav>
                        <div class="row mt16" style="padding: 16px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td width="32"></td>
                                        <td>Nombre</td>
                                        <td width="140"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cats as $cat)
                                        <tr>
                                            <td>{!! htmlspecialchars_decode($cat->file) !!}</td>
                                            <td>{{ $cat->name }}</td>
                                            <td>
                                                <div class="opts">
                                                    @if (kvfj(Auth::user()->permissions, 'category_edit'))
                                                        <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @if (kvfj(Auth::user()->permissions, 'category_delete'))
                                                        <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@stop


