<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$matricula = (isset($_POST['matricula'])) ? $_POST['matricula'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO alumnos (nombre, apellidos, matricula, telefono) VALUES('$nombre', '$apellidos', '$matricula', '$telefono') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombre, apellidos, matricula, telefono FROM alumnos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE alumnos SET nombre='$nombre', apellidos='$apellidos', matricula='$matricula' , telefono='$telefono' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, apellidos, matricula, telefono FROM alumnos WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM alumnos WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();     
        
        $consulta = "SELECT id, nombre, apellidos, matricula, telefono FROM alumnos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
