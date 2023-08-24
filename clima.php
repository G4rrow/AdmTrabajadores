<!-- Archivo de pruebas -->
<?php

$apikey="f7c2cb3502a1b858df59fd0a494cb89c";
$urlapi="http://api.openweathermap.org/data/2.5/weather?q=Santiago, CL&APPID=".$apikey;

$json_file= file_get_contents($urlapi);
$vars = json_decode($json_file);

//print_r($vars);

$info=$vars->main;
$celcius = $info->temp - 273.15;


$weather = $vars->weather;
$icon = $weather[0]->icon;
// echo '<img src="http://openweathermap.org/img/w/'.$icon.'.png">'.$celcius."°C";
//print_r($info);



?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <!-- Bootstrap CSS v5.2.1 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- jquery -->
    <script  src="https://code.jquery.com/jquery-3.7.0.min.js"  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="  crossorigin="anonymous"></script>
    <!-- data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="d-flex flex-column h-100">
    
    <?php $fechaActual = date("d-m-Y");?>
    <?php echo $celcius."°C";?>
    <p><strong>Reloj</strong></p>
    <div class="reloj">
        <h5><span><?php echo $fechaActual." " ?></span><span id="tiempo">00 : 00 : 00</span></h5>
    </div>


    
    <footer class="footer mt-auto py-3 bg-black">
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                </a>
                <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
                </div>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
                </ul> 
            </footer>
        </div>
    </footer>





    <!-- <script src="assets/js/reloj.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

