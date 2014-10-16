<?php

session_start();

include ('../../models/Conexion.php');
include ('../../models/Modelo.php');
include ('../../libs/adodb5/adodb-pager.inc.php');
include ('../../libs/adodb5/adodb.inc.php');
include ('../../controllers/adminController/siteController.php');
include '../layouts/header.php';

$admin = new siteController();
$identificador = $_GET["id"];





if ($identificador == "AddProd") {
    $id_producto = $_GET["p"];

    $file = fopen("./Archivos_config/archivo_temp.txt", "a");
    fwrite($file, $id_producto . PHP_EOL);
    fclose($file);
    header("Location: " . BASEURL . "views/Client/Productos.php");
} else {

    if ($identificador == "Insert") {
        $file = fopen("./Archivos_config/archivo_temp.txt", "w");

        fclose($file);
        header("Location: " . BASEURL . "views/Client/Productos.php");
    
} else {
echo 'No se cargaron datos de productos';
}
}
?>