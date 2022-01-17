$(document).ready(function(){
    tablaProveedor = $("#tablaProveedor").DataTable({
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
    $("#formProveedor").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Proveedor");            
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
    correo= fila.find('td:eq(2)').text();
    nombreEmp= (fila.find('td:eq(3)').text());
    direccion= (fila.find('td:eq(4)').text());
    
    $("#nombreProveedor").val(nombre);
    $("#correoProveedor").val(correo);
    $("#nombreEmpresa").val(nombreEmp);
    $("#direccionEmpresa").val(direccion);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Poveedor");            
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
            url: "CRUDproveedor.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaProveedor.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formProveedor").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombreProveedor").val());
    correo= $.trim($("#correoProveedor").val());
    nombreEmp = $.trim($("#nombreEmpresa").val()); 
    direccion = $.trim($("#direccionEmpresa").val());    
    $.ajax({
        url: "CRUDproveedor.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, correo:correo, nombreEmp:nombreEmp, direccion:direccion, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombreProveedor = data[0].nombre;
            correoProveedor= data[0].correo;
            nombreEmpresa= data[0].nombreEmp;
            direccionEmpresa = data[0].direccion;

            if(opcion == 1){tablaProveedor.row.add([id,nombre,correo,nombreEmp,direccion]).draw();}
            else{tablaProveedor.row(fila).data([id,nombre,correo,nombreEmp, direccion]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});