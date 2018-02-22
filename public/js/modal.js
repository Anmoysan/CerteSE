$(function () {

    $("#modalTres").iziModal({

        width: 1050,
        zindex: 999,
        onOpened: function () {
            console.log("me he abierto")
        },
        onClosed: function () {
            console.log("me he cerrado")
        }
    });


    $("#abrirModalTres").on('click', function () {
        $("#modalTres").iziModal('open')
    })

});