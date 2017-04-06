<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
	include_once "../class_buscar.php";
	
	if(!empty($_GET['cod'])){
		$id_alumno=$_GET['cod'];
		$oAlumno=new Consultar_Alumno($id_alumno);	
		$nombre_alumno=$oAlumno->consultar('nombre');
	}else{
		header('Location:error.php');
	}
	function contar_nota($materia,$periodo,$alumno){
		$pa=mysql_query("SELECT COUNT(nombre)as numero FROM actividad WHERE estado='s'");				
		if($row=mysql_fetch_array($pa)){
			$act=$row['numero'];
		}
		
		$pa=mysql_query("SELECT COUNT(alumno)as numero FROM notas WHERE alumno='$alumno' and materia='$materia' and periodo='$periodo'");				
		if($row=mysql_fetch_array($pa)){
			return $row['numero'].' / '.$act;
		}
	}
	function promedio($materia,$periodo,$alumno){
		$promedio=0;
		$pa=mysql_query("SELECT COUNT(nombre)as numero FROM actividad WHERE estado='s'");				
		if($row=mysql_fetch_array($pa)){
			$act=$row['numero'];
		}
		$pa=mysql_query("SELECT * FROM notas WHERE alumno='$alumno' and materia='$materia' and periodo='$periodo'");				
		while($row=mysql_fetch_array($pa)){
			$promedio=$promedio+$row['valor'];
		}
		return $promedio/$act;
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title><?php echo $nombre_alumno; ?></title>
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
            	<?php 
					if(!empty($_POST['nota'])){
						$materia=limpiar($_POST['materia']);
						$nota=limpiar($_POST['nota']);
						$periodo=limpiar($_POST['periodo']);
						$actividad=limpiar($_POST['actividad']);
						$fecha=date('Y-m-d');
						
						$oActividad=new Consultar_Actividad($actividad);
						$oMateria=new Consultar_Materias($materia);
						$nactividad=$oActividad->consultar('nombre');
						$nmateria=$oMateria->consultar('nombre');
						if(empty($_POST['id'])){
							
							$pa=mysql_query("SELECT * FROM notas 
							WHERE alumno='$id_alumno' and materia='$materia' and periodo='$periodo' and actividad='$actividad'");				
							if($row=mysql_fetch_array($pa)){
								echo mensajes('Este Alumno ya fue valorado por la materia "'.$nmateria.'" en la Actividad "'.$nactividad.'"','rojo');
							}else{
								$oGuardar=new Proceso_Calificar('',$materia,$id_alumno,$actividad,$nota,$periodo,$fecha);
								$oGuardar->guardar();
								echo mensajes('Nota Registrada con Exito al Alumno "'.$nombre_alumno.'"<br>
								"'.$nmateria.'" Calificacion '.$nota.' En "'.$nactividad.'"','verde');
							}
						}
					}
				?>
            	<table class="table table-bordered">
                  <tr class="info">
                    <td><h2><img src="img/alumno.png" width="80" height="80"> <?php echo $id_alumno.' | '.$nombre_alumno; ?></h2></td>
                  </tr>
                </table>
              <div class="row-fluid">
                    <div class="span4">
                    	<div class="btn-group">
                        <button class="btn btn dropdown-toggle" data-toggle="dropdown">
                        	<i class="icon-search"></i> <strong>Periodo</strong> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <?php 
							$pa=mysql_query("SELECT * FROM periodo WHERE estado='s'");				
							while($row=mysql_fetch_array($pa)){
								$cod_alumno=$id_alumno;
								echo '<li><a href="valorar.php?cod='.$cod_alumno.'&periodo='.$row['id'].'">'.$row['nombre'].'</a></li>';
							}
						   ?>
                          <li><a href="valorar.php?cod=<?php echo $cod_alumno; ?>">Todos</a></li>
                          
                        </ul>
                      </div>
                    </div>
                    <div class="span4" align="center">
                    	<?php
							echo '<strong>Consuntando</strong><br>';
							if(!empty($_GET['periodo'])){
								$pe=limpiar($_GET['periodo']);
								$op=new Consultar_Periodo($pe);
								echo '<strong>'.$op->consultar('nombre').'</strong>';
							}else{
								echo '<strong>Todos los Periodos</strong>';
							}
						?>
                    </div>
                    <div class="span4" align="right">
                    	<a href="#nueva" role="button" class="btn" data-toggle="modal">
                    		<strong><i class="icon-list"></i> Ingresar Nueva Calificacion</strong>
                    	</a>
                    </div>
                </div>
                <br>
                <table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td width="19%"><center><strong>Materia</strong></center></td>
                    <td width="27%"><center><strong>Calificacion</strong></center></td>
                    <td width="38%"><center><strong>Periodo</strong></center></td>
                    <td width="10%"><center><strong>N. Valoracion</strong></center></td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <?php 
				 	if(!empty($_GET['periodo'])){
				  		$id_periodo=limpiar($_GET['periodo']);
						$pa=mysql_query("SELECT * FROM notas WHERE alumno='$id_alumno' and periodo='$id_periodo' group by alumno, materia");
					}else{
						$pa=mysql_query("SELECT * FROM notas WHERE alumno='$id_alumno' group by alumno, periodo, materia");					
					}
					while($row=mysql_fetch_array($pa)){
						$oMateria=new Consultar_Materias($row['materia']);
						$oPeriodo=new Consultar_Periodo($row['periodo']);
				  ?>
                  <tr>
                    <td><center><?php echo $oMateria->consultar('nombre'); ?></center></td>
                    <td><center><?php echo formato(promedio($row['materia'],$row['periodo'],$row['alumno'])); ?></center></td>
                    <td><center><?php echo $oPeriodo->consultar('nombre'); ?></center></td>
                    <td><center><?php echo contar_nota($row['materia'],$row['periodo'],$row['alumno']); ?></center></td>
                    <td>
                    	<center>
                            <a href="#m<?php echo $row['periodo'].$row['materia']; ?>" role="button" class="btn btn-mini" title="Detalle de Calificaciones" data-toggle="modal">
                                <i class="icon-list"></i>
                            </a>
                        </center>
                         <div id="m<?php echo $row['periodo'].$row['materia']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel" align="center">
                                    Materia "<?php echo $oMateria->consultar('nombre'); ?>"<br>Periodo <?php echo $oPeriodo->consultar('nombre'); ?>
                                </h3>
                            </div>
                            <div class="modal-body">
            					<table class="table table-bordered table table-hover">
                                  <tr class="well">
                                    <td><strong><center>Actividad</center></strong></td>
                                    <td><strong><center>Valoracion</center></strong></td>
                                  </tr>
                                  <?php 
								  	$paa=mysql_query("SELECT * FROM notas 
									WHERE alumno='".$row['alumno']."' and periodo='".$row['periodo']."' and materia='".$row['materia']."'");					
									while($dato=mysql_fetch_array($paa)){
										$oAct=new Consultar_Actividad($dato['actividad']);
								  ?>
                                  <tr>
                                    <td><center><?php echo $oAct->consultar('nombre'); ?></center></td>
                                    <td><center><?php echo $dato['valor']; ?></center></td>
                                  </tr>
                                  <?php } ?>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong></button>
                            </div>
                        </div>
                    </td>
                  </tr>   
                  <?php } ?>
                </table>
            </td>
          </tr>
        </table>
	</div>
    <div id="nueva" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<form name="form1" method="post" action="">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel" align="center">Ingresa Nueva Calificacion<br>"<?php echo $nombre_alumno; ?>"</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span6">
					<strong>Actividad</strong><br>
                    <select name="actividad">
                    	<?php 
							$pa=mysql_query("SELECT * FROM actividad WHERE estado='s'");				
							while($row=mysql_fetch_array($pa)){
								echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
							}
						?>
                    </select><br>
                    <strong>Periodo</strong><br>
                    <select name="periodo">
                    	<?php 
							$pa=mysql_query("SELECT * FROM periodo WHERE estado='s'");				
							while($row=mysql_fetch_array($pa)){
								echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
							}
						?>
                    </select>
                </div>
                <div class="span6">
                	<strong>Materia</strong><br>
                    <select name="materia">
                    	<?php 
							$pa=mysql_query("SELECT * FROM materia WHERE estado='s'");				
							while($row=mysql_fetch_array($pa)){
								echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
							}
						?>
                    </select><br>
                    <strong>Valoracion</strong><br>
                    <input type="number" min="<?php echo $minima_nota; ?>" max="<?php echo $maxima_nota; ?>" value="1" name="nota" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Registrar</strong></button>
        </div>
        </form>
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
