<?php require 'inc/cabecera.php';
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works 
session_start();
$user=$_SESSION['user'];

	  $conex3= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	  /*Busqueda de el nombre de la escuela*/
	  $conex3->preparar("SELECT e.nombre,c.codigo_escuela,f.codigo_facultad FROM escuela e, credenciales c, facultad f WHERE c.usuario='$user' and e.id=c.codigo_escuela and e.codigo_facultad=f.codigo_facultad");
	  $conex3->ejecutar();
	  $conex3->prep()->bind_result($nombre_escuela,$codigo_escuela,$cod_f);

	  while($conex3->resultado()){
	             echo $codigo_escuela;
			}


 ?>

 <div class="container-fluid">
				    <div class="row">
				    	 <div class="col-sm-12 text-center">
				    	 	<div align="center" class="alert alert-info">
                			<h1 class="text-info"> Sistema de Administración de Notas <strong>ESCUELA:</strong> <?php echo $nombre_escuela; ?> </h1>
                			<div class="row">

                			<div class="col-sm-3 col-sm-offset-1">  <img src="../img/logo_otic.png" width="400" height="120" > </div>
                			<div class="col-sm-2 col-lg-offset-1">  <img src="../img/admin.png" width="120" height="170" > </div>
                			<div class="col-sm-2 col-lg-offset-1 ">  <img src="../img/logo.png" width="400" height="150" > </div>
				    	 	</div>

				    	 </div>
				    	</div>

					</div>


				<div class="col-sm-12">
					<div class="row">
					 <div class="col-sm-3">
					 	<div class="panel panel-default">
							  <div class="alert alert-danger" align="center"><strong>INDICACIONES</strong></div>
							 
							  <ul class="list-group" ><strong>
							    <li class="list-group-item">Usted debe ingresar el codigo del profesor para iniciar la busqueda</li>
							    <li class="list-group-item">Luegar dar clic en el boton Buscar </li>
							     <li class="list-group-item">Si el codigo del profesor no esta registrado o ingresa un codigo erroneo , no habran resultados en la busqueda  </li>
							    <li class="list-group-item">Para modificar notas dar clic en el boton Cambiar Nota</li>
							    <li class="list-group-item">Debes seleccionar el tipo de examen a modificar </li>
							    <li class="list-group-item">Usted tendra privilegios para modificar una nota, deshacer cambios </li>					    
							    </strong> 	
							    <button type="button" id="boton_salida" onclick="salir()" class="btn btn-info pull-right"> Desconectarse</button>
							  </ul>
							  
							</div>

					 </div>
					 <div class="col-sm-9">
					 	
					 	
							<form action="busqueda_profesores.php" method="POST" role="form">
	
								<label>INGRESE EL CÓDIGO DEL PROFESOR AQUI ---> </label>
								<input type="text" name="codigo_profe" placeholder="" required="">
								<input type="text" name="codigo_escuela1" value="<?php echo $codigo_escuela; ?>" hidden="">
								<button style="margin-left: 50px; margin-top: 20px; width: 150px; height: 30PX;"  type="submit" class="btn btn-info"><span class="glyphicon glyphicon-zoom-in"></span> BUSCAR</button>
							</form>
		<?php 

if($_POST){	
	 /*Codigo que se trae por post */
	  $codigo_profe=$_POST['codigo_profe'];
	  $iterador=0;

		/*Busqueda de los cursos que dicta el profesor*/
	  $conex3= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	  $conex3->preparar("SELECT c.nombre_curso, pc.codigo_turno,c.codigo_curso, p.apellido_profesor,p.nombre_profesor FROM profesor p, profesor_curso pc, curso c WHERE pc.codigo_profesor='$codigo_profe' and pc.codigo_curso=c.codigo_curso and pc.codigo_profesor=p.codigo_profesor and c.codigo_escuela='$codigo_escuela'");
	  $conex3->ejecutar();
	  $conex3->prep()->bind_result($nom_curso,$turno,$cod_curso,$ape,$nom);
	  echo "<div class='col-md-12'>
	  		<br><br>
	  		<table class='table table-cell'>
								 		 		<thead>
								 		 			<tr bgcolor='#D5EAFF'>
								 		 			<td align='center' width='7%' bgcolor='#D5EAFF'> <strong>Codigo del curso</strong> </td>
								 		 					<td align='center' width='30%' bgcolor='#D5EAFF'> <strong>Nombre del Curso</strong> </td>
								 		 					<td align='center' width='3%' bgcolor='#D5EAFF'> <strong>Turno</strong></td>								 		 					
								 		 					<td align='center' width='18%' bgcolor='#D5EAFF'> <strong>Apellido</strong></td>
								 		 					<td align='center' width='18%' bgcolor='#D5EAFF' ><strong> Nombre</strong></td>
								 		 					<td align='center' width='10%' bgcolor='#D5EAFF'  ><strong> Tipo de examen </strong></td>
								 		 					<td colspan=2 align='center' width='25%' bgcolor='#D5EAFF' ><strong> Acción</strong></td>
								 		 			</tr>
								 		 		 <tbody>
								 		 	  ";

	  while($conex3->resultado()){
	  		$iterador++;
	  			echo "<form name='form_modificar".$iterador."'action='cambiar_nota.php' enctype='multipart/form-data' method='POST'  role='form'>
		  				  <tr>

		  				  <td align='center' bgcolor='white'> $cod_curso</td>
		  				  <td align='center' bgcolor='white'> $nom_curso</td>
		  				  <td align='center' bgcolor='white'> $turno</td>
		  				  <td align='center' bgcolor='white'> $ape</td>
		  				  <td align='center' bgcolor='white'> $nom</td>

		  				  <input type='text' name='codigo_curso' value='$cod_curso' hidden>
						  <input type='text' name='codigo_turno' value='$turno' hidden>
		  				  <input type='text' name='codigo_profe' value='$codigo_profe' hidden>		  		
		  				  <input type='text' name='nombre_curso' value='$nom_curso' hidden>
		  				  <input type='text' name='codigo_facultad' value='$cod_f' hidden>		

		  				  <td align='center' bgcolor='white'>
									 		 			<select name='sel'>
									 		 			<option value='ep'>Parcial</option>
						   			 		 			<option value='p1'>pc1</option>
									 		 			<option value='p2'>pc2</option>
									 		 			<option value='p3'>pc3</option>
									 		 			<option value='p4'>pc4</option>
									 		 			<option value='lab'>Labo</option>
									 		 			<option value='ef'>Final</option>
									 		 			<option value='s'>Susti</option>
									 		 			</select>
							</td>
		  				   <td align='center' bgcolor='white'><button class='btn btn-success' type='submit'><span class='glyphicon glyphicon-pencil'></span> Cambiar Nota</button>
		  				   </td> 
	  				  </form>";
	  			
	  			echo " <form name='form_consulta".$iterador."' action='consulta_admin.php' method='POST' 	role='form' enctype='multipart/form-data'>
							<input type='text' name='codigo_curso' value='$cod_curso' hidden>
							<input type='text' name='codigo_turno' value='$turno' hidden>
							<input type='text' name='codigo_profe' value='$codigo_profe' hidden>
							<td align='center' bgcolor='white' >
							<button type='submit' class='btn btn-primary'>Consulta de Notas</button>
							</td>
							</tr>
						</form>";
	  			             
			}


echo "</tbody>
	  </table>
      </div>";

} 
?>

						</div>
					</div>
				</div>



				
</div>
<script type="text/javascript">
	
	function salir(){
		window.location.href="index_admin.php"
	}
</script>
<?php require 'inc/footer.inc'; ?>