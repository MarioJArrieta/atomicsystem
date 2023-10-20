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
   
    case 1://baja
        $consulta = "DELETE FROM repetidos WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
