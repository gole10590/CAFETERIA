<?php include $_SERVER['DOCUMENT_ROOT'] . '/CAFETERIA/aplication/config.ini.php'; ?>
<html lang="es">

    <head>

        <title>CAFETERIA | Site</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/plain" rel="author" href="http://localhost/CAFETERIA/Team.txt" />

        <!-- Bootstrap -->
        <link href="<?php echo BASEURL; ?>libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo BASEURL; ?>libs/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
        <script src="<?php echo BASEURL;?>libs/bootstrap/js/jquery.js"></script>        
        <script src="<?php echo BASEURL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Termina Bootstrap -->
        
                
    </head>

    <body>        

            <?php // ADMINISTRADOR --
            if (isset($_SESSION['admin'])) { ?>
            
                <div class="container" id="page">
                    <!-- NavBar -->
                    <div class="navbar navbar-fixed-top navbar-inverse">
                        <div class="container">
                            <a class="navbar-brand" href="Bienvenido.php">CAFETERIA</a>                            
                            <ul class="nav navbar-nav pull-right">                                
                                <li><a>Administrador: </a></li>
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong><?php echo $_SESSION['correo']?></strong><b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu">                                        
                                      <!--  <li><a href="<?php echo BASEURL."views/site/MisVentas.php"; ?>">Mis Ventas</a></li>
                                        <li><a href="<?php echo BASEURL."views/site/MisRentas.php"; ?>">Mis Rentas</a></li> -->
                                        
                                        <!--<li><a href="<?php // echo "#"; ?>">Publicaciones</a></li>-->
                                        <li class="divider"></li>
                                        
                                       <!-- <li><a href="<?php echo BASEURL."views/site/Configuracion.php"; ?>">Configuracion</a></li> -->
                                        <li><a href="<?php echo "../site/CerrarSession.php?id=Bye"; ?>">Salir</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                
                
                
                
                
                
                
            <?php } // USUARIO ESTANDAR
            else if (isset($_SESSION['id_usuario'])) { ?>
                
                    <div class="container" id="page">
                    <!-- NavBar -->
                    <div class="navbar navbar-fixed-top navbar-inverse">
                        <div class="container">
                            <a class="navbar-brand" href="Bienvenido.php">
                                CAFETERIA</a>
                            <ul class="nav navbar-nav pull-right">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong><?php echo $_SESSION['correo']?></strong><b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu">                                        
                                    <!--    <li><a href="<?php echo BASEURL."views/site/MisVentas.php"; ?>">Mis Ventas</a></li>
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

                    
                    
                    
                    
                    
                    
            <?php } // VISITANTE --
            else { ?>
                    
                <div class="container" id="page">
                    <!-- NavBar -->
                    <div class="navbar navbar-fixed-top navbar-inverse">
                        <div class="container">
                            <a class="navbar-brand" href="Bienvenido.php">
                                CAFETERIA
                            </a>
                            <ul class="nav navbar-nav pull-right">

                              <!--  <li><a href="<?php echo BASEURL; ?>views/site/Registro.php">Registrar</a></li> -->
                                <li><a href="<?php echo BASEURL; ?>views/site/Login.php">Entrar</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /NavBar -->
                    
                    
                    
                
            <?php } ?>
<?php

session_start();
unset($_SESSION);
session_destroy();
//header("location: Bienvenido.php");
$id=$_GET["id"];
?>
    <script LANGUAGE="JavaScript">
        var pagina = "Bienvenido.php"
        function redireccionar()
        {
            location.href = pagina
        }
        setTimeout("redireccionar()", 3000);
    </script>

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-1993916-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
    
    <style type="text/css">
        html { -ms-text-size-adjust: none; }
        body {
            background: #ccc;
            padding: 25% 0 0 0;
            margin: 0;
            font-family: sans-serif;
        }
        h1 {
            font: 48pt Georgia,serif; 
            line-height: 48pt;
            text-align: center;
            letter-spacing: -0.05em;
            margin: -24pt 0 0 0;
            padding: 0;
            -ms-text-size-adjust: auto;
        }
        .dot { color: cadetblue; }        
        @media all and (max-width: 800px) {
            h1 {
                font: 24pt Georgia, serif;
                padding-top: 50%;
            }
        }
    </style>


    <h1><span class="dot">::</span><em> CAFETERIA </em><span class="dot">::</span>&nbsp; </h1>
    <?php if ($id == "Config") :?>
    <br/><center><h3>Inicia Session Para Verificar Tus Datos</h3></center><br/><br/>
    <?php endif;    if ($id == "Bye"): ?>
    <br/><center>Se ha Cerrado Session Correctamente</center>
    <?php endif;?>



        </div><!-- Container-->
                    
    </body>

</html>
