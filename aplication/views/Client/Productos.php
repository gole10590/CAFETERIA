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

            <br/>
            <div class="table">            
                <div class="panel-heading"><center><h4>Pedidos Pendientes</h4></center></div>
                <?php $Pedidos = $admin->consulta_pedidos_pendientes($_SESSION['id_usuario']); ?>

                <table class="tag" id="example">
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Estatus</th>
                            <th>Accion</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($Pedidos as $key => $value) : $id_ped = $Pedidos[$key]["id_pedido"]
                            ?>
                            <tr>
                                <td><?php echo $Pedidos[$key]['id_pedido'] ?></td>
                                <td><?php echo $Pedidos[$key]['status_pedido'] ?></td>
                                <td>

                                    <?php $status = $Pedidos[$key]["id_estado_pedido"]; ?>
                                    <?php if ($status == 1) : ?>
                                        <a type="button" class="btn btn-danger btn-mini" data-toggle="modal" data-target="#<?php echo $Pedidos[$key]["id_pedido"] ?>" >Cancelar</a>
                                        <?php
                                    endif;
                                    ?>

                                    <?php $status = $Pedidos[$key]["id_estado_pedido"]; ?>
                                    <?php if ($status == 2 || $status == 3) : ?>
                                        <a type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#<?php echo $Pedidos[$key]["id_pedido"] . $_SESSION['nombre'] ?>" >Verificar</a>
                                        <?php
                                    endif;
                                    ?>

                                </td>



                            </tr>





                            <!-- Cancelar pedido -->
                        <div class="modal fade" id="<?php echo $Pedidos[$key]["id_pedido"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <center>
                                            <h3 class="modal-title" id="myModalLabel"><?php echo "¿Está seguro que desea eliminar su pedido?" ?></h3>
                                        </center>
                                    </div>

                                    <div class="modal-body">
                                        <h4 class="modal-open" >  
                                            <?php $lista = $admin->lista_productos($Pedidos[$key]["id_pedido"]) ?>  
                                            <?php
                                            foreach ($lista as $elemento) {
                                                echo "CANTIDAD= " . $elemento['cantidad'] . ",   Nombre: " . $elemento['nombre'] . ",  Precio/Unitario: $" . $elemento['precio'] . '</br></br>';
                                            }
                                            ?>

                                        </h4> 

                                        <h4 class="modal-open" >  
                                            <?php $TOTAL = $admin->total_pedido($Pedidos[$key]["id_pedido"]) ?>  
                                            <?php
                                            echo "TOTAL A PAGAR: $" . $TOTAL[0][0] . ".00" . '</br></br>';
                                            ?>

                                        </h4>  

                                    </div>

                                    <div class="modal-footer">


                                        <button data-toggle="tooltip" title="Volver atras" type="button" class="btn btn-danger btn-mini" data-dismiss="modal">Volver Atras</button>
                                        <a data-toggle="tooltip" title="Cancelar Pedido" href="<?php echo "Add_product_pedido.php?id=ActStatus&stt=5&p=" . $id_ped ?>" type="button" class="btn btn-success btn-mini">Cancelar pedido</a>

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->


                        <!-- VERIFICAR CONTENIDO DEL PEDIDO -->
                        <div class="modal fade" id="<?php echo $Pedidos[$key]["id_pedido"] . $_SESSION['nombre'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <center>
                                            <h3 class="modal-title" id="myModalLabel"><?php echo "Listado del contenido del pedido." ?></h3>
                                        </center>
                                    </div>

                                    <div class="modal-body">
                                        <h4 class="modal-open" >  
                                            <?php $lista = $admin->lista_productos($Pedidos[$key]["id_pedido"]) ?>  
                                            <?php
                                            foreach ($lista as $elemento) {
                                                echo "CANTIDAD= " . $elemento['cantidad'] . ",   Nombre: " . $elemento['nombre'] . ",  Precio/Unitario: $" . $elemento['precio'] . '</br></br>';
                                            }
                                            ?>

                                        </h4> 

                                        <h4 class="modal-open" >  
                                            <?php $TOTAL = $admin->total_pedido($Pedidos[$key]["id_pedido"]) ?>  
                                            <?php
                                            echo "TOTAL A PAGAR: $" . $TOTAL[0][0] . ".00" . '</br></br>';
                                            ?>

                                        </h4> 

                                        <h4 class="modal-open" >  

                                            <?php
                                            $STATUS = $admin->status_pedido($Pedidos[$key]["id_pedido"])
                                            ?>
                                            <?php
                                            if ($STATUS[0][0] == 3) :

                                                echo "Su pedido ya esta listo para recoger, por favor dirijase a la cafeteria lo mas pronto posible para pagar y recoger su pedido." . '</br></br>';
                                                ?>
                                                <?php
                                            endif;
                                            ?>


                                        </h4>

                                    </div>

                                    <div class="modal-footer">


                                        <button data-toggle="tooltip" title="Volver atras" type="button" class="btn btn-danger btn-mini" data-dismiss="modal">Volver Atras</button>

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->


                    <?php endforeach; ?> 

                    </tbody>
                    <tfoot>

                    </tfoot>

                </table>


            </div>
        </div>
        <!-- Termina Menu de Opciones -->
         <!-- Termina Menu de Opciones -->
          <!-- Termina Menu de Opciones -->
           <!-- Termina Menu de Opciones -->
        
        
        
    </div>
    <!--VERIFICAR QUE EL USUARIO NO TENGA MAS DE 3 PEDIDOS PENDIENTES-->
    <?php
    $CANTIDAD_PEDIDOS = $admin->cantidad_pedidos_usuario($_SESSION['id_usuario']);
    if ($CANTIDAD_PEDIDOS[0][0] < 3) {
        ?>
<!--SI TIENE MENOS DE 3 PEDIDOS ENTONCES REALIZA LO SIGUIENTE-->
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

                <!-- SI EL ARCHIVO DE DETALLE_DE_PEDIDO EXISTE ENTONCES HAY QUE CHECAR CUALES PRODUCTOS YA ESTAN EN EL PEDIDO   -->
                <?php if (file_exists("./Archivos_config/" . $_SESSION['id_usuario'] . ".txt")) { ?>


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
<!--verificar si el id_producto ya se encuentra en el archivo asea en el carrito del pedido.-->
                                        <?php
                                        $bandera = FALSE;
                                        $file = fopen("./Archivos_config/" . $_SESSION['id_usuario'] . ".txt", "r");
                                        while (!feof($file)) {
                                            $linea = fgets($file);


                                            if ($linea != "") {
                                                $tok = strtok($linea, " ");
                                                $id_producto = $tok;
                                                if ($id_producto == $rentas[$key]["id_producto"]) {
                                                    $bandera = TRUE;
                                                }

                                                while ($tok !== false) {
                                                    $tok = strtok(" ");
                                                    if ($tok !== false) {
                                                        $cantidad = $tok;
                                                    }
                                                }
                                            }
                                        }
                                        fclose($file);
                                        ?>  
                                        <?php if ($bandera) { ?>
                                            <a type="button" class="btn btn-warning btn-mini" data-toggle="modal" data-target="#<?php echo $rentas[$key]["id_producto"] . $_SESSION['nombre'] ?>" >Quitar del pedido</a>

                                        <?php } else { ?> 
                                            <a type="button" class="btn btn-success btn-mini" data-toggle="modal" data-target="#<?php echo $rentas[$key]["id_producto"] ?>" >Agregar al pedido</a>

                                        <?php } ?> 

                                    </td>
                                    <td><?php echo $rentas[$key]['nombre'] ?></td>
                                    <td><?php echo "$" . $rentas[$key]['precio'] . ".00" ?></td>
                                    <td><?php echo $rentas[$key]['descripcion'] ?></td>
                                    <td><img data-toggle="tooltip"   class="fotoUsuario" src="../img/comida/<?php echo $rentas[$key]['imagen'] ?>" alt="user" class="img-thumbnail" ></a> </td>



                                </tr>




                                <!-- Modal QUITAR PRODUCTO DEL PEDIDO -->
                            <div class="modal fade" id="<?php echo $rentas[$key]["id_producto"] . $_SESSION['nombre'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <center>
                                                <h3 class="modal-title" id="myModalLabel"><?php echo "¿Está seguro que desea quitar  <strong>" . $rentas[$key]["nombre"] . "</strong> del pedido?" ?></h3>
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



                                            <button data-toggle="tooltip" title="Volver atras" type="button" class="btn btn-success btn-mini" data-dismiss="modal">Volver atras</button>
                                            <a data-toggle="tooltip" title="Quitar del pedido" href="<?php echo "Add_product_pedido.php?id=QuiProd&nombre=" . $_SESSION['id_usuario'] . "&p=" . $id_pro ?>" type="button" class="btn btn-danger btn-mini">Quitar de pedido</a>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <!-- Modal Agregar producto al carrito -->
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
                                                </form>

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
                                            <a data-toggle="tooltip" title="Agregar al pedido" href="<?php echo "Add_product_pedido.php?id=AddProd&nombre=" . $_SESSION['id_usuario'] . "&cantidad=1&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini">Agregar</a>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->




                            <!-- Modal Generar Pedido-->
                            <div class="modal fade" id="<?php echo $rentas[$key]["id_producto"] . $rentas[$key]["nombre"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <center>
                                                <h3 class="modal-title" id="myModalLabel"><?php echo "¿Está seguro que desea generar su  pedido?" ?></h3>
                                            </center>
                                        </div>
                                        <div class="modal-content">                                          
                                            <div class="col-lg-3">
                                            </div>
                                            <div class="col-lg-9">
                                                <h6 class="modal-body" id="myModalLabel">  <?php echo "Una vez generado su pedido, se procesara en un tiempo estimado de 20 minutos, se le notificara via email cuando su pedido este listo para recoger." ?><br/><br/> </h6> 

                                            </div>


                                        </div>
                                        <div class="modal-footer">

                                            <button data-toggle="tooltip" title="Cancelar" type="button" class="btn btn-danger btn-mini" data-dismiss="modal">Cancelar</button>
                                            <a data-toggle="tooltip" title="Generar Pedido"  href="<?php echo "Add_product_pedido.php?&coment=sin comentarios&nombre=" . $_SESSION['id_usuario'] . "&id=Insert&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini">Generar Pedido</a>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        <?php endforeach; ?> 

                        </tbody>
                        <tfoot>
                            <!--verificar si el archivo existe para mostrarle el boton de generar pedido-->
                            <?php if (file_exists("./Archivos_config/" . $_SESSION['id_usuario'] . ".txt")) { ?>
                                <!--si el archivo existe hay que verificar que no este vacio-->


                            <a type = "button" class = "btn btn-primary btn-mini" data-toggle = "modal" data-target = "#<?php echo $rentas[$key]["id_producto"] . $rentas[$key]["nombre"] ?>" >Generar Pedido</a>

                        <?php } ?>

                        </tfoot>

                    </table>
              <!--CIERRE DEL IF QUE-->
                <?php } else { ?>
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





                                <!-- Modal Agregar producto al carrito -->
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
                                            <a data-toggle="tooltip" title="Agregar al pedido" href="<?php echo "Add_product_pedido.php?id=AddProd&nombre=" . $_SESSION['id_usuario'] . "&cantidad=1&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini">Agregar</a>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->




                            <!-- Modal Generar Pedido-->
                            <div class="modal fade" id="<?php echo $rentas[$key]["id_producto"] . $rentas[$key]["nombre"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <center>
                                                <h3 class="modal-title" id="myModalLabel"><?php echo "¿Está seguro que desea generar su  pedido?" ?></h3>
                                            </center>
                                        </div>
                                        <div class="modal-content">                                          

                                            <div class="col-lg-9">
                                                <h6 class="modal-body" id="myModalLabel">  <?php echo "Una vez generado su pedido, se procesara en un tiempo estimado de 20 minutos, se le notificara via email cuando su pedido este listo para recoger." ?><br/><br/> </h6> 
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="search-q2" name="texto"><br>
                                            </div>

                                        </div>
                                        <div class="modal-footer">

                                            <button data-toggle="tooltip" title="Cancelar" type="button" class="btn btn-danger btn-mini" data-dismiss="modal">Cancelar</button>
                                            <a data-toggle="tooltip" title="Generar Pedido"  href="<?php echo "Add_product_pedido.php?&coment=sin comentarios&nombre=" . $_SESSION['id_usuario'] . "&id=Insert&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini">Generar Pedido</a>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        <?php endforeach; ?> 

                        </tbody>
                        <tfoot>

                            <?php if (file_exists("./Archivos_config/" . $_SESSION['id_usuario'] . ".txt")) { ?>
                            <a type = "button" class = "btn btn-primary btn-mini" data-toggle = "modal" data-target = "#<?php echo $rentas[$key]["id_producto"] . $rentas[$key]["nombre"] ?>" >Generar Pedido</a>
                        <?php } ?>

                        </tfoot>

                    </table>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?> 
        <!--    ESTO SE REALIZARA SI EL ALUMNO NO TIENE MAS DE 3 PEDIDOS PENDIENTES-->

        <div class="col-lg-9">


            <div class="page-header panel panel-default">            
                <div class="panel-heading"><center><h2>¡¡Por el momento no puedes generar mas pedidos!!</h2></center></div>
                <div class="panel-body">
                    <legend>
                        <p>
                        <h5><center>
                                <?php
                                $file = fopen("./Archivos_config/exceso_pedidos.txt", "r");
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

            </div>
        </div>


        <?php
    }
    ?> 
</div>

<?php include '../layouts/footer.php'; ?>