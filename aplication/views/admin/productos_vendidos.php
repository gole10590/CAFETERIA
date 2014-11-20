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
$rentas = $admin->consulta_total_ventas();
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
            <a href="<?php echo BASEURL . "views/admin/productos_no_vendidos.php" ?>" class="list-group-item ">Productos menos vendidos</a>

        </div>
        <!-- Termina Menu de Opciones -->
    </div>

    <div class="col-lg-9">


        <div class="page-header panel panel-default">            
            <div class="modal-content"><center><h2>Productos mas vendidos</h2></center></div>
            <div class="panel-body">
                <legend>
                    <p>
                    <h4 class="modal-open" >
                        <center>
                            <?php
                            $file = fopen("./Archivos_config/estadisticas_2.txt", "r");
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
            <table class="table table-striped " id="example">
                <thead>
                    <tr>
                        <th>Nombre Producto</th>
                        <th>Cantidad vendido</th>

                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rentas as $key => $value) : $id_pro = $rentas[$key]["id_producto"]
                    ?>
                    <tr>
                       <td><?php echo $rentas[$key]['nombre'] ?></td>
                       <td><?php echo $rentas[$key]['cantidad'] ?></td>

                    </tr>


                  <?php endforeach; ?> 
                </tbody>
            </table>


        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>
