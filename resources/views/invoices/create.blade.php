@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Añadir Factura</div>

                    <div class="card-body">
                        <form action="{{ url('/') }}/events/{{ $event['id'] }}/reserves/{{ $posicion }}/create" method="post" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('buyer') ? ' has-error' : '' }}">
                                <label for="buyer" class="col-md-4 control-label">Comprador</label>
                                <input id="buyer" type="text" class="form-control" name="buyer"
                                       value="{{ old('buyer') }}">
                                @if($errors->has('buyer'))
                                    @foreach($errors->get('buyer') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Añadir Factura
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection