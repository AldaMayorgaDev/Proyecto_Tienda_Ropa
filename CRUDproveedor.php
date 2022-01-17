<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$correo= (isset($_POST['correo'])) ? $_POST['correo'] : '';
$nombreEmp= (isset($_POST['nombreEmp'])) ? $_POST['nombreEmp'] : '';
$direccion= (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO proveedor (nombreProveedor, correoProveedor, nombreEmpresa, direccionEmpresa) VALUES('$nombre', '$correo', '$nombreEmp', '$direccion') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombreProveedor, correoProveedor, nombreEmpresa, direccionEmpresa FROM proveedor ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE proveedor SET nombreProveedor='$nombre', correoProveedor='$correo', nombreEmpresa='$nombreEmp' , direccionEmpresa='$direccion' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombreProveedor, correoProveedor, nombreEmpresa, direccionEmpresa FROM proveedor WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM proveedor WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        
        $consulta = "SELECT id, nombreProveedor, correoProveedor, nombreEmpresa, direccionEmpresa FROM proveedor ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
