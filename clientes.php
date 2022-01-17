<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id_cliente, nombre_cliente, app_cliente, apm_cliente, telefono_cliente, correo_cliente, calle_cliente, colonia_cliente, num_cliente, municipio_cliente FROM clientes";
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
    <title>Clientes</title>
      
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
         <h4 class="text-center text-light">CRUD <span class="badge badge-danger">Clientes</span></h4> 
     </header>    
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo Cliente</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaCliente" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>                                
                                <th>Apellido Materno</th>
                                <th>Telefono</th>
                                <th>e-Mail</th>                                
                                <th>Calle</th>   
                                <th>Colonia</th> 
                                <th>Número</th>                                
                                <th>Municipio</th>   
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id_cliente'] ?></td>
                                <td><?php echo $dat['nombre_cliente'] ?></td>
                                <td><?php echo $dat['app_cliente'] ?></td>
                                <td><?php echo $dat['apm_cliente'] ?></td> 
                                <td><?php echo $dat['telefono_cliente'] ?></td>
                                <td><?php echo $dat['correo_cliente'] ?></td>
                                <td><?php echo $dat['calle_cliente'] ?></td>
                                <td><?php echo $dat['colonia_cliente'] ?></td>
                                <td><?php echo $dat['num_cliente'] ?></td>
                                <td><?php echo $dat['municipio_cliente'] ?></td>     
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
        <form id="formCliente">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre_cliente" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre_cliente">
                </div>
                <div class="form-group">
                <label for="app_cliente" class="col-form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="app_cliente">
                </div>
                <div class="form-group">
                <label for="apm_cliente" class="col-form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="apm_cliente">
                </div>
                <div class="form-group">
                <label for="telefono_cliente" class="col-form-label">Telefono:</label>
                <input type="number" class="form-control" id="telefono_cliente">
                </div>
                <div class="form-group">
                <label for="correo_cliente" class="col-form-label">Correo Electronico:</label>
                <input type="text" class="form-control" id="correo_cliente">
                </div>
                <div class="form-group">
                <label for="calle_cliente" class="col-form-label">Nombre de la Calle:</label>
                <input type="text" class="form-control" id="calle_cliente">
                </div>
                <div class="form-group">
                <label for="colonia_cliente" class="col-form-label">Colonia:</label>
                <input type="text" class="form-control" id="colonia_cliente">
                </div>
                <div class="form-group">
                <label for="num_cliente" class="col-form-label">Número:</label>
                <input type="number" class="form-control" id="num_cliente">
                </div>                
                <div class="form-group">
                <label for="municipio_cliente" class="col-form-label">Municipio:</label>
                <input type="text" class="form-control" id="municipio_cliente">
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
     
    <script type="text/javascript" src="clientes.js"></script>  
    
    
  </body>
</html>
