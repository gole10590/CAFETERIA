<?php


$admin = new siteController();

$arreglo = $admin->consulta_estado_usuario($_SESSION['id_usuario']);
              
              $_SESSION['id_estado'] = $arreglo[0]['id_estado'];
               
               if ($_SESSION['id_estado'] == "2")   
               {
                   unset($_SESSION);
                   session_destroy();
                   header("location: ../site/Bienvenido.php");
               }
?>
