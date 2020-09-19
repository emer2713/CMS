@extends('admin.master')
@section('title', 'Editar producto')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}">
            <i class="fas fa-boxes"></i>
            Productos
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/edit ') }}">
            <i class="far fa-folder-open"></i>
            Editar producto
        </a>
    </li>

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-9">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title">
                            <i class="far fa-edit"></i>
                            Editar producto
                        </h2>
                    </div>

                    <div class="inside">

                        {!! Form::open(['url' => '/admin/product/'.$product->id.'/edit', 'files' => true]) !!}

                            <div class="row" style="padding: 16px;">

                                <div class="col-md-5">
                                    {!! Form::label('name','Nombre:') !!}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-keyboard"></i>
                                            </span>
                                        </div>
                                        {!! Form::text('name', $product->name, [ 'class' => 'form-control']) !!}
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
                                        {!! Form::select('category',  $cats, $product->category_id, ['class' => 'custom-select']) !!}
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
                                        {!! Form::number('price', $product->price, [ 'class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
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
                                        {!! Form::select('indiscount', [ '0' => 'No', '1' => 'Si'], $product->in_discount, ['class' => 'custom-select']) !!}
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
                                        {!! Form::number('discount', $product->discount, [ 'class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
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
                                        {!! Form::select('status', [ '0' => 'Borrador', '1' => 'Publicado'], $product->status, ['class' => 'custom-select']) !!}
                                    </div>
                                </div>

                            </div>

                            <div class="row mt16" style="padding: 16px;">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        {{ Form::label('content','Descripcion:') }}
                                        <div class="input-group-prepend">
                                            {!! Form::textarea('content', $product->content, ['class' => 'form-control ', 'id' => 'editor']) !!}
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title">
                            <i class="far fa-image "></i>
                            Imagen destacada
                        </h2>
                    </div>
                    <div class="inside">
                        <img src="{{ url('/multimedia/'.$product->file_path.'/t_'.$product->file) }}" class="img-fluid">
                    </div>

                </div>

                <div class="panel shadow mt16">

                    <div class="header">
                        <h2 class="title">
                            <i class="far fa-images"></i>
                            Galeria
                        </h2>
                    </div>

                    <div class="inside product_gallery">


                            {!! Form::open(['url' => '/admin/product/'.$product->id.'/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}

                                {!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display:none;', 'required']) !!}

                            {!! Form::close() !!}

                            <div class="btn-submit">
                                <a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
                            </div>

                        <div class="tumbs">
                            @foreach ($product->getGallery as $ima)
                                <div class="tumb">

                                    @if (kvfj(Auth::user()->permissions, 'product_gallery_delete'))

                                        <a href="{{ url('/admin/product/'.$product->id.'/gallery/'.$ima->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>

                                    @endif

                                    <img src="{{ url('/multimedia/'.$ima->file_path.'/t_'.$ima->file_name) }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>


            </div>

        </div>



    </div>

@stop

@section('scripts')

    <script src="{{ asset('/libs/ckeditor/ckeditor.js') }}"></script>

@endsection
