
function gestionarErrores(input, errores) {
    let noEnviarFormulario = false;
    input = $(input);
    if (typeof errores !== typeof undefined) {
        input.removeClass("is-invalid");
        input.addClass("is-invalid");
        input.nextAll(".invalid-feedback").remove();
        for (let error of errores) {
            input.after(`<div class="invalid-feedback">
                <strong> ${error} </strong>
            </div>`);
        }
        noEnviarFormulario = true;
    } else {
        input.removeClass("is-invalid");
        input.addClass("is-valid");
        input.nextAll(".invalid-feedback").remove();
    }
    return noEnviarFormulario;
}

function validateTarget(target) {
    let formData = new FormData();
    formData.append(target.id, target.value);
    $(target).prev().addClass("spinner");
    axios.post('/registro', formData).then(function (response) {
        $(target).prev().removeClass("spinner");
        gestionarErrores(target, response.data.place);
        gestionarErrores(target, response.data.fecha);
        gestionarErrores(target, response.data.cost);
        gestionarErrores(target, response.data.unidad);
    }).catch(function (error) {
        console.log(error);
    });
}

$(function () {
    $("#name, #email, #username, #lastname").on('change', function (e) {
        validateTarget(e.target);
    });

    $("#registro").click(function (e) {
        e.preventDefault();
        let enviarFormulario = true;
        let formData = new FormData;
        formData.append('name', $("#name").val());
        formData.append('lastname', $("#lastname").val());
        formData.append('username', $("#username").val());
        formData.append('email', $("#email").val());

        axios.post('/registro', formData).then(function (response) {
            if (gestionarErrores("#name", response.data.name)) {
                enviarFormulario = false;
            }

            if (gestionarErrores("#lastname", response.data.lastname)) {
                enviarFormulario = false;
            }

            if (gestionarErrores("#username", response.data.username)) {
                enviarFormulario = false;
            }

            if (enviarFormulario === true) {
                $("#formularioRegistro").submit();
            }
        });
    });
});