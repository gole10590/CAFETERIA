<?php
session_start();

/**
 * 
 * 
 * 
 */
include ('../../models/Conexion.php');
include ('../../models/Modelo.php');
include ('../../libs/adodb5/adodb-pager.inc.php');
include ('../../libs/adodb5/adodb.inc.php');
include ('../../controllers/adminController/siteController.php');
include '../layouts/header.php';

$admin = new siteController();
$rentas = $admin->consulta_productos();
?>

<div class="col-lg-12" >
    <div class="col-lg-3 list-group-flush" >


        <div class="page-header">
            <center>
                <a href="CambiarImagen.php"><img data-toggle="tooltip" title="Cambiar Imagen" class="fotoUsuario" src="../img/users/<?php echo $_SESSION['foto_perfil'] ?>" alt="user" class="img-thumbnail" ></a>
                <br/><strong><?php echo $_SESSION['nombre'] ?></strong><br/><?php echo $_SESSION['id_usuario'] ?>
            </center>
        </div>


        <!-- Menu de Opciones -->
        <div class="list-group">    
            <a href="<?php echo BASEURL . "views/admin/inicio.php" ?>" class="list-group-item">Menu</a>
            <a href="<?php echo BASEURL . "views/admin/total_ventas.php" ?>" class="list-group-item">Total de ventas/Producto</a>
            <a href="<?php echo BASEURL . "views/admin/productos_vendidos.php" ?>" class="list-group-item ">Productos mas vendidos</a>
            <a href="<?php echo BASEURL . "views/admin/productos_no_vendidos.php" ?>" class="list-group-item ">Productos menos vendidos</a>

        </div>
        <!-- Termina Menu de Opciones -->
    </div>

    <div class="col-lg-9">


        <div class="page-header panel panel-default">            
            <div class="modal-content"><center><h2>Estadistica de Venta</h2></center></div>
            <div class="panel-body">
                <legend>
                    <p>
                    <h4 class="modal-open" >
                        <center>
                            <?php
                            $file = fopen("./Archivos_config/estadisticas.txt", "r");
                            while (!feof($file)) {
                                echo fgets($file) . "<br />";
                            }
                            fclose($file);
                            ?>
                        </center>
                    </h4>                

                    </p>        
                </legend>
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
                    <center><img class="imgCarrousel" src="../img/GRAFICO.jpg" alt="First slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/GRAFICO2.png" alt="Second slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/GRAFICO3.jpg" alt="Second slide"></center>
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
</div>

<?php include '../layouts/footer.php'; ?>