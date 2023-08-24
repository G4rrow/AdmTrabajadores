
<?php
include("../../db.php");

if(isset($_GET['txtID'])){

    //if ternario
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="Registro eliminiado";
    header("location:index.php?mensaje=".$mensaje);


}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_tbl_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>


<?php include("../../templates/header.php")?>
<br>


<div class="card">
    <div class="card-header">
        <strong>Registro de usuarios</strong>
    </div>
    <div class="card-body" id=card_tabla>
        <div class="table-responsive-sm">
            <table class="table table-striped" id=tabla_id>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del Usuario</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_tbl_usuarios as $registro) { ?>

                        <tr class="">
                            <td scope="row"><?php echo $registro["id"];?></td>
                            <td><?php echo $registro["usuario"];?></td>
                            <td>*****</td>
                            <td><?php echo $registro["correo"];?></td>
                            <td>  
                                <a name="" id="" class="btn btn-warning" href="editar.php?txtID=<?php echo $registro["id"];?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $registro["id"];?>)" role="button">Eliminar</a>
                            </td>
                        </tr>

                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
        <a name="" id="" class="btn btn-dark" href="crear.php" role="button">Agregar Usuarios</a>
    </div>

</div>

<script ></script>
<?php include("../../templates/footer.php")?>

