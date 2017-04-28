<?php require 'inc/cabecera.inc';

	   ?>
			<div class="container-fluid">
				    <div class="row">
				    	 <div class="col-md-12 text-center">
				    	 	<div align="center" class="alert alert-info">
                			<h1 class="text-info"> <strong>BIENVENIDO AL SISTEMA DE CONSULTA DE NOTAS</strong> </h1>
                			<div class="row">

                			<div class="col-md-3">  <img src="img/captura.png" width="200" height="120" > </div>
                			<div class="col-md-2 col-md-offset-2">  <img src="img/alumno.png" width="120" height="120" > </div>
                			<div class="col-md-2 col-md-offset-1 ">  <img src="img/logo.png" width="400" height="120" > </div>
				    	 	</div>

				    	 </div>
				    </div>
				    <div class="row">
						     <div class="col-lg-3">
						        	<div class="panel panel-default ">
									  <div class="alert alert-danger" align="center"><strong>INDICACIONES</strong></div>
									 
									  <ul class="list-group" ><strong>
									    <li class="list-group-item">Si no encuentra algun curso es porque el docente estuvo sin designar o no esta registrado en la matrícula del presente ciclo</li>
									    
									    </strong>
									  </ul>
									  
									</div>

									

									
				    		</div>

				    		
						<div class="col-md-8"> 
							<div class="panel panel-default">



						 		 <?php 
						 		 session_start();
						 		$codigo=$_SESSION['codigo'];
						 		//$xxx= $_SESSION['undefined'];		
						 		 $iterador=0;
						 		if($_SESSION['undefined']){

						 		
						 		 	$ok=false;

						 		 	require 'conexion.php';
						 		    require 'Database.php';

						 		   $conex= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

						 		   $validar_alumno=$conex->validar_datos('codigo_alumno','alumno',$codigo);


						 		   if($validar_alumno ==1){

						 		   			$conex->preparar("SELECT apellido_paterno, apellido_materno, nombre_alumno from alumno  WHERE codigo_alumno='$codigo'");
						 		   			$conex->ejecutar();
						 		 			$conex->prep()->bind_result($app,$apm,$n);
						 		 			while($conex->resultado()){
						 		 				echo "<strong> Alumno : ".$app." ".$apm." ".$n."</strong>";
						 		 			}
						 		 			echo "<br> <strong> Codigo :".$codigo."</strong>";
						 		 			$nombre_completo=$app." ".$apm." ".$n;
						 		 			$nombre_facultad="INGENIERÍA MECÁNICA-ENERGÍA";
						 		 			$codigo_facultad=101;
						 		 			echo "<form action='generar_alumno.php' method='POST' role='form' enctype='multipart/form-data'>
									 			  <input type='text' name='codigo_alumno' value='$codigo' hidden >	
									 			  <input type='text' name='codigo_facultad' value='$codigo_facultad' hidden >	
									 			  <input type='text' name='nombre_facultad' value='$nombre_facultad' hidden >
									 			  <input type='text' name='nombre_completo' value='$nombre_completo' hidden >			 
							 		 			  <button type='submit' class='pull-right'> <span class='glyphicon glyphicon-print'></span><strong> Reporte en PDF</strong></button>
											 	</form>";
						 		   			$conex->preparar("SELECT n.ex_parcial, n.ex_final,n.pc1,n.pc2,n.pc3,n.pc4,n.laboratorio,n.susti, c.nombre_curso  from nota n, curso c  WHERE n.codigo_alumno='$codigo' and c.codigo_curso=n.codigo_curso");
						 		   			$conex->ejecutar();
						 		   			$conex->prep()->bind_result($ex_p,$ex_f,$pc1,$pc2,$pc3,$pc4,$labo,$susti,$name);
						 		   			 echo "<table class='table table-cell'
								 		 		<thead>
								 		 			<tr >
								 		 					<td class='info'> <strong>NOMBRE DEL CURSO </strong> </td>
								 		 					<td class='info'> <strong>Examen Parcial</strong> </td>
								 		 					<td class='info'> <strong>Examen Final</strong></td>								 		 					
								 		 					<td class='info'> <strong> Practica 1</strong></td>
								 		 					<td class='info' ><strong> Practica 2</strong></td>
								 		 					<td class='info'><strong> Practica 3 </strong></td>
								 		 					<td class='info'><strong> Practica 4 </strong></td>
								 		 					<td class='info'><strong> laboratorio </strong></td>
								 		 					<td class='info'><strong> sustitutorio</strong></td>
								 		 			</tr>
								 		 		 <tbody>
								 		 	  ";

						 		 			while($conex->resultado()){
						 		 		
						 		 				echo "
						 		 					
						 		 					<tr>
						 		 							<td>$name</td>
										 		 			<td>$ex_p</td>
										 		 			<td>$ex_f</td>
										 		 			<td>$pc1</td>
										 		 			<td>$pc2</td>
										 		 			<td>$pc3</td>
										 		 			<td>$pc4</td>
										 		 			<td>$labo</td>
										 		 			<td>$susti</td>
	
								 		 		    </tr>
								 		 		   "
								 		 		  ;

						 		 }

						 		  echo "</tbody>
						 		      </table>";
						 	  			
						 		   }

						 		   $validar_alumno2=$conex->validar_datos('codigo_alumno','alumno_fca',$codigo);

						 		   if($validar_alumno2==1){

						 		   			$conex->preparar("SELECT apellido_paterno, apellido_materno, nombre_alumno from alumno_fca  WHERE codigo_alumno='$codigo'");
						 		   			$conex->ejecutar();
						 		 			$conex->prep()->bind_result($app,$apm,$n);
						 		 			while($conex->resultado()){
						 		 				echo "<strong> Alumno : ".$app." ".$apm." ".$n."</strong>";
						 		 			}

						 		 			echo "<br> <strong> Código :".$codigo."</strong>";
						 		 			$nombre_completo=$app." ".$apm." ".$n;
						 		 			$nombre_facultad="ADMINISTRACIÓN";
						 		 			$codigo_facultad=102;
						 		 			echo "<form action='generar_alumno.php' method='POST' role='form' enctype='multipart/form-data'>
									 			  <input type='text' name='codigo_alumno' value='$codigo' hidden >	
									 			  <input type='text' name='nombre_facultad' value='$nombre_facultad' hidden >
									 			  <input type='text' name='codigo_facultad' value='$codigo_facultad' hidden >	
									 			  <input type='text' name='nombre_completo' value='$nombre_completo' hidden >			 
							 		 			  <button type='submit' class='pull-right'> <span class='glyphicon glyphicon-print'></span><strong> Reporte en PDF</strong></button>
											 	</form>";
						 		   			$conex->preparar("SELECT n.ex_parcial, n.ex_final,n.pc1,n.pc2,n.pc3,n.pc4,n.laboratorio,n.susti, c.nombre_curso  from nota_fca n, curso c, matricula_fca m WHERE m.codigo_alumno='$codigo' and c.codigo_curso=m.codigo_curso and n.codigo_matricula = m.codigo_matricula");
						 		   			$conex->ejecutar();
						 		   			$conex->prep()->bind_result($ex_p,$ex_f,$pc1,$pc2,$pc3,$pc4,$labo,$susti,$name);
						 		   			 echo "<table class='table table-cell'
								 		 		<thead>
								 		 			<tr >
								 		 					<td class='info'> <strong>NOMBRE DEL CURSO </strong> </td>
								 		 					<td class='info'> <strong>Examen Parcial</strong> </td>
								 		 					<td class='info'> <strong>Examen Final</strong></td>								 		 					
								 		 					<td class='info'> <strong> Practica 1</strong></td>
								 		 					<td class='info' ><strong> Practica 2</strong></td>
								 		 					<td class='info'><strong> Practica 3 </strong></td>
								 		 					<td class='info'><strong> Practica 4 </strong></td>
								 		 					<td class='info'><strong> laboratorio </strong></td>
								 		 					<td class='info'><strong> sustitutorio</strong></td>
								 		 			</tr>
								 		 		 <tbody>
								 		 	  ";

						 		 			while($conex->resultado()){
						 		 		
						 		 				echo "
						 		 					
						 		 					<tr>
						 		 							<td>$name</td>
										 		 			<td>$ex_p</td>
										 		 			<td>$ex_f</td>
										 		 			<td>$pc1</td>
										 		 			<td>$pc2</td>
										 		 			<td>$pc3</td>
										 		 			<td>$pc4</td>
										 		 			<td>$labo</td>
										 		 			<td>$susti</td>
	
								 		 		    </tr>
								 		 		   "
								 		 		  ;

						 		 }

						 		  echo "</tbody>
						 		      </table>";
						 	  		
						 		   }
									if($validar_alumno2==0 && $validar_alumno ==00){
										echo "<strong> Usted no esta registrado en el aula virtual </strong>";
										}

									}
									else{
										echo "Sesión no iniciada ";
									}
						 		  ?>

						 		 	
						  		
						</div>
						</div>
					</div>

<?php 
	
	
	require 'inc/footer.inc'; 
?>



