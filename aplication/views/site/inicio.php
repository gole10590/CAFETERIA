<?php session_start();
/**
 * Session de Usuario
 * @author 
 * 
 */
include '../layouts/header.php';
?>

<div class="col-lg-12" >
<div class="col-lg-3 list-group-flush">
    
    <?php if (isset($_SESSION['id_usuario'])) : ?>
            <div class="page-header">
                <center>
                    <a href="CambiarImagen.php"><img data-toggle="tooltip" title="Cambiar Imagen" class="fotoUsuario" src="../img/users/<?php echo $_SESSION['foto_perfil']?>" alt="user" class="img-thumbnail" ></a>
                    <br/><strong><?php echo $_SESSION['usuario'] ?></strong><br/><?php echo $_SESSION['no_ctrl'] ?>
                </center>
            </div>
        <?php endif; if (!isset($_SESSION['id_usuario'])) : ?>
            <? header("Location:".BASEURL."views/site/Bienvenido.php")?>
        <?php endif; ?>
    
    
    <!-- Menu de Opciones -->
<div class="list-group">
    <a href="<?php echo BASEURL."views/site/inicio.php" ?>" class="list-group-item active">Informacion</a>
    <a href="<?php echo BASEURL."views/site/Eventos.php" ?>" class="list-group-item">Eventos</a>
    <a href="<?php echo BASEURL."views/site/Rentas.php" ?>" class="list-group-item">Rentas</a>
    <a href="<?php echo BASEURL."views/site/Becas.php" ?>" class="list-group-item">Becas</a>
    <a href="<?php echo BASEURL . "views/site/Venta.php" ?>" class="list-group-item">Compra / Venta</a>
</div>
<!-- Termina Menu de Opciones -->
    
</div>



<!-- Mensaje Bienvenida -->
<div class="col-lg-9">
    <div class="page-header panel panel-default">
        <div class="panel-heading"><center><h2>Bienvenido <?php echo $_SESSION['usuario']?></h2></center></div>
        <div class="panel-body">
        <p class="lead">
            <center>
                AQUI VA INFROMACION PARA LOS USUARIOS<br/><br/>                
            </center>
        </p>
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
                    <center><img class="imgCarrousel" src="../img/sisinfo.jpg" alt="First slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/404.png" alt="Second slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/logo.gif" alt="Second slide"></center>
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
