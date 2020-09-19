@extends('admin.master')
@section('title', 'Agregar producto')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}">
            <i class="fas fa-boxes"></i>
            Productos
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/add ') }}">
            <i class="fas fa-plus"></i>
            Agregar producto
        </a>
    </li>

@endsection

@section('content')

    <div class="container-fluid">

        <div class="panel shadow">

            <div class="header">
                <h2 class="title">
                    <i class="fas fa-plus"></i>
                    Agregar producto
                </h2>
            </div>

            <div class="inside">

                {!! Form::open(['url' => '/admin/product/add', 'files' => true]) !!}

                    <div class="row" style="padding: 16px;">

                        <div class="col-md-5">
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

                        <div class="col-md-4">
                            {!! Form::label('name','Categoría:') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                </div>
                                {!! Form::select('category',  $cats, 0, ['class' => 'custom-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="name">Imagen destacada:</label>
                            <div class="custom-file">
                                {!! Form::file('file', ['class' => 'custom-file-input', 'id' => 'customFile']) !!}
                                <label class="custom-file-label" for="customFile">Choose File</label>
                            </div>
                        </div>

                    </div>

                    <div class="row mt16" style="padding: 16px;">

                        <div class="col-md-3">
                            {!! Form::label('price','Precio:') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                </div>
                                {!! Form::number('price', null, [ 'class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('indiscount ','¿En descuento?') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-sticky-note"></i>
                                    </span>
                                </div>
                                {!! Form::select('indiscount', [ '0' => 'No', '1' => 'Si'], 0, ['class' => 'custom-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('discount ','Descuento:') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-percent"></i>
                                    </span>
                                </div>
                                {!! Form::number('discount', 0.00, [ 'class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('status ','Estado:') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-sticky-note"></i>
                                    </span>
                                </div>
                                {!! Form::select('status', [ '0' => 'Borrador', '1' => 'Publicado'], 0, ['class' => 'custom-select']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row mt16" style="padding: 16px;">
                        <div class="col-md-12">
                            <div class="form-group">

                                {{ Form::label('content','Descripcion:') }}
                                <div class="input-group-prepend">
                                    {!! Form::textarea('content', null, ['class' => 'form-control ', 'id' => 'editor']) !!}
                                </div>

                            </div>
                        </div>
                    </div>

                    {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}

                {!! Form::close() !!}

            </div>

        </div>
    </div>

@stop

@section('scripts')

    <script src="{{ asset('/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

@endsection
