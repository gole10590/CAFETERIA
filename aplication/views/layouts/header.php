<?php include $_SERVER['DOCUMENT_ROOT'] . '/CAFETERIA/aplication/config.ini.php'; ?>
<html lang="es">

    <head>

        <title>Cafeteria | Site</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/plain" rel="author" href="http://localhost/CAFETERIA/README.txt" />

        <!-- Bootstrap -->
        <link href="<?php echo BASEURL; ?>libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo BASEURL; ?>libs/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
        <script src="<?php echo BASEURL;?>libs/bootstrap/js/jquery.js"></script>        
        <script src="<?php echo BASEURL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
        <link href="<?php echo BASEURL; ?>libs/bootstrap/css/aplication.css" rel="stylesheet" media="screen">    
        <!-- Termina Bootstrap -->
     
        
                
    </head>

    <body>        

        
         <?php // CHECAR QUE LA SESION ESTE INICIADA
            if (isset($_SESSION['admin'])) { ?>
        
        
            <?php //Si esta iniciada checamos si es  ADMINISTRADOR --
            if ($_SESSION['admin']=="isAdmin") { ?>
            
                <div class="container" id="page">
                    <!-- NavBar -->
                    <div class="navbar navbar-fixed-top navbar-inverse">
                        <div class="container">
                            <a class="navbar-brand" href="inicio.php">CAFETERIA</a>                            
                            <ul class="nav navbar-nav pull-right">                                
                                <li><a>Administrador: </a></li>
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong><?php echo $_SESSION['email']?></strong><b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu">  
                                        
                                        
                            <!--       <li><a href="<?php echo BASEURL."views/site/MisVentas.php"; ?>">Mis Ventas</a></li>
                                        <li><a href="<?php echo BASEURL."views/site/MisRentas.php"; ?>">Mis Rentas</a></li>
                                        <!--<li><a href="<?php // echo "#"; ?>">Publicaciones</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo BASEURL."views/site/Configuracion.php"; ?>">Configuracion</a></li> -->
                                        
                                        
                                        <li><a href="<?php echo "../site/CerrarSession.php?id=Bye"; ?>">Salir</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                
                
                
                
                
                
                
            <?php } // USUARIO CLIENTE
            else if ($_SESSION['admin']=="isClient") { ?>
                
                    <div class="container" id="page">
                    <!-- NavBar -->
                    <div class="navbar navbar-fixed-top navbar-inverse">
                        <div class="container">
                            <a class="navbar-brand" href="inicio.php">
                                CAFETERIA</a>
                            <ul class="nav navbar-nav pull-right">
                                 <li><a>Cliente: </a></li>
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong><?php echo $_SESSION['email']?></strong><b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu">                                     
                                        
                               <!--         <li><a href="<?php echo BASEURL."views/site/MisVentas.php"; ?>">Mis Ventas</a></li>
                                        <li><a href="<?php echo BASEURL."views/site/MisRentas.php"; ?>">Mis Rentas</a></li>
                                        <!--<li><a href="<?php // echo "#"; ?>">Publicaciones</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo BASEURL."views/site/Configuracion.php"; ?>">Configuracion</a></li> -->
                                        
                                        
                                        <li><a href="<?php echo "../site/CerrarSession.php?id=Bye"; ?>">Salir</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /NavBar -->
                
                    <!-- Small button group -->

                    
                    
                    
                    
                    
                    
            <?php }
           
            else  { ?>
                
                    <div class="container" id="page">
                    <!-- NavBar -->
                    <div class="navbar navbar-fixed-top navbar-inverse">
                        <div class="container">
                            <a class="navbar-brand" href="inicio.php">
                                CAFETERIA</a>
                            <ul class="nav navbar-nav pull-right">
                                 <li><a>Empleado: </a></li>
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong><?php echo $_SESSION['email']?></strong><b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu">                                     
                                        
                               <!--         <li><a href="<?php echo BASEURL."views/site/MisVentas.php"; ?>">Mis Ventas</a></li>
                                        <li><a href="<?php echo BASEURL."views/site/MisRentas.php"; ?>">Mis Rentas</a></li>
                                        <!--<li><a href="<?php // echo "#"; ?>">Publicaciones</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo BASEURL."views/site/Configuracion.php"; ?>">Configuracion</a></li> -->
                                        
                                        
                                        <li><a href="<?php echo "../site/CerrarSession.php?id=Bye"; ?>">Salir</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /NavBar -->
                
                    <!-- Small button group -->

                    
                    
                    
                    
                    
            <?php } }
            
             // VISITANTE NO REGISTRADO-- 
            else { ?>
                    
                <div class="container" id="page">
                    <!-- NavBar -->
                    <div class="navbar navbar-fixed-top navbar-inverse">
                        <div class="container">
                            <a class="navbar-brand" href="Bienvenido.php">
                                CAFETERIA</a>
                            <ul class="nav navbar-nav pull-right">

                      <!--          <li><a href="<?php echo BASEURL; ?>views/site/Registro.php">Registrar</a></li> -->
                                <li><a href="<?php echo BASEURL; ?>views/site/Login.php">Entrar</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /NavBar -->
                    
                    
                    
                
            <?php } ?>
                        
