$(function () {

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
});

function reservar(evento) {

    $(event.target).addClass("active");
    axios.post('/votar', {
        event_id: evento
    }).then(function (response) {
        $("#contenedor").html(response.data);
    }).catch(function (error) {
        console.log(error);
    });
}