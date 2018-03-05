$(function () {
    datesUser();
    info();
});

function datesUser() {
    $("#infoUser").on({
        click: function (e) {
            e.preventDefault();
            info();
        }
    });

    $("#eventsUser").on({
        click: function (e) {
            e.preventDefault();
            events();
        }
    });

    $("#invoicesUser").on({
        click: function (e) {
            e.preventDefault();
            invoice();
        }
    });
}


function info() {

    $(event.target).addClass("active");
    axios.get('/profile/info').then(function (response) {
        $("#dateProfile").html(response.data);
        //datesUser();
    }).catch(function (error) {
        console.log(error);
    });
    window.scrollTo($("#logo").left, $("#logo").top);
}

function events() {

    $(event.target).addClass("active");
    axios.get('/profile/events').then(function (response) {
        $("#dateProfile").html(response.data);
        //datesUser();
    }).catch(function (error) {
        console.log(error);
    });
    window.scrollTo($("#logo").left, $("#logo").top);
}

function invoice() {

    $(event.target).addClass("active");
    axios.get('/profile/invoices').then(function (response) {
        $("#dateProfile").html(response.data);
        //datesUser();
    }).catch(function (error) {
        console.log(error);
    });
    window.scrollTo($("#logo").left, $("#logo").top);
}