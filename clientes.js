$(document).ready(function(){
    tablaCliente = $("#tablaCliente").DataTable({
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
    $("#formCliente").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Cliente");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre= fila.find('td:eq(1)').text();
    app = fila.find('td:eq(2)').text();
    apm = fila.find('td:eq(3)').text();
    telefono = parseInt(fila.find('td:eq(4)').text());
    correo = fila.find('td:eq(5)').text();
    calle = fila.find('td:eq(6)').text();
    colonia = fila.find('td:eq(7)').text();
    num = parseInt(fila.find('td:eq(8)').text());
    municipio = fila.find('td:eq(9)').text();
    
    
    $("#nombre_cliente").val(nombre);
    $("#app_cliente").val(app);
    $("#apm_cliente").val(apm);
    $("#telefono_cliente").val(telefono);
    $("correo_cliente").val(correo);
    $("#calle_cliente").val(calle);
    $("#colonia_cliente").val(colonia);
    $("#num_cliente").val(num);
    $("#municipio_cliente").val(municipio);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Cliente");            
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
            url: "CRUDClientes.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaCliente.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formCliente").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre_cliente").val());
    app = $.trim($("#app_cliente").val());
    apm= $.trim($("#apm_cliente").val());
    telefono = $.trim($("#telefono_cliente").val()); 
    correo = $.trim($("#correo_cliente").val());
    calle = $.trim($("#calle_cliente").val());
    colonia = $.trim($("#colonia_cliente").val());
    num = $.trim($("#num_cliente").val()); 
    municipio = $.trim($("#municipio_cliente").val());  
     $.ajax({
        url: "CRUDClientes.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, app:app, apm:apm, telefono:telefono, correo:correo, calle:calle, colonia:colonia, num:num, municipio:municipio, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id_cliente = data[0].id;            
            nombre_cliente = data[0].nombre;
            app_cliente = data[0].app;
            apm_cliente = data[0].apm;
            telefono_cliente = data[0].telefono;
            correo_cliente = data[0].correo;
            calle_cliente = data[0].calle;
            colonia_cliente = data[0].colonia;
            num_cliente = data[0].num;
            municipio_cliente = data[0].municipio;

            if(opcion == 1){tablaCliente.row.add([id,nombre,app,apm,telefono,correo,calle,colonia,num,municipio]).draw();}
            else{tablaCliente.row(fila).data([id,nombre,app,apm,telefono,correo,calle,colonia,num,municipio]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});