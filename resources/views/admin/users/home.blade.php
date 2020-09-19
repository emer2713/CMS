@extends('admin.master')
@section('title', 'Usuarios')
@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}">
            <i class="fas fa-user-friends"></i>
            Usuarios
        </a>
    </li>

@endsection
@section('content')

    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title">
                    <i class="fas fa-user-friends"></i>
                    Usuarios
                </h2>
            </div>

            <div class="inside">

                <div class="row mt16">
                    <div class="col-md-2 offset-md-10">
                        <div class="dropdown">
                            <button  style="width:100%" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter"  style="margin-right: 3px;"></i>Filtrar
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="{{ url('/admin/users/all') }}" class="dropdown-item"><i class="fas fa-stream"  style="margin-right: 3px;"></i>Todos</a>
                                <a href="{{ url('/admin/users/0') }}" class="dropdown-item"><i class="fas fa-unlink"  style="margin-right: 3px;"></i>No verificados</a>
                                <a href="{{ url('/admin/users/1') }}" class="dropdown-item"><i class="fas fa-user-check"  style="margin-right: 3px;"></i>verificados</a>
                                <a href="{{ url('/admin/users/100') }}" class="dropdown-item"><i class="fas fa-heart-broken"  style="margin-right: 3px;"></i>Suspendidos</a>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table mt16">
                    <thead>
                        <tr>
                            <td style="text-align: center;">Nombre</td>
                            <td style="text-align: center;">Apellidos</td>
                            <td style="text-align: center;">Email</td>
                            <td style="text-align: center;">Estado</td>
                            <td style="text-align: center;">Role</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td style="text-align: center;">{{ $user->name }}</td>
                                <td style="text-align: center;">{{ $user->lastname }}</td>
                                <td style="text-align: center;">{{ $user->email }}</td>
                                <td style="text-align: center;">{{ getUserStatusArray(null, $user->status) }}</td>
                                <td style="text-align: center;">{{ getRoleUserArray(null, $user->role) }}</td>
                                <td style="text-align: center;">
                                    <div class="opts">
                                            <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ url('/admin/user/'.$user->id.'/permissions') }}" data-toggle="tooltip" data-placement="top" title="Permisos de usuario">
                                                <i class="fas fa-cogs"></i>
                                            </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">{!! $users->render() !!}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
