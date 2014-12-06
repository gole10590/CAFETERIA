<?php
session_start();

include ('../../models/Conexion.php');
include ('../../models/Modelo.php');
include ('../../models/Usuario.php');
include ('../../libs/adodb5/adodb-pager.inc.php');
include ('../../libs/adodb5/adodb.inc.php');
include ('../../controllers/adminController/registroController.php');
include ('../../controllers/adminController/siteController.php');


$admin = new siteController();
$usuario = $admin->consulta_usuarios("where id_usuario = " . $_SESSION["id_usuario"]);

$datosUsuario = array(
    'foto_perfil' => '',
);

//libreria del formulario ----------------------------
require '../../libs/zebra_form/Zebra_Form.php';
//definimos el formulario ----------------------------
$form = new Zebra_Form('form', 'POST', '', array());
$form->language('espanol');
$form->auto_fill($datosUsuario);


        $_SESSION['nombre_img_perfil'] = md5(rand(0, 500));
        $form->add('label', 'label_file', 'file', 'Selecciona tu imagen de perfil..');
        $obj = $form->add('file', 'file');
        $obj->set_rule(array(
            'upload' => array('../img/users', $_SESSION['nombre_img_perfil'], 'error', 'Could not upload file!<br>Check that the "tmp" folder exists inside the "examples" folder and that it is writable'),
            'image' => array('error', 'La extension debe ser jpg, png o gif image!'),
            'filesize' => array(102400, 'error', 'Tu archivo exede los 100Kb! elige una mas pequeña :)'),
            'required' => array('error', 'Se Requiere de una Imagen!')
        ));
        $form->add('note', 'note_file', 'file', 'Tu imagen No debe Exceder los 100Kb.');



// "submit"
$form->add('submit', 'btnsubmit', 'Cambiar  Imagen');

//validamos el formulario -------------------------------
if ($form->validate()) {
    
    $usuario = new siteController();
    if (isset($_POST)) {
        $_POST['foto_perfil'] = $_SESSION['nombre_img_perfil'] . $_FILES['file']['name'];
        $usuario->actualiza_foto_usuario($_POST, $_SESSION["id_usuario"]);
//        if ($usuario->actualiza_usuario($_POST)) {
            
            header("Location: inicio.php");
            exit();
//        } 
    }
}
include("../layouts/header.php");
?>

<div class="col-lg-8 col-push-2 " >

    <!-- Mensaje Bienvenida -->

    <div class="page-header">

        <link rel="stylesheet" href="../../libs/zebra_form/public/css/zebra_form.css">
        <script src="../../libs/zebra_form/public/javascript/zebra_form.js"></script>

        <div class="">    
            <center>
                <legend><strong>Configuracion de mi Cuenta</strong></legend>        
                <?php
                $form->render();
                ?>
            </center>    
        </div>

    </div>


    <!-- Termina Mensaje Bienvenida -->
</div>





<?php include("../layouts/footer.php"); ?>

