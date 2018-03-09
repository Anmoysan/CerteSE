function giveMyDatesEvent(){
    event.preventDefault();

    let enlace = $(event.target);
    let valor = parseInt(enlace.text());

    $(event.target).addClass("active");
    axios.get('/giveEventsMySubject?page='+valor)
        .then(function(response){
            $("#listado").html(response.data);
            asociarMisEventosAsincrono();
        }).catch(function (error) {
        console.log(error);
    });
    window.scrollTo($("#logo").left,$("#logo").top);
}

function asociarMisEventosAsincrono(){
    $(".pagination > li > a").on("click",giveMyDatesEvent);
}

$(function(){
    asociarMisEventosAsincrono();
});