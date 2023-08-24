<?php
include("../../db.php");

if(isset($_GET['txtID'])){

    //if ternario
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
  
    $sentencia=$conexion->prepare("SELECT *,(SELECT nombrepuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idcargo limit 1) as puesto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  
    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];

    $nombrecompleto=$primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido;
  
    $foto=$registro["foto"];
    $cv=$registro["cv"];
    $idpuesto=$registro["idcargo"];
    $puesto=$registro["puesto"];
    $fechaingreso=$registro["fechaingreso"];

    $fecha_actual = date("d-m-Y");
    $fechaInicio=new DateTime($fechaingreso);
    $fechaFin=new DateTime(date('Y-m-d'));
    $diferencia=date_diff($fechaInicio,$fechaFin);



  

  
  }
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendacion</title>
</head>
<body>

<h1>Carta de Recomendacion Laboral</h1>
<br><br>
Santiago de Chile  <strong><?php echo $fecha_actual?></strong>
<br><br>
A quien pueda interesar:
<br><br>
Un cordial y respetuoso saludo.
<br><br>
A traves de esta carta deseo hacer de su conocimiento que Sr(a) <strong><?php echo $nombrecompleto?></strong>, quien laboro en mi organizacion durante <strong><?php echo $diferencia->y?> año(s) </strong>
es un ciudadano con una conducta intachable. Ha demostrado ser un gran trabajador, comprometido, responsable y fiel cumplidor de sus tareas. 
Siempre ha manifestado preocupacion por mejorar, capacitarse y actualizar sus conocimientos.
<br><br>
Durante estos años se ha desempeñado como: <strong><?php echo $puesto?></strong>. Es por ello que sugiera considere esta recomendacion, con la confianza de quee stara siempre a la 
altura de su carga. Sin nada mas que agregar y, esperando que esta misiva sea tomada en cuenta, dejo mi numero de contacto xxxxxxxxxx.
<br><br><br>
Atentamente
<br> 
el big boss. 

    
</body>
</html>

<?php
$HTML=ob_get_clean();

require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf= new Dompdf();

$opciones=$dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));

$dompdf->SetOptions($opciones);
$dompdf->loadHTML($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf",array("Attachment"=>false));
?>