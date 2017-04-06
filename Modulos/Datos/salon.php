<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../class_buscar.php";
	include_once "../funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Salones</title>
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
    	<table width="90%" >
          <tr>
            <td>
            	<a href="index.php" class="text-info"><i class="icon-fast-backward"></i> <strong>Regresar</strong></a>
            	<table class="table table-bordered">
                  <tr class="info">
                    <td>
                    
                    	<div class="row-fluid">
                            <div class="span6">
                            	<h2 class="text-info">
                                    <img src="img/salon.png" width="80" height="80">
                                    Control de Salones
                                </h2>
                            </div>
                            <div class="span6">
                            	<form name="form1" method="post" action="">
                                	<div class="input-append">
                                	<input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Salon">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                          	    </form>
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                	<strong><i class="icon-plus"></i> Ingresar Nuevo Salon</strong>
                                </a>
                                
                                <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                	<form name="form1" method="post" action="">
                                    <div class="modal-header">
    	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                                    <h3 id="myModalLabel">Ingresar Nuevo Salon</h3>
                                    </div>
                                    <div class="modal-body">
										<div class="row-fluid">
                                            <div class="span6">
                                            	<strong>Nombre del Salon</strong><br>
                                                <input type="text" name="nombre" autocomplete="off" required value=""><br>
                                                <strong>Grado</strong><br>
                                                <select name="grado">
                                                	<?php
														$sal=mysql_query("SELECT * FROM grado WHERE estado='s'");				
														while($col=mysql_fetch_array($sal)){
															echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';
														}
													?>
                                                </select>
                                            </div>
                                            <div class="span6">
                                            	<strong>Encargado</strong><br>
                                                <select name="profesor">
                                                	<?php
														$sl=mysql_query("SELECT * FROM profesor WHERE estado='s'");				
														while($cl=mysql_fetch_array($sl)){
															echo '<option value="'.$cl['doc'].'">'.$cl['ape'].' '.$cl['nom'].'</option>';
														}
													?>
                                                </select><br>
                                                <strong>Estado</strong><br>
                                                <select name="estado">
                                                	<option value="s">Activo</option>
                                                    <option value="n">No Activo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                                        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                  </tr>
				</table>
            </td>
          </tr>
        </table>
        <?php 
			if(!empty($_POST['nombre'])){
				$nombre=limpiar($_POST['nombre']);	$profesor=limpiar($_POST['profesor']);
				$grado=limpiar($_POST['grado']);	$estado=limpiar($_POST['estado']);
				
				if(empty($_POST['id'])){
					$oSalon=new Proceso_Salon('',$nombre,$profesor,$grado,$estado);
					$oSalon->guardar();
					echo mensajes('El Salon "'.$nombre.'" Ha sido Guardado con Exito','verde');
				}else{
					$id=limpiar($_POST['id']);
					$oSalon=new Proceso_Salon($id,$nombre,$profesor,$grado,$estado);
					$oSalon->actualizar();
					echo mensajes('El Salon "'.$nombre.'" Ha sido Actualizado con Exito','verde');
				}
			}
		?>
        <table width="90%" >
          <tr>
            <td>
            	<table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td width="11%"><center><strong class="text-info">Codigo Salon</strong></center></td>
                    <td width="23%"><strong class="text-info">Nombre del Salon</strong></td>
                    <td width="12%"><center><strong class="text-info">Grado</strong></center></td>
                    <td width="37%"><strong class="text-info">Encargado</strong></td>
                    <td width="13%"><center><strong class="text-info">Estado</strong></center></td>
                    <td width="4%">&nbsp;</td>
                  </tr>
                  <?php
				  	if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pa=mysql_query("SELECT * FROM salon WHERE nombre LIKE '%$buscar%' or id='$buscar'");					
					}else{
						$pa=mysql_query("SELECT * FROM salon");				
					}
					while($row=mysql_fetch_array($pa)){
						$oGrado=new Consultar_Grado($row['grado']);
						$oProfesor=new Consultar_Profesor($row['profesor']);
				  ?>
                  <tr>
                    <td><center><?php echo $row['id']; ?></center></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><center><?php echo $oGrado->consultar('nombre'); ?></center></td>
                    <td><?php echo $oProfesor->consultar('ape').' '.$oProfesor->consultar('nom'); ?></td>
                    <td><center><?php echo estado($row['estado']); ?></center></td>
                    <td>
                    	<center>
                        	<a href="#a<?php echo $row['id']; ?>" title="Editar Salon" role="button" class="btn btn-mini" data-toggle="modal">
                            	<i class="icon-edit"></i>
                            </a>
                        </center>
                        
                        <div id="a<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <form name="form1" method="post" action="">
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 id="myModalLabel">Actualizar Salon</h3>
                          </div>
                          <div class="modal-body">
                              <div class="row-fluid">
                                  <div class="span6">
                                      <strong>Nombre del Salon</strong><br>
                                      <input type="text" name="nombre" autocomplete="off" required value="<?php echo $row['nombre']; ?>"><br>
                                      <strong>Grado</strong><br>
                                      <select name="grado">
                                          <?php
                                              $sal=mysql_query("SELECT * FROM grado WHERE estado='s'");				
                                              while($col=mysql_fetch_array($sal)){
												  if($col['id']==$row['grado']){
                                                  		echo '<option value="'.$col['id'].'" selected>'.$col['nombre'].'</option>';
												  }else{
														echo '<option value="'.$col['id'].'">'.$col['nombre'].'</option>';  
												  }
                                              }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="span6">
                                      <strong>Encargado</strong><br>
                                      <select name="profesor">
                                          <?php
                                              $sl=mysql_query("SELECT * FROM profesor WHERE estado='s'");				
                                              while($cl=mysql_fetch_array($sl)){
												  if($cl['doc']==$row['profesor']){
	                                                  echo '<option value="'.$cl['doc'].'" selected>'.$cl['ape'].' '.$cl['nom'].'</option>';
												  }else{
													  echo '<option value="'.$cl['doc'].'">'.$cl['ape'].' '.$cl['nom'].'</option>';
												  }
                                              }
                                          ?>
                                      </select><br>
                                      <strong>Estado</strong><br>
                                      <select name="estado">
                                          <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>Activo</option>
                                          <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>No Activo</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                              <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
                          </div>
                          </form>
                      </div>
                        
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
