<?php
session_start();

if($_POST){
    include("./db.php");

    $sentencia=$conexion->prepare("SELECT *,count(*) as n_usuario FROM `tbl_usuarios` WHERE usuario=:usuario AND password=:password");

    $usuario=$_POST["usuario"];
    $password=$_POST["password"];

    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);


    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);


    if($registro["n_usuario"]>0){
        $_SESSION['usuario']=$registro["usuario"];
        $_SESSION['logeado']=true;
        $_SESSION['perfil']=1;
        header("location:index.php");

    }else{

        $mensaje="<script> Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Usuario o contraseña incorrecta!',
        }) </script>";
        //header("location:login.php");
    }


}


?>


<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS v5.2.1 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- jquery -->
    <script  src="https://code.jquery.com/jquery-3.7.0.min.js"  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="  crossorigin="anonymous"></script>
    <!-- data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
  <link href="assets/css/login.css" rel="stylesheet">

</head>

<body class="text-center">
  <header>
    <!-- place navbar here -->
  </header>
    <main class="form-signin">
        <form action="" method="post">
            <img class="mb-4" src="assets/img/acceso.png" alt="" width="200" height="200">
              <?php if(isset($mensaje))
                echo $mensaje
              ?>         
            <h1 class="h3 mb-3 fw-normal">Ingrese sus datos</h1>

            <div class="form-floating">
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="">
            <label for="usuario">Usuario</label>
            </div>
            <div class="form-floating">
            <input type="password" class="form-control" name="password" id="password" placeholder="">
            <label for="password">Contraseña</label>
            </div>

            <!-- <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Recordarme
            </label>
            </div> -->
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
        </form>
    </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>