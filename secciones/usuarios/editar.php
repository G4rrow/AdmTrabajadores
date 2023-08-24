<?php 
include("../../db.php");

if(isset($_GET['txtID'])){

    //if ternario
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombredeusuario=$registro["usuario"];
    $password=$registro["password"];
    $correo=$registro["correo"];
    

}

if($_POST){
    print_r($_POST);
  
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    //Validacion y recoleccion de los datos ingresados
    $nombredeusuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $email=(isset($_POST["email"])?$_POST["email"]:"");
    //Preparar la insercion a la base de datos
    $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario, password=:password, correo=:correo WHERE id=:id");
    //Asignando valores a las :variables
    $sentencia->bindParam(":usuario",$nombredeusuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$email);
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
        Datos del Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text" readonly value="<?php echo $txtID?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del Usuario</label>
                <input type="text" value="<?php echo $nombredeusuario?>"
                    class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del Usuario">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" value="<?php echo $password?>"
                    class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña">

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Correo</label>
                <input type="email" value="<?php echo $correo?>"
                    class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Correo">
            </div>


            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
</div>


<?php include("../../templates/footer.php")?>