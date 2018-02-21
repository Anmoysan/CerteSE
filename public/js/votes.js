$(function () {
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
            $("#vote").val(5)
            votar(5, $("#event_id").val());
        },
    });
});


function votar(valor, evento) {

    $(event.target).addClass("active");
    axios.post('/votar',{ event_id: evento, vote: valor
    }).then(function (response) {
        $("#contenedor").html(response.data);
    }).catch(function (error) {
        console.log(error);
    });
}