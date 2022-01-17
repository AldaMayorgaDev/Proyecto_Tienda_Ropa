$(document).ready(function(){
    tablaProducto = $("#tablaProducto").DataTable({
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
    codigo = fila.find('td:eq(1)').text();
    nombreP= fila.find('td:eq(2)').text();
    talla= (fila.find('td:eq(3)').text());
    tipo= (fila.find('td:eq(4)').text());
    precio = parseInt(fila.find('td:eq(5)').text());
    
    $("#codigoProducto").val(codigo);
    $("#nombreProducto").val(nombreP);
    $("#talla").val(talla);
    $("#tipo").val(tipo);
    $("#precio").val(precio);
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
            url: "CRUDproducto.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaProducto.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formProducto").submit(function(e){
    e.preventDefault(); 
    codigo = $.trim($("#codigoProducto").val());   
    nombreP = $.trim($("#nombreProducto").val());
    talla= $.trim($("#talla").val());
    tipo = $.trim($("#tipo").val()); 
    precio = $.trim($("#precio").val());    
    $.ajax({
        url: "CRUDproducto.php",
        type: "POST",
        dataType: "json",
        data: {codigo:codigo, nombreP:nombreP, talla:talla, tipo:tipo, precio:precio, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;
            codigoProducto = data[0].codigo;            
            nombreProducto = data[0].nombreP;
            talla= data[0].talla;
            tipo= data[0].tipo;
            precio = data[0].precio;

            if(opcion == 1){tablaProducto.row.add([id,codigo,nombreP,talla,tipo,precio]).draw();}
            else{tablaProducto.row(fila).data([id,codigo,nombreP,talla,tipo, precio]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});