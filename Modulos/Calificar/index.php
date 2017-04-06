<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
	include_once "../class_buscar.php";
	
	if(!empty($_GET['salon'])){
		$id_salon=$_GET['salon'];
	}else{
		header('Location:error.php');
	}
	
	if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='p'){
		$profesor=limpiar($_SESSION['cod_user']);
		
		$pa=mysql_query("SELECT * FROM salon WHERE profesor='$profesor' and id='$id_salon'");				
		if($row=mysql_fetch_array($pa)){
			$oGrado=new Consultar_Grado($row['grado']);
			$nombre_salon=$oGrado->consultar('nombre').'.'.$row['nombre'];
		}else{
			header('Location:error.php');
		}
		
	}else{
		header('Location:error.php');
	}
	
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Listado de Alumnos</title>
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

    <?php include_once "../../menu/m_valorar.php"; ?>
	<div align="center">
    	<table width="90%">
          <tr>
            <td>
        		<table class="table table-bordered">
                  <tr class="info">
                    <td>
						<h2><img src="img/calificar.png" width="80" height="80">Listado de Alumnos Salon "<?php echo $nombre_salon; ?>"</h2>
                    </td>
                  </tr>
                </table> 
                
                <table class="table table-bordered">
                  <tr class="info">
                    <td width="15%"><strong>Codigo</strong></td>
                    <td colspan="2"><strong>Nombres</strong></td>
                  </tr>
                  <?php 
				  	$pa=mysql_query("SELECT * FROM alumnos WHERE salon='$id_salon' ORDER BY nombre");				
					while($row=mysql_fetch_array($pa)){
						$cod_alumno=$row['doc'];#5
						
				  ?>
                  <tr>
                  	<td><?php echo $row['doc']; ?></td>
                    <td width="80%">
                    	<a href="valorar.php?cod=<?php echo $cod_alumno; ?>" title="Valorar Alumno">
							<?php echo $row['nombre']; ?>
                        </a>
					</td>
                  </tr>  
                  <?php } ?>
                </table>   	
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
