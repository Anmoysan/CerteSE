$( function() {
    $("#date").datepicker({ minDate: "+1D" });
    $( "#date" ).datepicker( "option", $.datepicker.regional[ "fr" ] );
    //$( "#duration" ).timepicker();
} );