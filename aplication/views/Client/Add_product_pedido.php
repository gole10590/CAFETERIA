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
    $cantidad = $_GET["cantidad"];
    $nombre = $_GET["nombre"];
    $file = fopen("./Archivos_config/" . $nombre . ".txt", "a");
    fwrite($file, $id_producto . "  " . $cantidad . PHP_EOL);
    fclose($file);
    header("Location: " . BASEURL . "views/Client/Productos.php");
} else {

    if ($identificador == "Insert") {
        $nombre = $_GET["nombre"];
        $fecha = strftime("%Y-%m-%d %H-%M-%S", time());
        $desccuento = 0;
        $comentario = "hola mundo";
        $admin->inserta_pedido($fecha, $nombre, $comentario);

        $pedido = $admin->consulta_pedido($fecha);
        $id_pedido = $pedido[0][0];


        if (file_exists("./Archivos_config/" . $nombre . ".txt")) {

            $file = fopen("./Archivos_config/" . $nombre . ".txt", "r");
            while (!feof($file)) {
                $linea = fgets($file);
//            echo $linea . "<br />";
//             
                if ($linea != "") {
                    $tok = strtok($linea, " ");
                    $id_producto = $tok;
                    echo "id_producto=$id_producto<br />";
                    while ($tok !== false) {
                        $tok = strtok(" ");
                        if ($tok !== false) {
                            $cantidad = $tok;
                        }
                    }

//             echo "cantidad=$cantidad<br />"; 

                    $admin->inserta_detalle_pedido($id_pedido, $id_producto, $cantidad, $desccuento);
                }
            }

            fclose($file);
            unlink("./Archivos_config/" . $nombre . ".txt");
            header("Location: " . BASEURL . "views/Client/Productos.php");
        } else {
            echo "AUN NO SE HAN CARGADO PRODUCTOS AL PEDIDO, FAVOR DE AGREGAR POR LO MENOS UN PRODUCTO.";
        }
    } else {
        if ($identificador == "ActStatus") {

            $status = $_GET["stt"];
            $id_pedido = $_GET["p"];
            $STATUS=$admin->status_pedido($id_pedido);
            if($STATUS[0][0]==1)
            {
               $admin->actualiza_pedido_estatus($status, $id_pedido);
           
             header("Location: " . BASEURL . "views/Client/Productos.php"); 
            }
            else
            { 
               echo 'Lo sentimos pero su pedido ya se esta cocinando, ya no puede ser cancelado'; 
            }
            
        } else {
            echo 'No se cargaron datos de productos';
        }
    }
}
?>