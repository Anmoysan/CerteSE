$(function () {
    $("#date").datepicker({minDate: "+1D"});
    $("#date").datepicker("option", $.datepicker.regional["fr"]);
    //$( "#duration" ).timepicker();

    $("#date").mask("99/99/9999");
    $("#cost").mask("99");
    $("#agemin").mask("99");
});