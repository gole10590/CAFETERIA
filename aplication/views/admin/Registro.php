<?php session_start();

    /**
     * RegistroUsuario.php
     * 
     *   
     */

    include ('../../models/Conexion.php');
    include ('../../models/Modelo.php');
    include ('../../models/Usuario.php');
    include ('../../libs/adodb5/adodb-pager.inc.php');
    include ('../../libs/adodb5/adodb.inc.php');
    include ('../../controllers/adminController/registroController.php');
    include ('../../controllers/adminController/siteController.php');
    
    $admin = new siteController();
    $tipo_usuario = $admin->consulta_tipo_usuario();
    
    
    $arreglo = array();
    
    foreach ($tipo_usuario as $key => $value)
    {        
          $arreglo [ $value['id_tipo']] = $value['descripcion'];
    }
    
    if (count($tipo_usuario)!=0) {
        $id_tipo = $tipo_usuario[0]['descripcion'];
    } else {
        $id_tipo= '';
    }
    
    $datosUsuario = array(
        'id_tipo' => $id_tipo,
        'id_usuario' => '',
        'nombre' => '',
        'apaterno' => '',
        'amaterno' => '',
        'email' => '',        
        'password' => '',
        'telefono'=>'',
        'password_confirma' => '',
        'foto_perfil' => 'user.jpg',       
        'captcha' => ''
    );
    
    
    //libreria del formulario ----------------------------
        require '../../libs/zebra_form/Zebra_Form.php';
    //definimos el formulario ----------------------------
        $form = new Zebra_Form('form','POST','',array());
        $form->language('espanol');
        $form->auto_fill($datosUsuario);

        # Instructor
        $form->add('label', 'tipo_usuario', 'id_tipo', 'Selecciona tipo de usuario:');
        $obj = $form->add('select', 'id_tipo');
        $obj->add_options($arreglo);
        $obj->set_rule(array(
            'required' => array('error', 'Se necesita un tipo de usuario!'),
        ));
        
        $form->add('label', 'label_id_usuario', 'id_usuario', 'Número de control:');
        $obj = $form->add('text', 'id_usuario');
        $obj->set_rule(array(
            'required'  =>  array('error', 'Número de control es requerido para el Registro!'),
            'number'    => array('', 'error', 'Tu Numero de Control no puede Contener Letras, Verifica...!')
        ));
        
        
            
        $form->add('label', 'label_nombre', 'nombre', 'Nombre de usuario:');
        $obj = $form->add('text', 'nombre');
        $obj->set_rule(array(
            'required'  =>  array('error', 'Nombre es requerido para Registro!'),
        ));
            
        $form->add('label', 'label_apaterno', 'apaterno', 'Apellido Paterno:');
        $obj = $form->add('text', 'apaterno');
        $obj->set_rule(array(
            'required' => array('error', 'Apellidos Paterno')
        )); 
        
        $form->add('label', 'label_amaterno', 'amaterno', 'Apellido Materno:');
        $obj = $form->add('text', 'amaterno');
        $obj->set_rule(array(
            'required' => array('error', 'Apellido Materno')
        )); 
        
        $form->add('label', 'label_correo', 'email', 'Correo Electronico:');
        $obj = $form->add('text', 'email');
        $obj->set_rule(array(
            'required'  => array('error', 'Correo Electronico es requerido para el Registro!'),
            'email'     => array('error', 'Correo Electronico no valido!')
        ));        
        $form->add('note', 'note_correo', 'correo', '', 
                array('style'=>''));
        
        
        $form->add('label', 'label_telefono', 'telefono', 'Telefono:');
        $obj = $form->add('text', 'telefono');
        $obj->set_rule(array(
            'required'  =>  array('error', 'Telefono es requerido'),
            'number'    => array('', 'error', 'Tu Telefono no puede Contener Letras, Verifica...!')
        ));
        
        $form->add('label', 'label_password', 'password', 'Contraseña:');
        $obj = $form->add('password', 'password');
        $obj->set_rule(array(
            'required'  => array('error', 'Contraseña es requerida!'),
            'length'    => array(6, 20, 'error', 'Contraseña debe ser entre 6 y 20 caracteres.'),
        ));
        $form->add('note', 'note_password', 'password', 'Contraseña debe ser entre 6 y 20 caracteres.');
        
        $form->add('label', 'label_password_confirma', 'password_confirma', 'Confirmar Contraseña:');
        $obj = $form->add('password', 'password_confirma');
        $obj->set_rule(array(
            'required'  => array('error', 'Contraseña es requerida!'),
            'length'    => array(6, 20, 'error', 'Contraseña debe ser entre 6 y 20 caracteres.'),
        ));
        $form->add('note', 'note_password_confirma', 'password_confirma', 'Contraseña debe ser entre 6 y 20 caracteres.');
        
        
        
       
        
        
        $form->add('submit', 'btnsubmit', 'Registrar');      
    
        //validamos el formulario -------------------------------
        if ($form->validate())
            {
                $usuario = new RegistroController();
                if(isset($_POST)){
                    if($usuario->registraUsuario($_POST))
                    {
                        header("Location: inicio.php");
                        exit();
                    }else{
                        $errores = true;
                       
                    }
                }
        } 
include("../layouts/header.php"); ?>



    <link rel="stylesheet" href="../../libs/zebra_form/public/css/zebra_form.css">
    <script src="../../libs/zebra_form/public/javascript/zebra_form.js"></script>

<div class="col-lg-8 col-push-2">    
        <center>
            <legend><strong>Registro de Usuarios </strong></legend>        
        <?php //col-lg-4 col-lg-offset-4 col-offset-4
            if(isset($errores))
                foreach ($usuario->errores as $value) {
                    echo '<div class="alert alert-error">
                             <button type="button" class="close" data-dismiss="alert">&times;</button>
                                   '.$value.'                                           
                          </div>';
                }
             $form->render();
        ?>
        </center>    
</div>
<?php  include("../layouts/footer.php"); ?>

    