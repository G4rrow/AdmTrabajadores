<?php

$servidor="localhost:3310"; //equivale a 127.0.0.1
$baseDatos="app1";   
$usuario="root";
$contrasenia="";

try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario,$contrasenia);
}catch(Exception $ex){
    echo $ex->getMessage();

}

?>