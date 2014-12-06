<?php session_start();
/**
 * Session de Usuario
 * @author 
 * 
 */

include ('../../models/Conexion.php');
include ('../../models/Modelo.php');
include ('../../libs/adodb5/adodb-pager.inc.php');
include ('../../libs/adodb5/adodb.inc.php');
include ('../../controllers/adminController/siteController.php');

include '../layouts/header.php';


include ('../../controllers/siteController/Desconexion_usuario.php');
 
 
 
?>

<div class="col-lg-12" >
<div class="col-lg-3 list-group-flush">
    
    <?php if (isset($_SESSION['id_usuario'])) : ?>
            <div class="page-header">
                <center>
                    <a href="CambiarImagen.php"><img data-toggle="tooltip" title="Cambiar Imagen" class="fotoUsuario" src="../img/users/<?php echo $_SESSION['foto_perfil']?>" alt="user" class="img-thumbnail" ></a>
                    <br/><strong><?php echo $_SESSION['nombre'] ?></strong><br/><?php echo $_SESSION['id_usuario'] ?>
                </center>
            </div>
        <?php endif; if (!isset($_SESSION['id_usuario'])) : ?>
            <? header("Location:".BASEURL."views/site/Bienvenido.php")?>
        <?php endif; ?>
    
    
    <!-- Menu de Opciones -->
<div class="list-group">
    <a href="<?php echo BASEURL."views/Client/inicio.php" ?>" class="list-group-item ">Menu</a>
    <a href="<?php echo BASEURL."views/Client/Productos.php" ?>" class="list-group-item">Comprar Productos</a>
    
</div>
<!-- Termina Menu de Opciones -->
    
</div>



<!-- Mensaje Bienvenida -->
<div class="col-lg-9">
    <div class="page-header panel panel-default">
        <div class="panel-heading"><center><h2>Bienvenido <?php echo $_SESSION['nombre']?></h2></center></div>
        <div class="panel-body">
        <h4 class="modal-open">
            <center>

                <?php
                $file = fopen("./Archivos_config/producto.txt", "r");
                while (!feof($file)) {
                    echo fgets($file) . "<br />";
                }
                fclose($file);
                ?> <br/><br/>                
            </center>
            </h4>
        </div>
        
        <!-- Carrousel -->
        <div id="carousel-example-generic" class="carousel slide bs-docs-carousel-example">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <center><img class="imgCarrousel" src="../img/comida_pagina/ASALU.jpg" alt="First slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/comida_pagina/Sonhar.jpg" alt="Second slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/comida_pagina/ensalada.jpg" alt="Second slide"></center>
                </div>                
            </div>
            <a data-toggle="tooltip" title="Imagen Anterior" class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a data-toggle="tooltip" title="Siguente Imagen" class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </div>
        <!-- Termina Carrousel -->

    </div>
</div>
<!-- Termina Mensaje Bienvenida -->
</div>

<?php include '../layouts/footer.php';?>
