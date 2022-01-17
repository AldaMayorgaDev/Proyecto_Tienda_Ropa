<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombreProveedor, correoProveedor, nombreEmpresa, direccionEmpresa FROM proveedor";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>Proveedores</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="css/main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">       
  </head>
    
  <body> 
     <header>
<!--         <h3 class="text-center text-light">Tutorial</h3>-->
         <h4 class="text-center text-light">CRUD con <span class="badge badge-danger">En Proveedores</span></h4> 
     </header>    
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo Proveedor</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaProveedor" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre Proveedor</th>
                                <th>Correo del Proveedor</th>                                
                                <th>Nombre de la Empresa</th> 
                                <th>Direeción Empresa</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombreProveedor'] ?></td>
                                <td><?php echo $dat['correoProveedor'] ?></td>
                                <td><?php echo $dat['nombreEmpresa'] ?></td> 
                                <td><?php echo $dat['direccionEmpresa'] ?></td>    
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formProveedor">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombreProveedor" class="col-form-label">Nombre del Proveedor:</label>
                <input type="text" class="form-control" id="nombreProveedor">
                </div>
                <div class="form-group">
                <label for="correoProveedor" class="col-form-label">Correo del Proveedor:</label>
                <input type="text" class="form-control" id="correoProveedor">
                </div>                
                <div class="form-group">
                <label for="nombreEmpresa" class="col-form-label">Nombre de la Empresa:</label>
                <input type="text" class="form-control" id="nombreEmpresa">
                </div>    
                <div class="form-group">
                <label for="direccionEmpresa" class="col-form-label">Dirección de la Empresa:</label>
                <input type="text" class="form-control" id="direccionEmpresa">
                </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="js\proveedor.js"></script>  
    
    
  </body>
</html>
