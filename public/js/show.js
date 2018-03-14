$(function () {
    votes();
    modal();
    coment();
    deletecoment();
    allcomments();
});

function functionsAgain() {
    carga();
    votes();
    modal();
    coment();
    deletecoment();
    allcomments();
    maps($("#latitud").val(), $("#longitud").val(), $("#place").val());
}

function carga() {
    $('#conten').before(`<div class="alert alert-success fade show container" role="alert">Se ha cargado perfectamente lo asincrono
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`);
}

function coment() {
    $("#content").on({
        keypress: function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                comentar($("#content").val(), $("#event_id").val());
            }
        }
    });
}

function deletecoment() {
    $("#eliminarComment").on({
        click: function (e) {
            e.preventDefault();
            eliminarcomentario($("#event_id").val(), $("#commentid").val());
        }
    });
}

function allcomments() {
    $("#allcommentarys").on({
        click: function (e) {
            e.preventDefault();
            todoscomentarios($("#event_id").val());
        }
    });
}

function modal() {
    $("#reserva").iziModal({
        width: 750,
        height: 750,
        zindex: 999,

        onClosed: function () {
            $("#mapLugar").show(100, function () {
            });
        },
    });

    $("#abrirReserva").on({
        click: function () {
            event.preventDefault();
            $("#reserva").iziModal('open');
            $("#mapLugar").hide(100, function () {
            });
        }
    });

    $("#unidad").on({
        keyup: function () {
            $("#cost").val(($("#unidad").val() * $("#costEvent").val()).toFixed(2));
        },

        change: function (e) {
            validateTarget(e.target)
        }
    });


    $("#createReserve").click(function (e) {
        e.preventDefault();
        let enviarFormulario = true;
        let formData = new FormData;
        formData.append('place', $("#place").val());
        formData.append('fecha', $("#fecha").val());
        formData.append('cost', $("#cost").val());
        formData.append('unidad', $("#unidad").val());

        axios.post('/reservar', formData).then(function (response) {
            if (gestionarErrores("#place", response.data.place)) {
                enviarFormulario = false;
            }

            if (gestionarErrores("#fecha", response.data.fecha)) {
                enviarFormulario = false;
            }

            if (gestionarErrores("#cost", response.data.cost)) {
                enviarFormulario = false;
            }

            if (gestionarErrores("#unidad", response.data.unidad)) {
                enviarFormulario = false;
            }

            if (enviarFormulario === true) {
                $("#formReserve").submit();
            }
        });
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
    axios.post('/votar', {
        event_id: evento, vote: valor
    }).then(function (response) {
        $("#contenedor").html(response.data);
        functionsAgain();
    }).catch(function (error) {
        console.log(error);
    });
}

function todoscomentarios(evento) {

    $(event.target).addClass("active");
    axios.post('/allcomments', {
        event_id: evento
    }).then(function (response) {
        $("#contenedor").html(response.data);
        functionsAgain();
    }).catch(function (error) {
        console.log(error);
    });
    window.scrollTo($("#logo").left,$("#logo").top);
}

function eliminarcomentario(evento) {

    $(event.target).addClass("active");
    axios.post('/deletecomment', {
        event_id: evento, comment_id: commentid
    }).then(function (response) {
        $("#contenedor").html(response.data);
        functionsAgain();
    }).catch(function (error) {
        console.log(error);
    });
    window.scrollTo($("#logo").left,$("#logo").top);
}

function comentar(content, evento) {

    $(event.target).addClass("active");
    axios.post('/comentar', {
        event_id: evento, content: content
    }).then(function (response) {
        $("#contenedor").html(response.data);
        functionsAgain();
    }).catch(function (error) {
        console.log(error);
    });
}


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
    axios.post('/reservar', formData).then(function (response) {
        $(target).prev().removeClass("spinner");
        gestionarErrores(target, response.data.place);
        gestionarErrores(target, response.data.fecha);
        gestionarErrores(target, response.data.cost);
        gestionarErrores(target, response.data.unidad);
    }).catch(function (error) {
        console.log(error);
    });
}

function maps(lat, long, name){

    let map = L.map('map').setView([lat, long], 10);
    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18
    }).addTo(map);
    L.marker([lat, long],{draggable: true}).addTo(map).bindPopup(name).openPopup();

}