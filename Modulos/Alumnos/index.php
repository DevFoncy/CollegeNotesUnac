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
    <title>Alumnos</title>
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

    <?php include_once "../../menu/m_alumnos.php"; ?>
	
    <div align="center">
        <table width="90%">
          <tr>
            <td>
            
            	<table class="table table-bordered">
                  <tr class="info">
                    <td>
                    	<div class="row-fluid">
                        	<div class="span6">
                            	<h2 class="text-info">
                                    <img src="img/alumno.png" width="80" height="80">
                                    Control de Alumnos
                                </h2>
                          </div>
                        	<div class="span6">
                           		<form name="form1" method="post" action="">
                                	<div class="input-append">
                                	<input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Alumnos por Documento o Nombre">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                          	    </form>
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                	<strong><i class="icon-plus"></i> Ingresar Nuevo Alumno</strong>
                                </a>
                                
                                <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                	<form name="form2" method="post" action="">
                                	<div class="modal-header">
                                		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                		<h3 id="myModalLabel">Registrar Nuevo Alumno</h3>
                                	</div>
                                	<div class="modal-body">
                                		<div class="row-fluid">
                                            <div class="span6">
                                            	<strong>Documento</strong><br>
                                                <input type="text" name="doc" value="" autocomplete="off" required><br>
                                                <strong>Nombre Completo</strong><br>
                                                <input type="text" name="nombre" value="" autocomplete="off" required><br>
                                                <strong>Fecha de Nacimiento</strong><br>
                                                <input type="date" name="fecha" value="" autocomplete="off" required><br>
                                                <strong>Tipo</strong><br>
                                                <select name="tipo">
                                                	<option value="n">Nuevo</option>
                                                    <option value="a">Antiguo</option>
                                                    <option value="r">Repitente</option>
                                                </select><br>
                                                <strong>Fecha Matricula</strong><br>
                                                <input type="date" name="matricula" value="<?php echo date('Y-m-d'); ?>" autocomplete="off" required><br>
                                            </div>
                                            <div class="span6">
	                                            <strong>Direccion de Recidencia</strong><br>
                                                <input type="text" name="direccion" value="" autocomplete="off" required><br>
                                                <strong>Numeros Telefonicos</strong><br>
                                                <input type="text" name="telefono" value="" autocomplete="off" required><br>
                                            	<strong>Grado</strong><br>
													<select name="grado" onchange="pais(this.value);">
                                                    	<option value="x">---SELECCIONE---</option>
                                                    	<?php
															$p=mysql_query("SELECT * FROM grado WHERE estado='s'");				
															while($r=mysql_fetch_array($p)){
																echo '<option value="'.$r['id'].'">'.$r['nombre'].'</option>';
															}
														?>
                                                    </select>
                                                <strong>Salon</strong><br>
    											<div id="divEstado">
                                    				<select name="salon">
                                                    </select>
                                                </div>
                                                <strong>Estado</strong><br>
                                                <select name="estado">
                                                	<option value="s">Activo</option>
                                                    <option value="n">No Activo</option>
                                                </select>
                                            </div>
                                        </div>
                                	</div>
                                	<div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true"><strong><i class="icon-remove"></i> Cerrar</strong></button>
                                        <button type="submit" class="btn btn-primary"><strong><i class="icon-ok"></i> Guardar Registro</strong></button>
	                                </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </td>
                  </tr>
                </table>
                <?php 
					if(!empty($_POST['nombre']) and !empty($_POST['doc'])){
						$nombre=limpiar($_POST['nombre']);			$grado=limpiar($_POST['grado']);
						$salon=limpiar($_POST['salon']);			$tipo=limpiar($_POST['tipo']);
						$fecha=limpiar($_POST['fecha']);			$direccion=limpiar($_POST['direccion']);
						$telefono=limpiar($_POST['telefono']);		$estado=limpiar($_POST['estado']);
						$matricula=limpiar($_POST['matricula']);	$doc=limpiar($_POST['doc']);
						
						$oGrado=new Consultar_Grado($grado);
						$oSalon=new Consultar_Salon($salon);
						$ngrado=$oGrado->consultar('nombre');
						$nsalon=$oSalon->consultar('nombre');
							
						$oGuardar=new Proceso_Alumno($doc,$nombre,$grado,$salon,$fecha,$direccion,$telefono,$estado,$matricula,$tipo);
						
						if(empty($_POST['id'])){
							$oGuardar->guardar();
							echo mensajes('Alumno "'.$nombre.'" Registrado con Exito en la Base de datos<br>
							Registrado en el Grado "'.$ngrado.'" Salon "'.$nsalon.'"','verde');					
						}else{
							$oGuardar->actualizar();
							echo mensajes('Alumno "'.$nombre.'" Actualizado con Exito en la Base de datos<br>
							Registrado en el Grado "'.$ngrado.'" Salon "'.$nsalon.'"','verde');		
						}
					}
					
					if(!empty($_POST['rh']) and !empty($_POST['emergencia']) and !empty($_POST['id'])){
						$id=limpiar($_POST['id']);
						$rh=limpiar($_POST['rh']);						$emergencia=limpiar($_POST['emergencia']);
						$eps=limpiar($_POST['eps']);					$padre=limpiar($_POST['padre']);
						$madre=limpiar($_POST['madre']);				$p_ocupacion=limpiar($_POST['p_ocupacion']);
						$m_ocupacion=limpiar($_POST['m_ocupacion']);	$acudiente=limpiar($_POST['acudiente']);
						mysql_query("UPDATE alumnos SET rh='$rh',
														eps='$eps',
														madre='$madre',
														padre='$padre',
														p_ocupacion='$p_ocupacion',
														m_ocupacion='$m_ocupacion',
														acudiente='$acudiente',
														emergencia='$emergencia'
												WHERE id=$id
						");	
						echo mensajes('Informcion Secundaria Registrada con Exito','verde');
					}
				?>
                <table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td><strong class="text-info">Documento</strong></td>
                    <td><strong class="text-info">Nombre</strong></td>
                    <td><strong class="text-info"><center>Grado</center></strong></td>
                    <td><strong class="text-info"><center>Salon</center></strong></td>
                    <td><strong class="text-info"><center>Estado</center></strong></td>
                    <td></td>
                  </tr>
                  <?php 
					if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pa=mysql_query("SELECT * FROM alumnos WHERE nombre LIKE '%$buscar%' or doc='$buscar'");				
						while($row=mysql_fetch_array($pa)){
							$oGrado=new Consultar_Grado($row['grado']);
							$oSalon=new Consultar_Salon($row['salon']);
				  ?>
                  <tr>
                  	<td><?php echo $row['doc']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><center><?php echo $oGrado->consultar('nombre'); ?></center></td>
                    <td><center><?php echo $oSalon->consultar('nombre'); ?></center></td>
                    <td><center><?php echo estado($row['estado']); ?></center></td>
                    <td>
                    	<center>
                    	<a href="#a<?php echo $row['doc']; ?>" title="Editar Informacion Basica" role="button" class="btn btn-mini" data-toggle="modal">
                        	<i class="icon-edit"></i>
                        </a>
                        <a href="#x<?php echo $row['doc']; ?>" title="Ingresar mas Informacion" role="button" class="btn btn-mini" data-toggle="modal">
                        	<i class="icon-th-list"></i>
                        </a>
                        </center>
                        
                        <!-- Modal -->
                        <div id="x<?php echo $row['doc']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        	<form name="form53" method="post" action="">
                            <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                        	<div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Informacion Secundaria</h3>
                        	</div>
                        	<div class="modal-body">
                        		<div class="row-fluid">
                                	<div class="span6">
                                    	<strong>RH</strong><br>
                                        <input type="text" name="rh" value="<?php echo $row['rh']; ?>" autocomplete="off" required><br>
                                        <strong>EPS</strong><br>
                                        <input type="text" name="eps" value="<?php echo $row['eps']; ?>" autocomplete="off" ><br>
                                        <strong>Nombre del Padre</strong>
                                        <input type="text" name="padre" value="<?php echo $row['padre']; ?>" autocomplete="off" ><br>
                                        <strong>Ocupacion del Padre</strong><br>
                                        <input type="text" name="p_ocupacion" value="<?php echo $row['p_ocupacion']; ?>" autocomplete="off" ><br>
                                    </div>
                                	<div class="span6">
                                    	<strong>Nombre de la Madre</strong><br>
                                        <input type="text" name="madre" autocomplete="off" value="<?php echo $row['madre']; ?>" ><br>
                                    	<strong>Ocupacion de la Madre </strong><br>
                                        <input type="text" name="m_ocupacion" autocomplete="off" value="<?php echo $row['m_ocupacion']; ?>" ><br>
                                        <strong>Acudiente</strong><br>
                                        <input type="text" name="acudiente" autocomplete="off" value="<?php echo $row['acudiente']; ?>" ><br>
                                        <strong>Numero de Emergencia</strong><br>
                                        <input type="text" name="emergencia" autocomplete="off" required value="<?php echo $row['emergencia']; ?>"><br>
                                    </div>
                                </div>
                        	</div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar Informacion</strong></button>
                            </div>
                            </form>
                        </div>
                        
                        <!-- DATOS PRINCIPALES --->
                        <div id="a<?php echo $row['doc']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form name="form5" method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel" align="center">Actualizar Alumno <br> [ <?php echo $row['nombre']; ?> ]</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>Documento</strong><br>
                                    <input type="text" name="doc" value="<?php echo $row['doc']; ?>" autocomplete="off" readonly><br>
                                    <strong>Nombre Completo</strong><br>
                                    <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" autocomplete="off" required><br>
                                    <strong>Fecha de Nacimiento</strong><br>
                                    <input type="date" name="fecha" value="<?php echo $row['fecha']; ?>" autocomplete="off" required><br>
                                    <strong>Tipo</strong><br>
                                    <select name="tipo">
                                        <option value="n" <?php if($row['tipo']=='n'){ echo 'selected'; } ?>>Nuevo</option>
                                        <option value="a" <?php if($row['tipo']=='a'){ echo 'selected'; } ?>>Antiguo</option>
                                        <option value="r" <?php if($row['tipo']=='r'){ echo 'selected'; } ?>>Repitente</option>
                                    </select><br>
                                    <strong>Fecha Matricula</strong><br>
                                    <input type="date" name="matricula" value="<?php echo $row['matricula']; ?>" autocomplete="off" required><br>
                                </div>
                                <div class="span6">
                                    <strong>Direccion de Recidencia</strong><br>
                                    <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>" autocomplete="off" required><br>
                                    <strong>Numeros Telefonicos</strong><br>
                                    <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" autocomplete="off" required><br>
                                    <strong>Grado</strong><br>
                                        <select name="grado" onchange="pais(this.value);">
                                            <option value="x">---SELECCIONE---</option>
                                            <?php
                                                $p=mysql_query("SELECT * FROM grado WHERE estado='s'");				
                                                while($r=mysql_fetch_array($p)){
                                                    if($r['id']==$row['grado']){
                                                        echo '<option value="'.$r['id'].'" selected>'.$r['nombre'].'</option>';
                                                    }else{
                                                        echo '<option value="'.$r['id'].'">'.$r['nombre'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    <strong>Salon</strong><br>
                                    <div id="divEstado">
                                        <select name="salon">
                                            <option value="<?php echo $row['salon']; ?>"><?php echo $oSalon->consultar('nombre'); ?></option>
                                        </select>
                                    </div>
                                    <strong>Estado</strong><br>
                                    <select name="estado">
                                        <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>Activo</option>
                                        <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>No Activo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><strong><i class="icon-remove"></i> Cerrar</strong></button>
                            <button type="submit" class="btn btn-primary"><strong><i class="icon-ok"></i> Guardar Registro</strong></button>
                        </div>
                        </form>
                    </div>
                    <!-- // DATOS PRINCIPALES --->  
                    </td>
                  </tr>
                  <?php }} ?>
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
	<script type="text/javascript" src="jss/jquery.min.js"></script>
    <script type="text/javascript" src="jss/prototype.js"></script>
    <script type="text/javascript" src="jss/eventos.js"></script>
  </body>
</html>
