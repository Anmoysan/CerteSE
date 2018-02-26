function giveDatesEvent(){
    event.preventDefault();

    let enlace = $(event.target);
    let valor = parseInt(enlace.text());

    $(event.target).addClass("active");
    axios.get('/giveEvents?page='+valor)
        .then(function(response){
            $("#listado").html(response.data);
            asociarEventoAsincrono();
        }).catch(function (error) {
        console.log(error);
    });
    window.scrollTo($("#logo").left,$("#logo").top);
}

function asociarEventoAsincrono(){
    $(".pagination > li > a").on("click",giveDatesEvent);
}

$(function(){
    asociarEventoAsincrono();
});