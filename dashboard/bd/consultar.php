<?php
// Conectar a la base de datos (ajusta estos valores según tu configuración)
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Procesar el número de Cedula enviado desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST["cedula"];

    $verificar_usuario = "SELECT lider FROM personas WHERE cedula = :cedula";
    $stmt = $conexion->prepare($verificar_usuario);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->execute();

    // Obtener el número de filas del resultado
    $numRows = $stmt->rowCount();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($numRows > 0)
    {   
        echo '<script language="javascript">alert("Usuario ya está registrado con el líder: ' . $data['lider'] . '");
        location.href = "../consulta.php";
      </script>';
            
    }else{
        echo '<script language="javascript">alert("Usuario no se encuentra registrado");
        location.href = "../consulta.php";
      </script>';
    }
    
}
?>