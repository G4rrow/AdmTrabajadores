<?php 
include("../../db.php");

if(isset($_GET['txtID'])){

    //if ternario
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelpuesto=$registro["nombrepuesto"];
    

}

if($_POST){



    //$nombredelpuesto=$_POST["nombredelpuesto"];
    //$sentencia=$conexion->prepare("INSERT INTO `tbl_puestos` (`id`, `nombrepuesto`) VALUES (NULL, '$nombredelpuesto');");
    //$sentencia->execute();

    //Validacion y recoleccion de los datos ingresados
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    //Preparar la insercion a la base de datos
    $sentencia=$conexion->prepare("UPDATE tbl_puestos SET nombrepuesto=:nombredelpuesto WHERE id=:id");
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="Registro Actualizado";
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
              <label for="txtID" class="form-label">ID:</label>
              <input type="text" readonly value="<?php echo $txtID?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="nombredelpuesto" class="form-label">Nombre del Cargo</label>
                <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="<?php echo $nombredelpuesto?>">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>

</div>


<?php include("../../templates/footer.php")?>