$(function() {
    $("#estrella1").on({
        mouseenter: function() {
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function() {
            $(this).css("background-color", "#dddddd");
        },

        click: function() {
            event.preventDefault();
            $("#vote").val(1);
            giveDatesEvent();
        },
    });

    $("#estrella2").on({
        mouseenter: function() {
            $("#estrella1").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function() {
            $("#estrella1").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function() {
            event.preventDefault();
            $("#vote").val(2);
        },
    });

    $("#estrella3").on({
        mouseenter: function() {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function() {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function() {
            event.preventDefault();
            $("#vote").val(3);
        },
    });

    $("#estrella4").on({
        mouseenter: function() {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $("#estrella3").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function() {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $("#estrella3").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function() {
            event.preventDefault();
            $("#vote").val(4);
        },
    });

    $("#estrella5").on({
        mouseenter: function() {
            $("#estrella1").css("background-color", "#cebb0a");
            $("#estrella2").css("background-color", "#cebb0a");
            $("#estrella3").css("background-color", "#cebb0a");
            $("#estrella4").css("background-color", "#cebb0a");
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function() {
            $("#estrella1").css("background-color", "#dddddd");
            $("#estrella2").css("background-color", "#dddddd");
            $("#estrella3").css("background-color", "#dddddd");
            $("#estrella4").css("background-color", "#dddddd");
            $(this).css("background-color", "#dddddd");
        },

        click: function() {
            event.preventDefault();
            votar(5);
            $("#vote").val(5);
        },
    });
});


function votar(valor){

    $(event.target).addClass("active");
    axios.get('/votar?valor='+valor)
        .then(function(response){
            $("#miEvento").html(response.data);
        }).catch(function (error) {
        console.log(error);
    });
}