@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Configuracion</li>
@endsection

@section('content')
    <div class="container">
        <div class="col-lg-12 text-center row">
            <table class="mt-4 table table-striped table-bordered">
                <tbody class="bg-dark">
                <tr>
                    <th scope="col" @if(Request::is('profile/configuration/account')) class="bg-color5" @endif>
                        <a href="{{route('profile.account')}}">Modificar perfil</a>
                    </th>
                    <th scope="col" @if(Request::is('profile/configuration/password')) class="bg-color5" @endif>
                        <a href="{{route('profile.password')}}">Modificar contraseña</a>
                    </th>
                    <th scope="col" @if(Request::is('profile/configuration/avatar')) class="bg-color5" @endif>
                        <a href="{{route('profile.avatar')}}">Modificar avatar</a>
                    </th>
                    <th scope="col" @if(Request::is('profile/configuration/delete')) class="bg-color5" @endif>
                        <a href="{{route('profile.delete')}}">Borrar usuario</a>
                    </th>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-12 form-group row center">
            @if( session('exito') )
                <div class="alert alert-success text-center" role="alert">
                    <h5>Actualización correcta</h5>
                </div>
            @elseif( session('error'))
                <div class="alert alert-danger text-center" role="alert">
                    <h5>{{ session('error') }}</h5>
                </div>
            @endif
            <div class="col-12">
                <form action="{{ Request::url() }}" method="POST" enctype="multipart/form-data" class="ml-4">
                    {{ csrf_field() }}
                    <div class="card">

                    @if(Request::is('profile/configuration/account'))
                        @include('users.conf.account')

                    @elseif(Request::is('profile/configuration/password'))
                        @include('users.conf.password')

                    @elseif(Request::is('profile/configuration/avatar'))
                        @include('users.conf.avatar')

                    @elseif(Request::is('profile/configuration/delete'))
                        @include('users.conf.delete')

                    @endif
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection