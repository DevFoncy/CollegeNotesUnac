<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Informacion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../../ico/favicon.png">
  </head>
  <!-- FACEBOOK COMENTARIOS -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- FIN CODIGO FACEBOOK -->
  <body>

    <?php include_once "../../menu/m_datos.php"; ?>
    <div align="center">
    <table width="90%">
  		<tr>
        	<td>
            	<div align="center" class="alert alert-info">
                	<h1 class="text-info">Administrar Informacion de la Escuela</h1>
                </div><br>
    			<div class="row-fluid">
                    <div class="span4">
                    	<div class="thumbnail" align="center">
                        	<img src="img/materia.png" width="250" height="250"><br>
                            <a href="materia.php" class="btn btn-info btn-large"><strong>Administrar Materias</strong></a><br><br>
                            <?php 
								$pa=mysql_query("SELECT count(id)as numero FROM materia");									
								if($row=mysql_fetch_array($pa)){
									echo '<p align="center">'.$row['numero'].' Materias Registradas</p>';
								}
							?>
                        </div>
                        <br><br>
                        <div class="thumbnail" align="center">
                        	<img src="img/empresa.png" width="250" height="250"><br>
                            <a href="empresa.php" class="btn btn-info btn-large"><strong>Informacion Empresa</strong></a><br><br>
                            <?php
                            	$pa=mysql_query("SELECT fecha FROM empresa WHERE id=1");									
								if($row=mysql_fetch_array($pa)){
									echo '<p align="center">Ultima Actualizacion '.fecha($row['fecha']).'</p>';
								}
							?>
                        </div>
                        
                    </div>
                    <div class="span4">
                    	<div class="thumbnail" align="center">
                        	<img src="img/grado.png" width="250" height="250"><br>
                            <a href="grado.php" class="btn btn-info btn-large"><strong>Administrar Grados</strong></a><br><br>
                            <?php 
								$pa=mysql_query("SELECT count(id)as numero FROM grado");									
								if($row=mysql_fetch_array($pa)){
									echo '<p align="center">'.$row['numero'].' Grados Registrados</p>';
								}
							?>
                        </div>
                    </div>
                    <div class="span4">
                    	<div class="thumbnail" align="center">
                        	<img src="img/salon.png" width="250" height="250"><br>
                            <a href="salon.php" class="btn btn-info btn-large"><strong>Administrar Salones</strong></a><br><br>
                            <?php 
								$pa=mysql_query("SELECT count(id)as numero FROM salon");									
								if($row=mysql_fetch_array($pa)){
									echo '<p align="center">'.$row['numero'].' Salones Registrados</p>';
								}
							?>
                        </div>
                    </div>
                </div>    
        	</td>
      	</tr>
    </table>
    </div>

	
    <!-- Le javascript ../../js/jquery.js
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap-transition.js"></script>
    <script src="../../js/bootstrap-alert.js"></script>
    <script src="../../js/bootstrap-modal.js"></script>
    <script src="../../js/bootstrap-dropdown.js"></script>
    <script src="../../js/bootstrap-scrollspy.js"></script>
    <script src="../../js/bootstrap-tab.js"></script>
    <script src="../../js/bootstrap-tooltip.js"></script>
    <script src="../../js/bootstrap-popover.js"></script>
    <script src="../../js/bootstrap-button.js"></script>
    <script src="../../js/bootstrap-collapse.js"></script>
    <script src="../../js/bootstrap-carousel.js"></script>
    <script src="../../js/bootstrap-typeahead.js"></script>

  </body>
</html>
