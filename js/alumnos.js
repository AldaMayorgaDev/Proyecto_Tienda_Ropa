$(document).ready(function(){
    tablaAlumnos = $("#tablaAlumnos").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
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
    $("#formAlumnos").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Alumno");            
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
    apellidos = fila.find('td:eq(2)').text();
    matricula = parseInt(fila.find('td:eq(3)').text());
    telefono = parseInt(fila.find('td:eq(4)').text());
    
    $("#nombre").val(nombre);
    $("#apellidos").val(apellidos);
    $("#matricula").val(matricula);
    $("#telefono").val(telefono);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
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
            url: "CRUDalumnos.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaAlumnos.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formAlumnos").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    apellidos = $.trim($("#apellidos").val());
    matricula = $.trim($("#matricula").val()); 
    telefono = $.trim($("#telefono").val());    
    $.ajax({
        url: "CRUDalumnos.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, apellidos:apellidos, matricula:matricula, telefono:telefono, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            apellidos = data[0].apellidos;
            matricula = data[0].matricula;
            telefono = data[0].telefono;

            if(opcion == 1){tablaAlumnos.row.add([id,nombre,apellidos,matricula,telefono]).draw();}
            else{tablaAlumnos.row(fila).data([id,nombre,apellidos,matricula, telefono]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});