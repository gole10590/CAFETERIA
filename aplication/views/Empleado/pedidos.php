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
$rentas = $admin->consulta_pedidos_activos();
$lista = $admin->lista_productos();
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
            <a href="<?php echo BASEURL . "views/Empleado/inicio.php" ?>" class="list-group-item">Inicio</a>

        </div>
        <!-- Termina Menu de Opciones -->
    </div>

    <div class="col-lg-9">


        <div class="page-header panel panel-default">            
            <div class="modal-content"><center><h2>LISTA DE PEDIDOS</h2></center></div>
            <div class="panel-body">
                <legend>

                    <h4 class="modal-open" > 
                        <center>  

                            <?php
                            $file = fopen("./Archivos_config/producto.txt", "r");
                            while (!feof($file)) {
                                echo fgets($file) . "<br />";
                            }
                            fclose($file);
                            ?>
                        </center>
                    </h4> 


                </legend>
            </div>
            <table class="table table-striped " id="example">
                <thead>
                    <tr>
                        <th>¿PREPARAR PEDIDO?</th>
                        <th>Lista de productos</th>
                        <th>COMENTARIO</th>
                        <th>STATUS</th>
                        <th>Total</th>
                        <th>ID_PEDIDO</th>

                        <th><center>¿Listo?</center></th>
                <th><center>¿Pagar?</center></th>
                <th><center>¿Cancelar?</center></th>
                </tr>
                </thead>

                <tbody>
                    <?php foreach ($rentas as $key => $value) : $id_pro = $rentas[$key]["id_pedido"]
                        ?>
                        <tr>
                            <td>
                                <?php $status = $rentas[$key]["id_estado_pedido"]; ?>
                                <?php if ($status == 1) : $stt = 2; ?>
                                    <a data-toggle="tooltip" title="Preparar productos" href="<?php echo "Actualizaciones.php?stt=" . $stt . "&id=ActStatus&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini">Procesar!!</a>
                                    <?php
                                endif;
                                ?>

                            </td>

                            <td>  
                                
                            </td>
                            <td>  
                                <?php echo $rentas[$key]['comentario'] ?>
                            </td>
                            <td><?php echo $rentas[$key]['status_pedido'] ?></td>
                            <td>
                                <?php echo $rentas[$key]['total'] ?>
                            </td>
                            <td><?php echo $rentas[$key]['id_pedido'] ?></td>

                            <td><?php $status = $rentas[$key]["id_estado_pedido"]; ?>
                                <?php if ($status == 2) : $stt = 3; ?>
                                    <a data-toggle="tooltip" title="Enviar correo" href="<?php echo "Actualizaciones.php?stt=" . $stt . "&id=email&em=".$rentas[$key]['email']."&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini">LISTO!!</a>
                                    <?php
                                endif;
                                ?>

                            </td>
                            <td><?php $status = $rentas[$key]["id_estado_pedido"]; ?>
                                <?php if ($status == 3) : $stt = 4; ?>
                              <a type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#<?php echo $rentas[$key]["id_pedido"] ?>" >PAGAR</a>
      
                              <?php
                                endif;
                                ?>

                            </td>
                            <td><?php $status = $rentas[$key]["id_estado_pedido"]; ?>
                                <?php if ($status == 3) : $stt = 5; ?>
                                    <a data-toggle="tooltip" title="cancelar entrega" href="<?php echo "Actualizaciones.php?stt=" . $stt . "&id=ActStatus&p=" . $id_pro ?>" type="button" class="btn btn-danger btn-mini">CANCELAR</a>
                                    <?php
                                endif;
                                ?>

                            </td>

                        </tr>


                 <!-- Modal -->
                    <div class="modal fade" id="<?php echo $rentas[$key]["id_pedido"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <center>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo "ESTA APUNTO DE PAGAR EL PEDIDO CON ID= <strong>" . $rentas[$key]['id_pedido'] . "</strong> " ?></h3>
                                    </center>
                                </div>
                                <div class="modal-content">                                          
                                       <div class="col-lg-9">
                                        <h5 class="modal-body" id="myModalLabel">  <?php echo "TOTAL : "."$". $rentas[$key]['total']."" ?><br/><br/> </h3> 
                                        </div>
                                    <div class="col-lg-9">
                                        <h5 class="modal-body" id="myModalLabel">  <?php echo "NUM. CUENTA : ". $rentas[$key]['id_usuario'] ?><br/><br/> </h3> 
                                        </div>
                                   <div class="col-lg-9">
                                        <h5 class="modal-body" id="myModalLabel">  <?php echo "NOMBRE CLIENTE : ". $rentas[$key]['nom']." ".$rentas[$key]['apaterno']." ".$rentas[$key]['amaterno'] ?><br/><br/> </h3> 
                                    </div>
                                 

                                </div>
                                <div class="modal-footer">

                                    <button data-toggle="tooltip" title="Cancelar" type="button" class="btn btn-danger btn-mini" data-dismiss="modal">Cancelar</button>
                                    <a data-toggle="tooltip" title="PAGAR" href="<?php echo "Actualizaciones.php?stt=4&id=ActStatus&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini">PAGAR</a>

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    <?php endforeach; ?> 

                </tbody>
            </table>


        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>