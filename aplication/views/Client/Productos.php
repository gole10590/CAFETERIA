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

include ('../../controllers/siteController/Desconexion_usuario.php');

$rentas = $admin->consulta_productosClient();
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
            <a href="<?php echo BASEURL . "views/Client/inicio.php" ?>" class="list-group-item">Menu</a>

        </div>
        <!-- Termina Menu de Opciones -->
    </div>

    <div class="col-lg-9">


        <div class="page-header panel panel-default">            
            <div class="panel-heading"><center><h2>Productos en Venta</h2></center></div>
            <div class="panel-body">
                <legend>
                    <p>
                    <h5><center>
                            <?php
                            $file = fopen("./Archivos_config/producto.txt", "r");
                            while (!feof($file)) {
                                echo fgets($file) . "<br />";
                            }
                            fclose($file);
                            ?>
                        </center>
                    </h5> 

                    </p>        
                </legend>
            </div>
            <table class="table table-striped " id="example">
                <thead>
                    <tr>
                        <th>¿Agregar a pedido?</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripcion</th>
                        <th>Imagen</th>


                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rentas as $key => $value) : $id_pro = $rentas[$key]["id_producto"]
                        ?>
                        <tr>
                            <td>
                                <a type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#<?php echo $rentas[$key]["id_producto"] ?>" >Agregar al pedido</a>

                            </td>
                            <td><?php echo $rentas[$key]['nombre'] ?></td>
                            <td><?php echo "$" . $rentas[$key]['precio'] . ".00" ?></td>
                            <td><?php echo $rentas[$key]['descripcion'] ?></td>
                            <td><img data-toggle="tooltip"  class="fotoUsuario" src="../img/comida/<?php echo $rentas[$key]['imagen'] ?>" alt="user" class="img-thumbnail" ></a> </td>



                        </tr>





                        <!-- Modal -->
                    <div class="modal fade" id="<?php echo $rentas[$key]["id_producto"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <center>
                                        <h3 class="modal-title" id="myModalLabel"><?php echo "¿Está seguro que desea agregar  <strong>" . $rentas[$key]["nombre"] . "</strong> al pedido?" ?></h3>
                                    </center>
                                </div>
                                <div class="modal-content">                                          
                                    <div class="col-lg-3">
                                        <img class="fotoComida" src="<?php echo BASEURL . "views/img/comida/" . $rentas[$key]["imagen"] ?>" />                                              
                                    </div>
                                    <div class="col-lg-9">
                                        <h3 class="modal-body" id="myModalLabel">  <?php echo $rentas[$key]["descripcion"] ?><br/><br/> </h3> 
                                    </div>

                                </div>
                                <div class="modal-footer">

                                    <h3 class="modal-footer" id="myModalLabel"><?php echo "Cantidad de productos:" ?>

                                        <select class="modal-content" id="cantidad"  name="cantida_prod">
                                            <option value="1" selected="selected">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>

                                    </h3>


                                  
                                    <button data-toggle="tooltip" title="Cancelar" type="button" class="btn btn-danger btn-mini" data-dismiss="modal">Cancelar</button>
                                    <a data-toggle="tooltip" title="Agregar al pedido" href="<?php echo "Add_product_pedido.php?id=AddProd&nombre=".$_SESSION['id_usuario']."&cantidad=8&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini">Agregar</a>

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                <?php endforeach; ?> 

                </tbody>
                <tfoot>


                <a data-toggle="tooltip" title="Agregar al pedido"  href="<?php echo "Add_product_pedido.php?&nombre=".$_SESSION['id_usuario']."&id=Insert&p=" . $id_pro ?>" type="button" class="btn btn-primary btn-mini">Generar Pedido</a>

                </tfoot>

            </table>


        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>