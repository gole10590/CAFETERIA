<?php session_start();

    /**
     * RegistraRenta.php
     * @author ManeRs11 <maners.011@gmail.com>
     *   
     */

    include ('../../models/Conexion.php');
    include ('../../models/Modelo.php');
    include ('../../models/Inmueble.php');
    include ('../../libs/adodb5/adodb-pager.inc.php');
    include ('../../libs/adodb5/adodb.inc.php');
    include ('../../controllers/siteController/rentaController.php');
    include ('../../controllers/siteController/siteController.php');
    
    $admin = new RentaController();
    
    $datosUsuario = array(
        'deposito' => '',
        'renta' => '',
        'contacto' => $_SESSION['correo'],
        'nombre' => $_SESSION['nombre'],
        'descripcion' => '',        
        'id_usuario' => $_SESSION['id_usuario'],        
        'id_clasificacion' => '4',
        'foto_inmueble' => '',
    );
    
    
    //libreria del formulario ----------------------------
        require '../../libs/zebra_form/Zebra_Form.php';
    //definimos el formulario ----------------------------
        $form = new Zebra_Form('form','POST','',array());
        $form->language('espanol');
        $form->auto_fill($datosUsuario);

        $form->add('label', 'label_deposito', 'deposito', 'Deposito Inicial:');
        $obj = $form->add('text', 'deposito');
        $obj->set_rule(array(
            'required'  =>  array('error', 'El deposito es requerido.!'),
            'number'    => array('', 'error', 'El deposito de la Renta debe ser Representada de manera NUMERICA...!')
        ));
        
        $form->add('label', 'label_renta', 'renta', 'Renta a Cobrar:');
        $obj = $form->add('text', 'renta');
        $obj->set_rule(array(
            'required'  =>  array('error', 'Si vas a renta es requerido que llenes este campo!'),
            'number'    => array('', 'error', 'La Renta que cobras debe ser Representada de manera NUMERICA...!')
        ));
        
//        $form->add('label', 'label_contacto', 'contacto', 'contacto:');
        $obj = $form->add('hidden', 'contacto');
        $obj->set_rule(array(
            'required'  =>  array('error', 'Debes Tener un contacto de Usuario!'),
        ));
            
//        $form->add('label', 'label_nombre', 'nombre', 'Nombre de Pila:');
        $obj = $form->add('hidden', 'nombre');
        $obj->set_rule(array(
            'required'  =>  array('error', 'Nombre es requerido para Registro!'),
        ));
            
        $form->add('label', 'label_descripcion', 'descripcion', 'Describe tu Cuarto-Habitacion:');
        $obj = $form->add('textarea', 'descripcion');
        $obj->set_rule(array(
            'required' => array('error', 'Si quieres rentar tu inmueble debes dar una buena descripcion de este!')
        ));                        
        
//        $form->add('label', 'label_id_usuario', 'id_usuario', 'id_usuario:');
        $obj = $form->add('hidden', 'id_usuario');
        $obj->set_rule(array(
            'required'  => array('error', 'Correo Electronico es requerido para el Registro!'),
        ));        
                
//        $form->add('label', 'label_id_clasificacion', 'id_clasificacion', 'id_clasificacion:');
        $obj = $form->add('hidden', 'id_clasificacion');
        $obj->set_rule(array(
            'required'  => array('error', 'Clasificacion!'),            
        ));
        
        //imagen
    $_SESSION['nombre_img'] = md5(rand(0, 500));
    $form->add('label', 'label_file', 'file', 'Sube una imagen de tu Inmueble');
    $obj = $form->add('file', 'file');
    $obj->set_rule(array(
        'upload' => array('../img/Rentas', $_SESSION['nombre_img'], 'error', 'Could not upload file!<br>Check that the "tmp" folder exists inside the "examples" folder and that it is writable'),
        'image' => array('error', 'La extension debe ser jpg, png o gif image!'),
        'filesize' => array(102400, 'error', 'Tu archivo exede los 100Kb! elige una mas pequeña :)'),
        'required' => array('error', 'Se Requiere de una Imagen!')
    ));
    $form->add('note', 'note_file', 'file', 'Tu imagen No debe Exceder los 100Kb.');
        
        // "submit"
        $form->add('submit', 'btnsubmit', 'Registrar');      
    
        //validamos el formulario -------------------------------
        if ($form->validate()){
                $usuario = new RentaController();
                if(isset($_POST)){
                    $_POST['foto_inmueble'] = $_SESSION['nombre_img'] . $_FILES['file']['name'];
                    if($usuario->registraRenta($_POST)){
                        header("Location: Rentas.php");
                        exit();
                    }else{
                        $errores = true;
                       
                    }
                }
        } 
include("../layouts/header.php"); ?>

<?php ?>

    <link rel="stylesheet" href="../../libs/zebra_form/public/css/zebra_form.css">
    <script src="../../libs/zebra_form/public/javascript/zebra_form.js"></script>

<div class="col-lg-8 col-push-2">    
        <center>
            <legend><strong>Registro de Inmuebles</strong></legend>        
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
<?php include("../layouts/footer.php"); ?>

    