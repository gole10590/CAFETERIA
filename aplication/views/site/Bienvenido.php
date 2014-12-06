<?php
session_start();
/**
 * Inicio de Sessiones ( Administrador - Usuario )
 * @author 
 * 
 */
include ('../layouts/header.php');
?>


<?php if (isset($_SESSION['id_usuario'])): ?>        
    <!-- Decicion de Inicios de Sección Admin - User -->

    <?php
    if ($_SESSION['admin'] == "isAdmin") {
        // Si inicia session un Administrador redirecciona al menu de Admin                
        header("Location:" . BASEURL . "views/admin/inicio.php");
    } else {
        if ($_SESSION['admin'] == "isClient") {
            // Si inicia session un Cliente redirecciona al menu de Cliente                
            header("Location:" . BASEURL . "views/Client/inicio.php");
        } else {
            // Si inicia session un Usuario redirecciona al menu de Usuario                
            header("Location:" . BASEURL . "views/Empleado/inicio.php");
        }
    }
    ?>

<?php endif; ?>

<div class="col-lg-3 list-group-flush">
    <div class="page-header">
        <center>
            <img class="logoSisinfo" src="../img/ITC.jpg" alt="user" class="img-thumbnail" >        
        </center>
    </div>

    <!-- Menu de Opciones 
    <div class="list-group">    
        <a href="<?php echo BASEURL . "views/site/Bienvenido.php" ?>" class="list-group-item">Información</a>
        <a href="<?php echo BASEURL . "views/site/Eventos.php" ?>" class="list-group-item">Eventos</a>
        <a href="<?php echo BASEURL . "views/site/Rentas.php" ?>" class="list-group-item">Rentas</a>
        <a href="<?php echo BASEURL . "views/site/Becas.php" ?>" class="list-group-item">Becas</a>    
        <a href="<?php echo BASEURL . "views/site/Venta.php" ?>" class="list-group-item">Compra / Venta</a>
    </div>
    
    <!-- Termina Menu de Opciones -->
    
       <div class="panel-body">
            <h5 class="modal-title" align="justify" >
            

                <?php
                $file = fopen("./Archivos_config/bienvenido.txt", "r");
                while (!feof($file)) {
                    echo fgets($file) . "<br />";
                }
                fclose($file);
                ?> <br/><br/>                
            
            </h5>
        </div>


</div>

<!-- Mensaje Bienvenida -->
<div class="col-lg-9">
    <div class="page-header panel panel-info">
        <div class="panel-heading"><center><h2>Bienvenido al sitio web de la Cafetería III del ITC.</h2></center></div>

       


        <!-- Carrousel -->
        <div id="carousel-example-generic" class="carousel slide bs-docs-carousel-example">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <center><img class="imgCarrousel" src="../img/comida_pagina/ASALU.jpg" alt="First slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/comida_pagina/Sonhar.jpg" alt="Second slide"></center>
                </div>                
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/comida_pagina/ensalada.jpg" alt="Third slide"></center>
                </div> 
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/comida_pagina/pizza.jpg" alt="Fourth slide"></center>
                </div>
                <div class="item ">
                    <center><img class="imgCarrousel" src="../img/comida_pagina/sand.jpg" alt="Fifth slide"></center>
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


<!--    <br/><p><a class="btn btn-lg btn-primary" href="Registro.php">Registrate Ahora</a></p> -->
    </div>
</div>
<!-- Termina Mensaje Bienvenida -->    


<?php include ('../layouts/footer.php'); ?>
