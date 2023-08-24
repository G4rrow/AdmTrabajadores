<?php include("../../db.php");

if($_POST){
  print_r($_POST);
  print_r($_FILES);


  //$nombredelpuesto=$_POST["nombredelpuesto"];
  //$sentencia=$conexion->prepare("INSERT INTO `tbl_puestos` (`id`, `nombrepuesto`) VALUES (NULL, '$nombredelpuesto');");
  //$sentencia->execute();



  //Validacion y recoleccion de los datos ingresados
  $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
  $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
  $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
  $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");

  $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");
  $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");

  $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
  $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

  $sentencia=$conexion->prepare("INSERT INTO 
  `tbl_empleados` (`id`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `foto`, `cv`, `idcargo`, `fechaingreso`) 
  VALUES (NULL, :primernombre, :segundonombre, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto, :fechaingreso);");

  // Una vez creada la sentencia sql, se utiliza bindParam para vincular las variables a los parametros que se modificaran en la base de datos
  // al momento de realizar el execute
  $sentencia->bindParam(":primernombre",$primernombre);
  $sentencia->bindParam(":segundonombre",$segundonombre);
  $sentencia->bindParam(":primerapellido",$primerapellido);
  $sentencia->bindParam(":segundoapellido",$segundoapellido);

  //Se extrae la fecha de ingreso de la foto para poder agregarsela al nombre de la foto
  //de esta manera evitaremos que existan 2 archivos con el mismo nombre
  //ej foto.jpg se transformaria a foto_"fechahorasegundos".jpg
  $fecha_=new DateTime();
  //crea el nuevo nombre de la foto con un if ternario, si $foto es diferente a vacio, crear el nombre uniendo su nombre+fecha
  $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]['name']:"";
  $tmp_foto=$_FILES["foto"]['tmp_name'];

  //Si tmp_foto no esta vacio, guarda el archivo/foto dentro de las carpetas del proyecto, utilizando move_uploaded_file(nombre del archivo,nueva localizacion)
  if($tmp_foto!=''){
    move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
  }
  $sentencia->bindParam(":foto",$nombreArchivo_foto);

  $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]['name']:"";
  $tmp_cv=$_FILES["cv"]['tmp_name'];

  //Si tmp_foto no esta vacio, guarda el archivo/foto dentro de las carpetas del proyecto, utilizando move_uploaded_file(nombre del archivo,nueva localizacion)
  if($tmp_cv!=''){
    move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
  }
  $sentencia->bindParam(":cv",$nombreArchivo_cv);

  $sentencia->bindParam(":idpuesto",$idpuesto);
  $sentencia->bindParam(":fechaingreso",$fechadeingreso);

  $sentencia->execute();

  $mensaje="Registro Agregado";
  header("location:index.php?mensaje=".$mensaje);

  //Preparar la insercion a la base de datos

}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php")?>
<br>
<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer Nombre</label>
          <input type="text" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer Nombre">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo Nombre">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer Apellido</label>
          <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer Apellido">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo Apellido</label>
          <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto: </label>
          <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV(PDF): </label>
          <input type="file" class="form-control" name="cv" id="CV" aria-describedby="helpId" placeholder="CV">
        </div>
        <div class="mb-3">
            <label for="idpuesto" class="form-label">Cargo</label>
            <select class="form-select form-select-lg" name="idpuesto" id="idpuesto">
              <?php foreach($lista_tbl_puestos as $registro) {?> 
                    <option value="<?php echo $registro["id"];?>"><?php echo $registro["nombrepuesto"];?></option> 
              <?php } ?>
            </select>
        </div>
        <div class="mb-3">
          <label for="fechadeingreso" class="form-label">Fecha de ingreso: </label>
          <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId">
          
        </div>

        <button type="submit" class="btn btn-success">Agregar Registro</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

</div>


<?php include("../../templates/footer.php")?>