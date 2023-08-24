<?php
include("../../db.php");

if($_POST){

  //Validacion y recoleccion de los datos ingresados
  $nombredeusuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
  $password=(isset($_POST["password"])?$_POST["password"]:"");
  $email=(isset($_POST["email"])?$_POST["email"]:"");
  //Preparar la insercion a la base de datos
  $sentencia=$conexion->prepare("INSERT INTO tbl_usuarios(id,usuario,password,correo) VALUES (null, :usuario,:password,:correo)");
  //Asignando valores a las :variables
  $sentencia->bindParam(":usuario",$nombredeusuario);
  $sentencia->bindParam(":password",$password);
  $sentencia->bindParam(":correo",$email);
  $sentencia->execute();
  
  $mensaje="Registro Agregado";
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
            <label for="usuario" class="form-label">Nombre del Usuario</label>
            <input type="text"
              class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del Usuario">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña">

          </div>
          <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input type="email"
              class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Correo">
          </div>


          <button type="submit" class="btn btn-success">Agregar</button>
          <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

      </form>
    </div>
</div>


<?php include("../../templates/footer.php")?>