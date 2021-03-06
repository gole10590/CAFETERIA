<?php
session_start();
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
            <a href="CambiarImagen.php"><img data-toggle="tooltip" title="Cambiar Imagen" class="fotoUsuario" src="../img/users/<?php echo $_SESSION['foto_perfil'] ?>" alt="user" class="img-thumbnail" ></a>

            <br/><strong><?php echo $_SESSION['nombre'] ?></strong><br/><?php echo $_SESSION['id_usuario'] ?>

        </center>
    </div>




    <!-- Menu de Opciones -->
    <div class="list-group">
        <a href="<?php echo BASEURL . "views/admin/inicio.php" ?>" class="list-group-item">MENU</a>
        <a href="<?php echo BASEURL . "views/admin/Registro.php" ?>" class="list-group-item">Crear usuarios</a>
        <a href="<?php echo BASEURL . "views/admin/Bloquear_usuarios.php" ?>" class="list-group-item">Bloqueo de Usuarios</a>       
        <a href="<?php echo BASEURL . "views/admin/Productos.php" ?>" class="list-group-item">Productos</a>
        <a href="<?php echo BASEURL . "views/admin/Estadisticas.php" ?>" class="list-group-item">Estadisticas Venta</a>     

    </div>
    <!-- Termina Menu de Opciones -->

</div>



<!-- Mensaje Bienvenida -->
<div class="col-lg-9">
    <div class="page-header">

        <legend class="modal-content" ><center><h2>Bienvenido <?php echo $_SESSION['nombre'] ?></h2></center></legend>

        <h4 class="modal-open" >
            <center>

                <?php
                $file = fopen("./Archivos_config/info_inicio.txt", "r");
                while (!feof($file)) {
                    echo fgets($file) . "<br />";
                }
                fclose($file);
                ?>   <br/><br/>                
            </center>
        </h4>


        <!-- Carrousel -->
        <div id="carousel-example-generic" class="carousel slide bs-docs-carousel-example">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>

            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <center><img class="imgCarrousel" src="../img/cafeteria1.jpg" alt="First slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/cafeteria2.jpg" alt="Second slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/cafeteria3.jpg" alt="Third slide"></center>
                </div> 
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/cafeteria4.jpg" alt="Fourth slide"></center>
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


<?php include '../layouts/footer.php'; ?>
