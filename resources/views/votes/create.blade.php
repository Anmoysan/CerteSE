@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Añadir Voto</div>

                    <div class="card-body">
                        <form action="{{ url('/') }}/events/{{ $event['id'] }}/votes/create" method="post" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('vote') ? ' has-error' : '' }}">
                                <label for="vote" class="col-md-4 control-label">Vota</label>
                                <input id="vote" type="number" class="form-control" name="vote"
                                       value="{{ old('vote') }}">
                                @if($errors->has('vote'))
                                    @foreach($errors->get('vote') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Añadir Voto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection