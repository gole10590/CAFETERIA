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
                    <a href="CambiarImagen.php"><img data-toggle="tooltip" title="Cambiar Imagen" class="fotoUsuario" src="../img/users/<?php echo $_SESSION['foto_perfil']?>" alt="user" class="img-thumbnail" ></a>
                    <br/><strong><?php echo $_SESSION['nombre'] ?></strong><br/><?php echo $_SESSION['id_usuario'] ?>
                </center>
            </div>
       

        <!-- Menu de Opciones -->
        <div class="list-group">    
            <a href="<?php echo BASEURL . "views/admin/inicio.php" ?>" class="list-group-item">Menu</a>
            <a href="<?php echo BASEURL . "views/admin/Registro.php" ?>" class="list-group-item">Crear Usuarios</a>
            <a href="<?php echo BASEURL . "views/admin/.php" ?>" class="list-group-item active">Estadisticas Venta</a>
            
        </div>
        <!-- Termina Menu de Opciones -->
    </div>

    <div class="col-lg-9">
               
        
        <div class="page-header panel panel-default">            
                <div class="panel-heading"><center><h2>Productos en Venta</h2></center></div>
                        <div class="panel-body">
                            <legend>
                            <p>
                                <h5>
                                    En este apartado podra vizualizar los productos que se ofrecen en la cafeteria, tambien podra agregar nuevos productos y cambiar el estatus de los productos existentes.
                                </h5>                
                                <a data-toggle="tooltip" title="Agregar" href="RegistraProducto.php" type="button" class="btn btn-primary btn-mini">Agregar un Nuevo Producto</a>
                            </p>        
                            </legend>
                        </div>
                        <table class="table table-striped " id="example">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                                    
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($rentas as $key => $value) :  $id_pro=$rentas[$key]["id_producto"]
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $rentas[$key]['nombre']?></td>
                                        <td><?php echo "$".$rentas[$key]['precio'].".00"?></td>
                                        <td> <img class="fotoUsuario" src="../img/comida/<?php echo  $rentas[$key]['imagen']?>" alt="user" class="img-thumbnail" ></td>
                                        
                                        <td><?php $status = $rentas[$key]["id_status"]; ?>
                        <?php if ( $status == 1 ) : $stt = 2; ?>
                        <a data-toggle="tooltip" title="Producto en venta" href="<?php echo "Actualizaciones.php?stt=2&p=".$id_pro?>" type="button" class="btn btn-success btn-mini">EnVenta</a>
                        <?php endif; if ( $status == 2 ) : $stt = 1;?>
                        <a data-toggle="tooltip" title="El producto no esta en Venta" href="<?php echo "Actualizaciones.php?stt=1&p=".$id_pro?>" type="button" class="btn btn-danger btn-mini">Cancelado</a>
                        <?php endif;?></td>
                                    
                                     </tr>
   
                               <?php endforeach;?> 
                              
                            </tbody>
                        </table>
                    
    
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>