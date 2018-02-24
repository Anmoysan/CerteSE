function votar(valor, evento) {

    $(event.target).addClass("active");
    axios.post('/votar',{ event_id: evento, vote: valor
    }).then(function (response) {
        $("#contenedor").html(response.data);
    }).catch(function (error) {
        console.log(error);
    });

    document.write('<script src="../js/cargaShow.js"></script>');
}