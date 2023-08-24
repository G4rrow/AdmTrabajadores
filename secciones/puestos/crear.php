<?php include("../../db.php");

if($_POST){
    print_r($_POST);


    //$nombredelpuesto=$_POST["nombredelpuesto"];
    //$sentencia=$conexion->prepare("INSERT INTO `tbl_puestos` (`id`, `nombrepuesto`) VALUES (NULL, '$nombredelpuesto');");
    //$sentencia->execute();

    //Validacion y recoleccion de los datos ingresados
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    //Preparar la insercion a la base de datos
    $sentencia=$conexion->prepare("INSERT INTO tbl_puestos(id,nombrepuesto) VALUES (null, :nombredelpuesto)");
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->execute();
    $mensaje="Registro Agregado";
    header("location:index.php?mensaje=".$mensaje);

}

?>

<?php include("../../templates/header.php")?>

<br>

<div class="card">
    <div class="card-header">
        Cargos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombredelpuesto" class="form-label">Nombre del Cargo</label>
                <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>


<?php include("../../templates/footer.php")?>