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


if ($identificador == "ActStatus") {

    $status = $_GET["stt"];
    $id_pedido = $_GET["p"];

    $STATUS = $admin->status_pedido($id_pedido);
    if ($STATUS[0][0] == 1) {
        $admin->actualiza_pedido_estatus($status, $id_pedido);


        header("Location: " . BASEURL . "views/Empleado/pedidos.php");
    } else {
        if ($STATUS[0][0] == 3) {
            $admin->actualiza_pedido_estatus($status, $id_pedido);
            header("Location: " . BASEURL . "views/Empleado/pedidos.php");
        } else {
            echo 'Lo sentimos pero este pedido ya fue cancelado..........';
        }
    }
}
if ($identificador == "email") {

    $status = $_GET["stt"];

    $correo = $_GET["em"];
    $id_pedido = $_GET["id_ped"];

    $total=$_GET["total"];


    $lista2 = $admin->lista_productos($id_pedido);

    
    foreach ($lista2 as $elemento) {

        $PRODUCTOS =$PRODUCTOS."PRODUCTO: ".$elemento['nombre'] . ",  CANTIDAD DEL PRODUCTO = " . $elemento['cantidad'] . ",  Precio/Unitario: $" . $elemento['precio'] . '</br></br></br>';
    }

    $asunto = "SU PEDIDO ESTA LISTO";
    $mensaje = "SU PEDIDO YA ESTA LISTO PARA RECOGER..." . '</br></br>' . "Numero de pedido: " . $id_pedido . '</br></br>' . "Lista de pedido : " . '</br></br>' .  $PRODUCTOS.'</br></br></br>'."TOTAL A PAGAR = $".$total;


    $send_email->enviaMail($correo, $asunto, $mensaje);
    $admin->actualiza_pedido_estatus($status, $id_pedido);
    header("Location: " . BASEURL . "views/Empleado/pedidos.php");
}

if ($identificador == "reemail") {


    $id_pedido = $_GET["p"];
    $correo = $_GET["em"];

   $lista2 = $admin->lista_productos($id_pedido);

    
    foreach ($lista2 as $elemento) {

        $PRODUCTOS =$PRODUCTOS."PRODUCTO: ".$elemento['nombre'] . ",  CANTIDAD DEL PRODUCTO = " . $elemento['cantidad'] . ",  Precio/Unitario: $" . $elemento['precio'] . '</br></br></br>';
    }
    
    $asunto = "SU PEDIDO ESTA LISTO";
    $mensaje = "YA SE LE HA ENVIADO MAS DE UNA NOTIFICACION DE QUE SU PEDIDO YA ESTA LISTO." . '</br></br>' . "SI NO PASA A RECOGER SU PEDIDO SU CUENTA PODRIA SER BLOQUEADA.... " . '</br></br>' ."PRODUCTOS: ".'</br></br>' .$PRODUCTOS. "Numero de pedido: " . $id_pedido;


    $send_email->enviaMail($correo, $asunto, $mensaje);

    header("Location: " . BASEURL . "views/Empleado/pedidos.php");
}
?>