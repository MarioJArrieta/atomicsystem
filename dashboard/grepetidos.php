<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Listado de personas duplicadas</h1>
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombre, barrio, cedula, celular, mesa, lider, validado FROM repetidos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
   
    <br>  
<div class="container">
<input type="text" id="busqueda" placeholder="Buscar por cedula">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonasR" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Barrio</th>
                                <th>Cedula</th>
                                <th>Celular</th>
                                <th>Mesa</th>
                                <th>Lider</th>
                                <th>Validado</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['barrio'] ?></td>
                                <td><?php echo $dat['cedula'] ?></td>
                                <td><?php echo $dat['celular'] ?></td>
                                <td><?php echo $dat['mesa'] ?></td>
                                <td><?php echo $dat['lider'] ?></td>
                                <td><?php echo $dat['validado'] ?></td>
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
</div>
</html>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>