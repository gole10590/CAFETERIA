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
            <a href="<?php echo BASEURL . "views/admin/.php" ?>" class="list-group-item">Total de ventas</a>
            <a href="<?php echo BASEURL . "views/admin/.php" ?>" class="list-group-item active">Productos vendidos</a>
            
        </div>
        <!-- Termina Menu de Opciones -->
    </div>

    <div class="col-lg-9">
               
        
        <div class="page-header panel panel-default">            
                <div class="panel-heading"><center><h2>Estadistica de Venta</h2></center></div>
                        <div class="panel-body">
                            <legend>
                            <p>
                                <h5>
                                    <center> En este apartado podra vizualizar las compras realizadas e información de los pedidos. </center>
                                </h5>                
                                
                            </p>        
                            </legend>
                        </div>
                        <table class="table table-striped " id="example">
                            <thead>
                                <tr>
                               
                                                             
                                                   
                                   
                                </tr>
                            </thead>

                            <tbody>
                                
                                    <tr>
                                        
                                    
                                     </tr>
   
                               
                              
                            </tbody>
                        </table>
                    
    
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>