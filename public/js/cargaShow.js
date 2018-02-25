$(function () {
    votes();
    modal();
});

function modal() {
    $("#reserva").iziModal({
        width: 750,
        zindex: 999,
        onOpened: function () {
            console.log("me he abierto")
        },
        onClosed: function () {
            console.log("me he cerrado")
        },
    });


    $("#abrirReserva").on('click', function () {
        event.preventDefault();
        $("#reserva").iziModal('open');
        $("#mapLugar").hide(1000, function () {
        });
    });

    /*$("#abrirReserva").on('hidden.bs.modal', function () {
        alert("Esta accion se ejecuta al cerrar el modal")
    });*/

    $("#units").on({
        keyup: function () {
            $("#cost").val(($("#units").val() * $("#costEvent").val()).toFixed(2));
        }
    });


    $("#createReserve").on({
        click: function () {
            reservar($("#event_id").val());
        }
    });
}

function votes() {
    $("#estrella1").on({
        mouseenter: function () {
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function () {
            $(this).css("background-color", "#dddddd");
        },

        click: function () {
            event.preventDefault();
            $("#vote").val(1);
            votar(1, $("#event_id").val());
        },
    });

    $("#estrella2").on({
        mouseenter: function () {
            $("#estrella1").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function () {
            $("#estrella1").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function () {
            event.preventDefault();
            $("#vote").val(2);
            votar(2, $("#event_id").val());
        },
    });

    $("#estrella3").on({
        mouseenter: function () {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function () {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function () {
            event.preventDefault();
            $("#vote").val(3);
            votar(3, $("#event_id").val());
        },
    });

    $("#estrella4").on({
        mouseenter: function () {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $("#estrella3").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function () {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $("#estrella3").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function () {
            event.preventDefault();
            $("#vote").val(4);
            votar(4, $("#event_id").val());
        },
    });

    $("#estrella5").on({
        mouseenter: function () {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $("#estrella3").css("background-color", "#cebb0a");
            $("#estrella4").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function () {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $("#estrella3").css("background-color", "#dddddd");
            $("#estrella4").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function () {
            event.preventDefault();
            $("#vote").val(5);
            votar(5, $("#event_id").val());
        }
    });
}

function votar(valor, evento) {

    $(event.target).addClass("active");
    axios.post('/votar',{ event_id: evento, vote: valor
    }).then(function (response) {
        $("#contenedor").html(response.data);
        votes();
        modal();
    }).catch(function (error) {
        console.log(error);
    });
}

function reservar(evento) {

    $(event.target).addClass("active");
    axios.post('/votar', {
        event_id: evento
    }).then(function (response) {
        $("#contenedor").html(response.data);
        votes();
        modal();
    }).catch(function (error) {
        console.log(error);
    });
}



function gestionarErrores(input, errores) {
    let noSendForm = false;
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
        noSendForm = true;
    } else {
        input.removeClass("is-invalid");
        input.addClass("is-valid");
        input.nextAll(".invalid-feedback").remove();
    }
    return noSendForm;
}

function validateTarget(target) {
    let formData = new FormData();
    formData.append(target.id, target.value);
    $(target).parent().next(".spinner").addClass("sk-circle");
    axios.post('/register/validate',
        formData
    ).then(function (response) {
        $(target).parent().next(".spinner").removeClass("sk-circle");
        switch (target.id) {
            case "name":
                gestionarErrores(target, response.data.name);
                break;
            case "lastName":
                gestionarErrores(target, response.data.lastName);
                break;
            case "username":
                gestionarErrores(target, response.data.username);
                break;
            case "email":
                gestionarErrores(target, response.data.email);
                break;
        }
    }).catch(function (error) {
        console.log(error);
    });
}

$(function () {
    $("#name,#lastName,#username,#email").on('change', function (e) {
        validateTarget(e.target)
    });

    $("#registerButton").click(function (e) {
        e.preventDefault();
        let sendForm = true;
        let formData = new FormData;
        formData.append('name', $("#name").val());
        formData.append('lastName', $("#lastName").val());
        formData.append('username', $("#username").val());
        formData.append('email', $("#email").val());

        axios.post('/register/validate', formData)
            .then(function (response) {
                if (gestionarErrores("#name", response.data.name)) {
                    sendForm = false;
                }
                if (gestionarErrores("#lastName", response.data.lastName)) {
                    sendForm = false;
                }
                if (gestionarErrores("#username", response.data.username)) {
                    sendForm = false;
                }
                if (gestionarErrores("#email", response.data.email)) {
                    sendForm = false;
                }

                if (sendForm === true){
                    $("#registerForm").submit();
                }
            });
    });
});