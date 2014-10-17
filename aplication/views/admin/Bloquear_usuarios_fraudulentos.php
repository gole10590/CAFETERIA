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
$rentas = $admin->consulta_all_usuarios_fraude();
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
            <a href="<?php echo BASEURL . "views/admin/Bloquear_usuarios.php" ?>" class="list-group-item">Bloqueo General de Usuarios</a>
            
        </div>
        <!-- Termina Menu de Opciones -->
    </div>

    <div class="col-lg-9">


        <div class="page-header panel panel-default">            
            <div class="modal-content"><center><h2>Bloqueo de Usuarios Fraudulentos</h2></center></div>
            <div class="panel-body">
                <legend>
                    <p>
                    <h4 class="modal-open"><center>
                            <?php
                            $file = fopen("./Archivos_config/bloqueo_user_fraude.txt", "r");
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
                        <th>Numero Ctrl</th>
                        <th>Nombre</th>
                       
                        <th>Email</th>

                        <th><center>Tipo Usuario</center></th>
                </tr>
                </thead>

                <tbody>
                    <?php foreach ($rentas as $key => $value) : $id_pro = $rentas[$key]["id_usuario"]
                        ?>
                        <tr>
                            
                            <td><?php echo $rentas[$key]['id_usuario'] ?></td>
                            <td><?php echo  $rentas[$key]['nombre'] ?></td>
                           
                            <td><?php echo  $rentas[$key]['email'] ?></td>
                            <td><?php echo  $rentas[$key]['tipo_user'] ?></td>
                            
                            <td><?php $status = $rentas[$key]["id_estado"]; ?>
                                <?php if ($status == 1) : $stt = 2; ?>
                                    <a data-toggle="tooltip" title="Usuario Activo" href="<?php echo "Actualizaciones.php?stt=".$stt."&id=ActEdoUser&p=" . $id_pro ?>" type="button" class="btn btn-success btn-mini"><?php echo $rentas[$key]["estado"]; ?></a>
                                <?php
                                endif;
                                if ($status == 2) : $stt = 1;
                                    ?>
                                    <a data-toggle="tooltip" title="Usuario Bloqueado" href="<?php echo "Actualizaciones.php?stt=".$stt."&id=ActEdoUser&p=" . $id_pro ?>" type="button" class="btn btn-danger btn-mini"><?php echo $rentas[$key]["estado"]; ?></a>
                                <?php endif; ?>
                            </td>

                        </tr>

                <?php endforeach; ?> 

                </tbody>
            </table>


        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>