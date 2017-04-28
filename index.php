<?php require 'inc/cabecera.inc'; ?>
			<div class="container-fluid">
				    <div class="row">
				    	 <div class="col-sm-12 text-center">
				    	 	<div align="center" class="alert alert-info">
                			<h1 class="text-info"> <strong>BIENVENIDO AL SISTEMA DE REGISTRO DE NOTAS</strong> </h1>
                			<div class="row">

                			<div class="col-sm-3">  <img src="img/captura.png" width="200" height="120" > </div>
                			<div class="col-sm-2 col-lg-offset-2">  <img src="img/alumno.png" width="120" height="120" > </div>
                			<div class="col-sm-2 col-lg-offset-1 ">  <img src="img/logo.png" width="400" height="120" > </div>
				    	 	</div>

				    	 </div>
				    </div>
				    <div class="row">
				        <div class="col-lg-4 col-lg-offset-1">
				        	<div class="panel panel-default">
							  <div class="alert alert-danger"><strong> INSTRUCCIONES </strong></div>
							  <div class="panel-body">
							    <p class="text-justify" >A continuación le presentamos una lista de todos los cursos que usted dicta diferenciado por sus grupos. 
							       Por favor escoja el tipo de examen a llenar y seguidamente darle CLIC en la opción REGISTRAR
							    </p>
							    <p class="text-justify" >En tipo de Examen encontrará categorias definidas y si en caso usted tenga mas de un laboratorio considerar en la nota de laboratorio con un Promedio Ponderado, si usted no tome alguna de esas pruebas no llenarla. Por el momento puede registrar las notas que estan definidas.
							    </p>
							  </div>
							 
							  
							</div>
				        </div>

						<div class="col-lg-6"> 
							<div class="panel panel-default">
						 		 <?php 
						 		 session_start();
						 		 $codigo=$_SESSION['codigo'];	
						 		 if($_SESSION['undefined']){		
						 		 $iterador=0;

						 		 	$ok=false;

						 		 	require 'conexion.php';
						 		    require 'Database.php';

						 		   $conex= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
						 		   $validar_profe =  $conex->validar_datos('codigo_profesor','profesor',$codigo);


						 		   if($validar_profe ==1){

						 		   			$conex->preparar("SELECT p.codigo_profesor, p.apellido_profesor, p.nombre_profesor, f.nombre, f.codigo_facultad from profesor p, facultad f WHERE p.codigo_profesor='$codigo' and p.facultad=f.codigo_facultad");
						 		   			$conex->ejecutar();
						 		 			$conex->prep()->bind_result($cod,$ap,$n,$nombre_facu,$codigo_f);
						 		 			while($conex->resultado()){
						 		 				//echo "Codigo del Profesor : ".$cod."<br>";
						 		 				echo "<strong> FACULTAD DE ".$nombre_facu."</strong> <br>";
						 		 				echo "<strong>PROFESOR :".$ap." ".$n."</strong>";


						 		 			}

						 		   			$conex->preparar("SELECT p.codigo_curso, p.codigo_turno, c.nombre_curso  from profesor_curso p, curso c  WHERE p.codigo_profesor=$codigo and c.codigo_curso=p.codigo_curso");
						 		   			$conex->ejecutar();
						 		   			$conex->prep()->bind_result($curso_1, $turno_1, $nombre_1);
						 		   			 echo "<table class='table table-cell'
								 		 		<thead>
								 		 			<tr >
								 		 					<td class='info'> <strong>Codigo del Curso</strong> </td>
								 		 					<td class='info'> <strong>Turno del curso</strong></td>								 		 					
								 		 					<td class='info'> <strong>nombre del curso</strong></td>
								 		 					<td class='info' ><strong> Tipo de examen </strong></td>
								 		 					<td align='center'class='info'colspan=2 ><strong> Acción </strong></td>
								 		 			</tr>
								 		 		 <tbody>
								 		 	  ";

						 		 			while($conex->resultado()){
						 		 				$iterador++;
						 		 				echo "
						 		 					<form name='form".$iterador."'action='llenado.php' enctype='multipart/form-data' method='POST' role='form'>
						 		 					<tr>
								 		 			<td>$curso_1 <input type='text' name='curso' value='$curso_1' hidden></td>
								 		 			<td>$turno_1<input type='text'name='turno' value='$turno_1' hidden></td>
								 		 			<td>$nombre_1<input type='text'name='nombre' value='$nombre_1' hidden></td>

								 		 		    <input type='text' name='codigo_facultad' value='$codigo_f' hidden></td>
								 		 			<input type='text' name='cod_profe' value='$codigo' hidden>
								 		 			<td>
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

								 		 			<td>
								 		 			  <button type='submit' class='btn btn-primary'>Registrar</button>
								 		 			</td>
								 		 		  </form>"
								 		 		  ;
								 		 		  echo "<td>
								 		             <form name='form".$iterador."' action='consulta.php' method='POST' role='form' enctype='multipart/form-data'>
								 		 		      <input type='text' name='curso' value='$curso_1' hidden>
													  <input type='text'name='turno' value='$turno_1' hidden>
								 		 			  <button type='submit' class='btn btn-primary'>Consulta de Notas</button>
								 		 			</td>
								 		 			</tr>
								 		 			</form>";

						 		 }

						 		  echo "</tbody>
						 		      </table>";
						 	  
						 		   }

						 		   else{
						 		   			echo "usted no pertenece , fuera";
						 		   }

						 		   }
						 		   else{
						 		   	   echo "Usted no ha iniciado sesion en moodle";
						 		   }
					
						 		  ?>

						 		 	
						  		
						</div>
						</div>
					</div>
<?php require 'inc/footer.inc'; ?>

		
