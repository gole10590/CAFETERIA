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


if ($identificador == "ActStatus") {
    $status = $_GET["stt"];
    $id_producto = $_GET["p"];
    $admin->actualiza_producto($status, $id_producto);
    header("Location: " . BASEURL . "views/admin/Productos.php");
} else {
    if ($identificador == "EliminaProd") {

        $id_producto = $_GET["p"];
        $admin->elimina_producto($id_producto);
        header("Location: " . BASEURL . "views/admin/Productos.php");
    } else 
    {
        if ($identificador == "ActEdoUser")
        {
            $id_usuario =$_GET["p"];
             $estado = $_GET["stt"];
             $admin->actualiza_Edo_user($estado, $id_usuario);
            header("Location: " . BASEURL . "views/admin/Bloquear_usuarios.php");
        }
        else {
        die("ERROR ACTUALIZANDO-----");
        }
    }
}
?>