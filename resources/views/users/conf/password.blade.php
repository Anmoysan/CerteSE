{{ method_field('PATCH') }}
<div class="card-header">Modificar contraseña</div>

<div class="card-body">
    <div class="col-12">
        <div class="form-group">
            <label class="col-lg-12 col-form-label ng" for="current_password">Contraseña actual</label>

            <div class="col-12 center">
                <input type="password" class="form-control" name="current_password" id="current_password">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-12 col-form-label ng" for="password">Contraseña</label>

            <div class="col-12 center">
                <input type="password" class="form-control" name="password" id="password">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-12 col-form-label ng" for="password_confirmation">Repetir
                contraseña</label>

            <div class="col-12 center">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>
        </div>
    </div>
    <div class="mt-4 text-center">
        <button type="submit" class="btn btn-outline-info">Actualizar contraseña</button>
    </div>
</div>