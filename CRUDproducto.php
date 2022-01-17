<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$codigo = (isset($_POST['codigo'])) ? $_POST['codigo'] : '';
$nombreP = (isset($_POST['nombreP'])) ? $_POST['nombreP'] : '';
$talla= (isset($_POST['talla'])) ? $_POST['talla'] : '';
$tipo= (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$precio= (isset($_POST['precio'])) ? $_POST['precio'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO producto (codigoProducto, nombreProducto, talla, tipo, precio) VALUES('$codigo', '$nombreP', '$talla', '$tipo', '$precio') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombreProducto, talla, tipo, precio FROM Producto ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE producto SET codigoProducto='$codigo', nombreProducto='$nombreP', talla='$talla', tipo='$tipo' , precio='$precio' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, codigoProducto, nombreProducto, talla, tipo, precio FROM producto WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM producto WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        
        $consulta = "SELECT id, codigoProducto, nombreProducto, talla, tipo, precio FROM producto ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
