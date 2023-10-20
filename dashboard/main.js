$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
    
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    barrio = fila.find('td:eq(2)').text();
    cedula = parseFloat(fila.find('td:eq(3)').text());
    celular = parseFloat(fila.find('td:eq(4)').text());
    mesa = parseInt(fila.find('td:eq(5)').text());
    lider = parseInt(fila.find('td:eq(6)').text());
    validado = parseInt(fila.find('td:eq(7)').text());

    $("#nombre").val(nombre);
    $("#barrio").val(barrio);
    $("#cedula").val(cedula);
    $("#celular").val(celular);
    $("#mesa").val(mesa);
    $("#lider").val(lider);
    $("#validado").val(validado);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }
    location.reload(true);   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    barrio = $.trim($("#barrio").val());
    cedula = $.trim($("#cedula").val());
    celular = $.trim($("#celular").val());
    mesa = $.trim($("#mesa").val());
    lider = $.trim($("#lider").val());
    validado = $.trim($("#validado").val());
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, barrio:barrio, cedula:cedula, celular:celular, mesa:mesa, lider:lider, validado:validado,id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            console.log(data[0].rep);
            id = data[0].id;            
            nombre = data[0].nombre;
            barrio = data[0].barrio;
            cedula = data[0].cedula;
            celular = data[0].celular;
            mesa = data[0].mesa;
            lider = data[0].lider;
            validado = data[0].validado;
            alert(data.alerta);
            if(opcion == 1){
                tablaPersonas.row.add([id,nombre,barrio,cedula,celular,mesa,lider,validado]).draw();
               
            }
            else{
                tablaPersonas.row(fila).data([id,nombre,barrio,cedula,celular,mesa,lider,validado]).draw();
                }
        }
                
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});