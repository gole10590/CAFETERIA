<?php session_start();

    include ('../../models/Conexion.php');
    include ('../../models/Modelo.php');
    include ('../../models/Usuario.php');
    include ('../../libs/adodb5/adodb-pager.inc.php');
    include ('../../libs/adodb5/adodb.inc.php');
    include ('../../controllers/siteController/loginController.php');
       
    require '../../libs/zebra_form/Zebra_Form.php';
    include("../layouts/header2.php"); 
    if (isset($_SESSION['id_usuario']) || isset($_SESSION['admin'])) {
     header("Location:".BASEURL."views/site/inicio.php");
    } else {
?>

    
<!-- load Zebra_Form's stylesheet file -->

<link rel="stylesheet" href="../../libs/zebra_form/public/css/zebra_form.css">
<!-- load Zebra_Form's JavaScript file -->
<script src="../../libs/zebra_form/public/javascript/zebra_form.js"></script>

<center>
<div class="col-lg-8 col-push-2">
 
  
    <legend><h2>Iniciar Sesion</h2></legend>

<?php //hero-unit col-lg-4 col-offset-4    
    
    // instantiate a Zebra_Form object
    $form = new Zebra_Form('form');
    // the label for the "email" element
    $form->add('label', 'label_correo', 'correo', 'Correo Electronico');
    // add the "email" element
    $obj = $form->add('text', 'correo', '', array('autocomplete' => 'off'));
    // set rules
    $obj->set_rule(array(
        // error messages will be sent to a variable called "error", usable in custom templates
        'required'  =>  array('error', 'Correo Electronico es requerido!'),
        'email'     =>  array('error', 'Correo Electronico No es Valido!'),
    ));
    // "password"
    // "password"
    $form->add('label', 'label_password', 'password', 'Password');
    $obj = $form->add('password', 'password', '', array('autocomplete' => 'off'));
    
    $obj->set_rule(array(
        'required'  => array('error', 'Password is required!'),
        'length'    => array(6, 20, 'error', 'The password must have between 6 and 20 characters!'),
    ));
    $form->add('note', 'note_file', 'password', 'La contraseña debe estar entre 6 y 20 caracteres!.');

//    // "remember me"
//    $form->add('checkbox', 'remember_me', 'yes');
//    $form->add('label', 'label_remember_me_yes', 'remember_me_yes', 'Remember me', array('style' => 'font-weight:normal'));

    // "submit"
    $form->add('submit', 'btnsubmit', 'Iniciar sesion');
    
    // if the form is valid
    
    if ($form->validate()) {
        if(isset($_POST['correo'])){
            $login = new LoginController();
            if(!$login->valida_usuario($_POST['correo'], $_POST['password'])){
                $form->render();
            }else{
                header("location: Bienvenido.php");
            }
        }
    } else
        $form->render();
?>
    </div>
</center>

<?php } include("../layouts/footer.php"); ?>
