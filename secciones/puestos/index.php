<?php include("../../db.php");


//envio de parametros atraves de la URL con el metodo get
if(isset($_GET['txtID'])){

    //if ternario
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM tbl_puestos WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="Registro eliminiado";
    header("location:index.php?mensaje=".$mensaje);

}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>



<?php include("../../templates/header.php")?>



<script src="assets/js/reloj.js"></script>


<br>

<div class="card">
    <div class="card-header">
        <strong>Registro de Cargos</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id=tabla_id>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del cargo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_tbl_puestos as $registro) {?>    
                    <tr class="">
                        <td scope="row"><?php echo $registro["id"];?></td>
                        <td><?php echo $registro["nombrepuesto"];?></td>
                        <td>
                            <a name="" id="" class="btn btn-warning" href="editar.php?txtID=<?php echo $registro["id"];?>" role="button">Editar</a> 
                            <a name="" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $registro["id"];?>)" role="button">Eliminar</a>
                        </td>
                    </tr>
                <?php }?>    
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
        <a name="" id="" class="btn btn-dark" href="crear.php" role="button">Agregar Cargo</a>
    </div>

</div>




<?php include("../../templates/footer.php")?>