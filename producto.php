<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, codigoProducto, nombreProducto, talla, tipo, precio FROM producto";
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
    <title>Productos</title>
      
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
         <h4 class="text-center text-light">CRUD <span class="badge badge-danger">Productos</span></h4> 
     </header>    
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo Producto</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaProducto" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Codigo de Producto</th>
                                <th>Nombre Producto</th>
                                <th>Talla</th>                                
                                <th>Tipo</th> 
                                <th>Precio</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['codigoProducto'] ?></td>
                                <td><?php echo $dat['nombreProducto'] ?></td>
                                <td><?php echo $dat['talla'] ?></td>
                                <td><?php echo $dat['tipo'] ?></td> 
                                <td><?php echo $dat['precio'] ?></td>    
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
        <form id="formProducto">    
            <div class="modal-body">
                <div class="form-group">
                <label for="codigoProducto" class="col-form-label">Código del Producto:</label>
                <input type="text" class="form-control" id="codigoProducto">
                </div>
                <div class="form-group">
                <label for="nombreProducto" class="col-form-label">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombreProducto">
                </div>                
                <div class="form-group">
                <label for="talla" class="col-form-label">Talla del Producto:</label>
                <input type="text" class="form-control" id="talla">
                </div>    
                <div class="form-group">
                <label for="tipo" class="col-form-label">Tipo de Producto:</label>
                <input type="text" class="form-control" id="tipo">
                </div>   
                <div class="form-group">
                <label for="precio" class="col-form-label">Precio de Producto:</label>
                <input type="number" class="form-control" id="precio">
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
     
    <script type="text/javascript" src="js\producto.js"></script>  
    
    
  </body>
</html>
