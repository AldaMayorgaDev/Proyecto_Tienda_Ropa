<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$app = (isset($_POST['app'])) ? $_POST['app'] : '';
$apm = (isset($_POST['apm'])) ? $_POST['apm'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$calle = (isset($_POST['calle'])) ? $_POST['calle'] : '';
$colonia = (isset($_POST['colonia'])) ? $_POST['colonia'] : '';
$num = (isset($_POST['num'])) ? $_POST['num'] : '';
$municipio = (isset($_POST['municipio'])) ? $_POST['municipio'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO clientes (nombre_cliente, app_cliente, apm_cliente, telefono_cliente, correo_cliente, calle_cliente, colonia_cliente, num_cliente, municipio_cliente) 
                                    VALUES('$nombre','$app','$apm','$telefono','$correo','$calle','$colonia','$num','$municipio') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta= "SELECT id_cliente, nombre_cliente, app_cliente, apm_cliente, telefono_cliente, correo_cliente, calle_cliente, colonia_cliente, num_cliente, municipio_cliente FROM clientes ORDER BY id_cliente DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE clientes SET nombre_cliente='$nombre', app_cliente='$app', apm_cliente='$apm',
                                         telefono_cliente='$telefono', correo_cliente='$correo', calle_cliente='$calle', colonia_cliente='$colonia', num_cliente='$num', municipio_cliente='$municipio' WHERE id_cliente='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta= "SELECT id_cliente, nombre_cliente, app_cliente, apm_cliente, telefono_cliente, correo_cliente, calle_cliente, colonia_cliente, num_cliente, municipio_cliente FROM clientes WHERE id_cliente='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM clientes WHERE id_cliente='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        
        $consulta = "SELECT id_cliente, nombre_cliente, app_cliente, apm_cliente, telefono_cliente, correo_cliente, calle_cliente, colonia_cliente, num_cliente, municipio_cliente FROM clientes ORDER BY id_cliente DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
