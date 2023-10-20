<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$barrio = (isset($_POST['barrio'])) ? $_POST['barrio'] : '';
$cedula = (isset($_POST['cedula'])) ? $_POST['cedula'] : '';
$celular = (isset($_POST['celular'])) ? $_POST['celular'] : '';
$mesa = (isset($_POST['mesa'])) ? $_POST['mesa'] : '';
$lider = (isset($_POST['lider'])) ? $_POST['lider'] : '';
$validado = (isset($_POST['validado'])) ? $_POST['validado'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $verificar_usuario = "SELECT cedula FROM personas WHERE cedula = :cedula";
        $stmt = $conexion->prepare($verificar_usuario);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();

        // Obtener el número de filas del resultado
        $numRows = $stmt->rowCount();
        $response = array();
        if ($numRows > 0)
        {   
            $consulta = "INSERT INTO repetidos (nombre, barrio, cedula, celular, mesa, lider, validado) VALUES('$nombre', '$barrio', '$cedula', '$celular', $mesa, $lider, $validado) ";
            $resultado1 = $conexion->prepare($consulta);
            $resultado1->execute(); 
            
            $consulta = "SELECT id, nombre, barrio, cedula, celular, mesa, lider, validado, 'si' as rep FROM personas ORDER BY id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $data["alerta"] = "Usuario repetido";
            
        }
        else{
            
            $consulta = "INSERT INTO personas (nombre, barrio, cedula, celular, mesa, lider, validado) VALUES('$nombre', '$barrio', '$cedula', '$celular', $mesa, $lider, $validado) ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT id, nombre, barrio, cedula, celular, mesa, lider, validado, 'no' as rep FROM personas ORDER BY id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $data["alerta"] = "Usuario Registrado";
            

        }
        break;
    case 2: //modificación
        $consulta = "UPDATE personas SET nombre='$nombre', barrio='$barrio', cedula='$cedula', celular='$celular', mesa='$mesa', lider='$lider', validado='$validado' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, barrio, cedula ,celular, mesa, lider, validado FROM personas WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM personas WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
