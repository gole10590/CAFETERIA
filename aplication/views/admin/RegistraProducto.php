<?php session_start();

    /**
     * 
     * 
     *   
     */

    include ('../../models/Conexion.php');
    include ('../../models/Modelo.php');
    include ('../../controllers/adminController/Producto.php');
    include ('../../libs/adodb5/adodb-pager.inc.php');
    include ('../../libs/adodb5/adodb.inc.php');
    include ('../../controllers/adminController/ProductoController.php');
    include ('../../controllers/adminController/siteController.php');
    
    
    $datosProducto = array(
        'id_producto' => '',
        'nombre' => '',
        'precio' => '',
        'imagen' => '',
        'descripcion' => '',        
        'id_status' => '2',        
        
    );
    
    
    //libreria del formulario ----------------------------
        require '../../libs/zebra_form/Zebra_Form.php';
    //definimos el formulario ----------------------------
        $form = new Zebra_Form('form','POST','',array());
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
                         
        
        //imagen
    $_SESSION['nombre_img'] = md5(rand(0, 500));
    $form->add('label', 'label_file', 'file', 'Sube una imagen de tu Producto');
    $obj = $form->add('file', 'file');
    $obj->set_rule(array(
        'upload' => array('../img/comida', $_SESSION['nombre_img'], 'error', 'Could not upload file!<br>Check that the "tmp" folder exists inside the "examples" folder and that it is writable'),
        'image' => array('error', 'La extension debe ser jpg, png o gif image!'),
//        'filesize' => array(102400, 'error', 'Tu archivo exede los 100Kb! elige una mas pequeña :)'),
         'required' => array('error', 'Se Requiere de una Imagen!')
    ));
    //$form->add('note', 'note_file', 'file', 'Tu imagen No debe Exceder los 100Kb.');
        
        // "submit"
        $form->add('submit', 'btnsubmit', 'Registrar');      
    
        //validamos el formulario -------------------------------
        if ($form->validate()){
                $usuario = new ProductoController();
                if(isset($_POST)){
                     $_POST['status'] = $datosProducto['id_status'];
                    $_POST['imagen'] = $_SESSION['nombre_img'] . $_FILES['file']['name'];
                    if($usuario->registraProducto($_POST)){
                        header("Location: Productos.php");
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
            <legend><strong>Registro de Productos</strong></legend>        
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

    