<?php session_start();
/**
 * Session de Usuario
 * @author  <elias_gomez10@hotmail.com>
 * 
 */
include '../layouts/header.php';
?>

<div class="col-lg-3 list-group-flush">
    <div class="page-header">
        <center>
            <img class="fotoUsuario" src="../img/users/<?php echo $_SESSION['foto_perfil']?>" alt="user" class="img-thumbnail" >
            <br/><strong><?php echo $_SESSION['usuario'] ?></strong><br/><?php echo $_SESSION['no_ctrl'] ?>
        
        </center>
    </div>
    
        
    
    
    <!-- Menu de Opciones -->
<div class="list-group">
     <a href="<?php echo BASEURL."views/admin/inicio.php" ?>" class="list-group-item">MENU</a>
    <a href="<?php echo BASEURL."views/admin/Publicaciones.php" ?>" class="list-group-item">Publicaciones</a>
    <a href="<?php echo BASEURL."views/admin/Comentarios.php" ?>" class="list-group-item">Comentarios</a>
    <a href="<?php echo BASEURL."views/admin/Avisos.php" ?>" class="list-group-item">Avisos</a>
    <a href="<?php echo BASEURL."views/admin/Cuentas.php" ?>" class="list-group-item">Cuentas</a>    
    <a href="<?php echo BASEURL."views/admin/Productos.php" ?>" class="list-group-item">Productos</a>    
    
</div>
<!-- Termina Menu de Opciones -->
    
</div>



<!-- Mensaje Bienvenida -->
<div class="col-lg-9">
    <div class="page-header">
                
       <legend><center><h2>Bienvenido <?php echo $_SESSION['usuario']?></h2></center></legend>
        
        <p class="lead">
            <center>
             
            AQUI VA INFORMACION PARA EL ADMINISTRADOR    <br/><br/>                
            </center>
        </p>

        
        <!-- Carrousel -->
        <div id="carousel-example-generic" class="carousel slide bs-docs-carousel-example">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <center><img class="imgCarrousel" src="../img/sisinfo.jpg" alt="First slide"></center>
                </div>                
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </div>
        <!-- Termina Carrousel -->

    </div>
</div>
<!-- Termina Mensaje Bienvenida -->


<?php include '../layouts/footer.php';?>
