<?php require 'inc/cabecera.inc'; ?>
			<div class="container-fluid">
				    <div class="row">
				    	 <div class="col-md-12 text-center">
				    	 	<div align="center" class="alert alert-info">
                			<h1 class="text-info"> <strong>BIENVENIDO AL SISTEMA DE REGISTRO DE NOTAS</strong> </h1>
                			<div class="row">

                			<div class="col-md-3">  <img src="img/captura.png" width="200" height="120" > </div>
                			<div class="col-md-2 col-md-offset-2">  <img src="img/alumno.png" width="120" height="120" > </div>
                			<div class="col-md-2 col-md-offset-1 ">  <img src="img/logo.png" width="400" height="120" > </div>
				    	 	</div>

				    	 </div>
				    </div>
				    <div class="row">
				        <div class="col-md-4 col-md-offset-1">
				        	<div class="panel panel-default">
							  <div class="alert alert-danger"><strong> INSTRUCCIONES </strong></div>
							  <div class="panel-body">
							    <p>A continuación le presentamos una lista de todos los cursos que usted dicta diferenciado por sus grupos. 
							       Por favor escoja el tipo de examen a llenar y seguidamente darle CLIC en la opción REGISTRAR
							    </p>
							  </div>
							 
							  
							</div>
				        </div>

						<div class="col-md-6"> 
							<div class="panel panel-default">



						 		 <?php 
						 		 session_start();
						 		  $codigo=$_SESSION['codigo'];			
						 		 $iterador=0;

						 		 	$ok=false;

						 		 	require 'conexion.php';
						 		    require 'Database.php';

						 		   $conex= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
						 		   $validar_profe =  $conex->validar_datos('codigo_profesor','profesor',$codigo);


						 		   if($validar_profe ==1){

						 		   			$conex->preparar("SELECT codigo_profesor, apellido_profesor, nombre_profesor from profesor WHERE codigo_profesor='$codigo'");
						 		   			$conex->ejecutar();
						 		 			$conex->prep()->bind_result($cod,$ap,$n);
						 		 			while($conex->resultado()){
						 		 				echo "Codigo del Profesor : ".$cod."<br>";
						 		 				echo "Bienvenido Profesor :".$ap." ".$n;
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
								 		 					<td class='info'><strong> Acción </strong></td>
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
								 		 			<input type='text' name='cod_profe' value = '$codigo' hidden>
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
								 		 			</td
								 		 			
								 		 		  </tr>
								 		 		  </form>"
								 		 		  ;

						 		 }

						 		  echo "</tbody>
						 		      </table>";
						 	  
						 		   }

						 		   else{
						 		   			echo "usted no pertenece , fuera";
						 		   }

					
						 		  ?>

						 		 	
						  		
						</div>
						</div>
					</div>
<?php require 'inc/footer.inc'; ?>

		
