<?php require 'inc/cabecera.inc'; ?>
			<div class="container-fluid">
				    <div class="row">
				    	 <div class="col-md-12 text-center">
				    	 	<div align="center" class="alert alert-info">
                			<h1 class="text-info">Bienvenido al Sistema de Notas </h1>
				    	 	<img src="img/alumno.png" width="120" height="120">

				    	 </div>
				    </div>
				    <div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="panel panel-default">
						 		 <div class="panel-body">



						 		 <?php 
						 		 $codigo=2964;
						 		 $iterador=0;

						 		 	$ok=false;

						 		 	require 'conexion.php';
						 		    require 'Database.php';

						 		   $conex= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
						 		   $validar_profe =  $conex->validar_datos('codigo_profesor','profesor',$codigo);


						 		   if($validar_profe ==1){
						 		   			echo "Pertenece al sistema <br>"; 
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
					</div>
<?php require 'inc/footer.inc'; ?>

		
