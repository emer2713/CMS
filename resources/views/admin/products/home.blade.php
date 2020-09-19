@extends('admin.master')
@section('title', 'Productos')

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}">
            <i class="fas fa-boxes"></i>
            Productos
        </a>
    </li>

@endsection

@section('content')

    <div class="container-fluid">

        <div class="panel shadow">

            <div class="header">
                <h2 class="title">
                    <i class="fas fa-boxes"></i>
                    Productos
                </h2>
            </div>

            <div class="inside">
                @if (kvfj(Auth::user()->permissions, 'products_add'))
                    <div class="btn">
                        <a href="{{ url('/admin/product/add') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Agregar producto
                        </a>
                    </div>
                @endif
                <br>
                <table class="table table-striped mt16">
                    <thead>
                        <tr>
                            <td style="text-align: center;">Imagen</td>
                            <td style="text-align: center;">Nombre</td>
                            <td style="text-align: center;">Categoria</td>
                            <td style="text-align: center;">Precio</td>
                            <td style="text-align: center;">Estado de descuento</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr @if ($product->status == "0")
                                class="table-danger"

                            @endif
                            @if ($product->status == "1")
                                class="table-success"

                            @endif>
                                <td style="text-align: center;"  width="65">
                                    <a href="{{ url('/multimedia/'.$product->file_path.'/'.$product->file) }}" data-fancybox="gallery">
                                        <img src="{{ url('/multimedia/'.$product->file_path.'/t_'.$product->file) }}" width="65">
                                    </a>
                                </td>
                                <td style="text-align: center;">{{ $product->name }}</td>
                                <td style="text-align: center;">{{ $product->cat->name }}</td>
                                <td style="text-align: center;">{{ $product->price }}</td>
                                <td style="text-align: center;">{{ $product->indiscount }}</td>
                                <td style="text-align: center;">
                                    <div class="opts">
                                        @if (kvfj(Auth::user()->permissions, 'products_edit'))
                                            <a href="{{ url('/admin/product/'.$product->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                        @if (kvfj(Auth::user()->permissions, 'products_delete'))
                                            <a href="{{ url('/admin/product/'.$product->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">{!! $products->render() !!}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
