$(function() {
    //Que cargue la funcion cuando se cargue la pagina
    $("#boton1").click(
        function() {
            $("#ejemplo").hide(1000, function(){});
            $("#ejemplo").fadeIn(1000, function(){});
            $("#ejemplo").fadeOut(1000, function(){});
            $("#boton1").animate({height:'300px', opacity:'0.4'}, "slow", function() {alert("hola1")});
            $("#boton1").animate({width:'300px', opacity:'0.8'}, "slow", function() {alert("hola2")});
            $("#boton1").animate({height:'100px', opacity:'0.4'}, "slow", function() {alert("hola3")});
            $("#boton1").animate({width:'100px', opacity:'0.8'}, "slow", function() {alert("hola4")});
        }
    );

    //$("#boton1").hide(1000, function(){});
});

$(function() {
    $("#estrella1").on({
        mouseenter: function() {
            $(this).css("background-color", "#cebb0a");
        },

        mouseleave: function() {
            $(this).css("background-color", "#dddddd");
        },

        click: function() {
            $("#vote").val(1);
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
            $("#vote").val(5);
        },
    });
});