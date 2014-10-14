<?php
session_start();

include ('../../models/Conexion.php');
include ('../../models/Modelo.php');
include ('../../models/Usuario.php');
include ('../../libs/adodb5/adodb-pager.inc.php');
include ('../../libs/adodb5/adodb.inc.php');
include ('../../controllers/adminController/registroController.php');
include ('../../controllers/adminController/siteController.php');


 $identificador = $_GET["id"];
 $precio = $_GET["pre"];
 $nombre = $_GET["nom"];
 $descripcion = $_GET["des"];


$datosProducto = array(
    'id_producto' => $identificador,
    'precio' => $precio,
    'nombre' => $nombre,
    'imagen' => '',
    'descripcion' => $descripcion,
);

//libreria del formulario ----------------------------
require '../../libs/zebra_form/Zebra_Form.php';
//definimos el formulario ----------------------------
$form = new Zebra_Form('form', 'POST', '', array());
$form->language('espanol');
$form->auto_fill($datosProducto);

        $form->add('label', 'label_nombre', 'nombre', 'Nombre del producto:');
        $obj = $form->add('text', 'nombre');
        $obj->set_rule(array(
            'required'  =>  array('error', 'Nombre es requerido para Registro!'),
        ));
        
        
         $form->add('label', 'label_precio', 'precio', 'Precio');
        $obj = $form->add('text', 'precio');
        $obj->set_rule(array(
            'required'  =>  array('error', 'El precio es requerido'),
            'number'    => array('', 'error', 'El deposito de la Renta debe ser Representada de manera NUMERICA...!')
        ));
        
         $form->add('label', 'label_descripcion', 'descripcion', 'Describe tu producto:');
        $obj = $form->add('textarea', 'descripcion');
        $obj->set_rule(array(
            'required' => array('error', 'Si quieres vender el producto debes descrirlo explicitamente')
        ));
        
        $_SESSION['imagen'] = md5(rand(0, 500));
        $form->add('label', 'label_file', 'imagen', 'Selecciona imagen producto');
        $obj = $form->add('file', 'imagen');
        $obj->set_rule(array(
            'upload' => array('../img/comida', $_SESSION['imagen'], 'error', 'Could not upload file!<br>Check that the "tmp" folder exists inside the "examples" folder and that it is writable'),
            'image' => array('error', 'La extension debe ser jpg, png o gif image!'),
            'filesize' => array(102400, 'error', 'Tu archivo exede los 100Kb! elige una mas pequeña :)'),
            'required' => array('error', 'Se Requiere de una Imagen!')
        ));
        $form->add('note', 'note_file', 'file', 'Tu imagen No debe Exceder los 100Kb.');



// "submit"
$form->add('submit', 'btnsubmit', 'Actualiza Datos');

//validamos el formulario -------------------------------
if ($form->validate()) {
    
    $usuario = new siteController();
    if (isset($_POST)) 
        {
        $_POST['id_producto']=$identificador;
        $_POST['imagen'] = $_SESSION['imagen'] . $_FILES['imagen']['name'];
        $usuario->actualiza_datos_producto($_POST);
//        if ($usuario->actualiza_usuario($_POST)) {
            
            header("Location: productos.php");
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
                <legend><strong>Actualización de productos</strong></legend>        
                <?php
                $form->render();
                ?>
            </center>    
        </div>

    </div>


    <!-- Termina Mensaje Bienvenida -->
</div>





<?php include("../layouts/footer.php"); ?>

