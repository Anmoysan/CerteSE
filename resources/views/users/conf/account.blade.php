{{ method_field('PATCH') }}
<div class="card-header">Modificar datos personales</div>

<div class="card-body">
    <form class="form-horizontal" method="POST" action="">
        {{ csrf_field() }}

        <div class="form-group @if( $errors->has('name'))has-error @endif ">
            <label for="name" class="col-md-4 control-label">Nombre</label>

            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                   autofocus>

            @if($errors->has('name'))
                @foreach($errors->get('name') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="form-group @if( $errors->has('lastname'))has-error @endif ">
            <label for="lastname" class="col-md-4 control-label">Apellidos</label>

            <input id="lastname" type="text" class="form-control" name="lastname"
                   value="{{ old('lastname') }}">

            @if($errors->has('lastname'))
                @foreach($errors->get('lastname') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="form-group @if( $errors->has('username'))has-error @endif">
            <label for="username" class="col-md-4 control-label">Nick</label>

            <input id="username" type="text" class="form-control" name="username"
                   value="{{ old('username') }}">

            @if($errors->has('username'))
                @foreach($errors->get('username') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="form-group @if( $errors->has('mobile'))has-error @endif">
            <label for="mobile" class="col-lg-4 control-label">Movil</label>

            <div class="d-flex justify-content-between">
                <div class="input-group col-xl-2 col-md-3 col-xs-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon">+</span>
                    </div>
                    <input id="mobileCountry" type="text" class="form-control col-md-11 input-group" name="mobileCountry" value="{{ old('mobileCountry') }}" aria-describedby="addon">
                </div>
                <input id="mobileNumber" type="text" class="form-control col-xl-10 col-md-9 col-xs-8" name="mobileNumber" value="{{ old('mobileNumber') }}">
            </div>
            <div>
                @if($errors->has('mobileCountry'))
                    @foreach($errors->get('mobileCountry') as $message)
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @endforeach
                @endif

                @if($errors->has('mobileNumber'))
                    @foreach($errors->get('mobileNumber') as $message)
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group @if( $errors->has('biography'))has-error @endif">
            <label for="biography" class="col-md-4 control-label">Biografia</label>

            <textarea id="biography" type="text" class="form-control" name="biography">{{ old('biography') }}</textarea>

            @if($errors->has('biography'))
                @foreach($errors->get('biography') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="form-group @if( $errors->has('website'))has-error @endif">
            <label for="website" class="col-md-4 control-label">Sitio web</label>

            <input id="website" type="text" class="form-control" name="website"
                   value="{{ old('website') }}">

            @if($errors->has('website'))
                @foreach($errors->get('website') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-info">Actualizar datos</button>
        </div>
    </form>
</div>