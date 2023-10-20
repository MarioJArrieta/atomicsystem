<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido principal</h1>
    
    
    
 <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombre, barrio, cedula, celular, mesa, lider, validado FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
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
                                <th>Acciones</th>

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
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="pais" class="col-form-label">Barrio:</label>
                <input type="text" class="form-control" id="barrio">
                </div>                
                <div class="form-group">
                <label for="cedula" class="col-form-label">Cedula:</label>
                <input type="number" class="form-control" id="cedula">
                </div>
                <div class="form-group">
                <label for="celular" class="col-form-label">Celular:</label>
                <input type="number" class="form-control" id="celular">
                </div>
                <div class="form-group">
                <label for="mesa" class="col-form-label">Mesa:</label>
                <input type="number" class="form-control" id="mesa">
                </div>
                <div class="form-group">
                <label for="lider" class="col-form-label">Lider:</label>
                <input type="number" class="form-control" id="lider">
                </div>
                <div class="form-group">
                <label for="validado" class="col-form-label">Validado:</label>
                <input type="number" class="form-control" id="validado">
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
    
    
    
</div>

</html>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>