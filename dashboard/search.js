$(document).ready(function(){
    $("#busqueda").on("keyup", function() {
        var valor = $(this).val().toLowerCase();
        $("#tablaPersonasR tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1)
        });
    });
});
