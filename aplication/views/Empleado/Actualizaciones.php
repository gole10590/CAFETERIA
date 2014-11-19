<?php

session_start();

include ('../../models/Conexion.php');
include ('../../models/Modelo.php');
include ('../../models/Usuario.php');
include ('../../libs/adodb5/adodb-pager.inc.php');
include ('../../libs/adodb5/adodb.inc.php');
include ('../../controllers/adminController/siteController.php');
include ('../../controllers/adminController/registroController.php');
include '../layouts/header.php';

$admin = new siteController();
$send_email = new RegistroController();

$identificador = $_GET["id"];


if ($identificador == "ActStatus") 
 {

    $status = $_GET["stt"];
    $id_pedido = $_GET["p"];
    $admin->actualiza_pedido_estatus($status, $id_pedido);
    header("Location: " . BASEURL . "views/Empleado/pedidos.php");
}
if ($identificador == "email") 
 {

    $status = $_GET["stt"];
    $id_pedido = $_GET["p"];
    $correo=$_GET["em"];
    $asunto="SU PEDIDO ESTA LISTO";
    $mensaje="SU PEDIDO YA ESTA LISTO PARA RECOGER....";
    
   
    $send_email->enviaMail($correo,$asunto,$mensaje);
    $admin->actualiza_pedido_estatus($status, $id_pedido);
    header("Location: " . BASEURL . "views/Empleado/pedidos.php");
}
  

?>