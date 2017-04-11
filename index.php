<?php require 'inc/cabecera.inc'; ?>
			<div class="container-fluid">
				    <div class="row">
				    	 <div class="col-md-12 text-center">
				    	 	<h1>Bienvenido al ingreso de Notas</h1> <br>

				    	 </div>
				    </div>
				    <div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="panel panel-default">
						 		 <div class="panel-body">



						 		 <?php 
						 		 $codigo=1234;
						 		 $iterador=0;

						 		 	$ok=false;

						 		 	require 'conexion.php';
						 		    require 'Database.php';

						 		   $conex= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
						 		   $validar_profe =  $conex->validar_datos('codigo_profesor','profesor',$codigo);


						 		   if($validar_profe ==1){
						 		   			echo "Pertenece al sistema <br>"; 
						 		   			echo "Bienvenido Profesor ";
						 		   			$conex->preparar("SELECT p.codigo_curso, p.codigo_turno, c.nombre_curso  from profesor_curso p, curso c  WHERE p.codigo_profesor=$codigo and c.codigo_curso=p.codigo_curso");
						 		   			$conex->ejecutar();
						 		   			$conex->prep()->bind_result($curso_1, $turno_1, $nombre_1);
						 		   			 echo "<table class='table table-cell'
								 		 		<thead>
								 		 			<tr>
								 		 					<td> Codigo del Curso </td>
								 		 					<td> Turno del curso</td>								 		 					
								 		 					<td> nombre del curso</td>
								 		 					<td> Tipo de examen </td>

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
								 		 			<td>
								 		 			<select name='sel'>
								 		 			<option value='ep'>Parcial</option>
								 		 			<option value='ef'>Final</option>
								 		 			<option value='p1'>pc1</option>
								 		 			<option value='p2'>pc2</option>
								 		 			<option value='p3'>pc3</option>
								 		 			<option value='p4'>pc4</option>
								 		 			<option value='lab'>Labo</option>
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
						 		      //echo "<a class='pull-right' href='registrar_ponderados.php?coddoc=".$codigo."'>Registrar ponderado</a>";
						 		  
						 		  
						 		   }


						 		   else{
						 		   			echo "usted no pertenece , fuera";
						 		   }

						 		//    $conexion = mysqli_connect("localhost","root","","nota_fime");
						 		//  	if( !$conexion){
						 		//  		echo "no se pudo conetar a mysql <br>";
						 		//  		echo mysqli_connect_errno(); //numero de error 
						 		//  		echo mysqli_connect_error();  
						 		//  		exit;
						 		//  	}
						 		 	
						 		//  	$resultado = mysqli_query($conexion,"SELECT * from profesor");


						 		//  	while($fila = mysqli_fetch_assoc($resultado)){//mostrar los resultados de cada fila
						 		//  			$codigo_php= $fila ['codigo_profesor'];
						 		//  			$nombre_php=$fila ['nombre_profesor'];
						 		//  	echo "$codigo_php $nombre_php <br>";
						 		 	
									// }



						 		  ?>

						 		 	<!-- <form action="admin.php" method="POST" role="form">
						 		 		<legend>ESCOJA SUS GRUPOS</legend>		
						 		 		
                    <a class="btn" href="grupo1.php">Grupo 1</a>
                    <a class="btn" href="">Grupo 2 </a>

	
						 		 		<a class="pull-right" href="http://fime.unacvirtual.com/">Regresar al aula virtual</a>
						 		 	</form> -->
						  		</div>
						</div>
						</div>
					</div>
<?php require 'inc/footer.inc'; ?>

		
