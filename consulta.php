<?php require 'inc/cabecera.inc';
	  require 'conexion.php';
	  require 'Database.php';
	  session_start();
				 		  		
		header('Cache-Control: no cache');
		$codigo_teacher=$_SESSION['codigo'];
						 
		$curso_m = $_POST['curso'];
		$turno_m = $_POST['turno'];	
	
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
						<div class="col-md-10 col-md-offset-1"> 
							<div class="panel panel-default">
<?php 		
								$conex6= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
								$conex6->preparar("SELECT c.nombre_curso, p.apellido_profesor, p.nombre_profesor, f.nombre, f.codigo_facultad from curso c, profesor p,facultad f  WHERE c.codigo_curso='$curso_m' and p.codigo_profesor='$codigo_teacher' and f.codigo_facultad=c.codigo_facultad");
						 		   			$conex6->ejecutar();
						 		 			$conex6->prep()->bind_result($course, $ap, $na, $facu, $codigo_facultad);
						 		 			while($conex6->resultado()){
						 		 				echo "<strong> FACULTAD   : ".$facu."<br>";
						 		 				echo "<strong> CURSO   : ".$course."<br>";
						 		 				echo "PROFESOR: ".$ap." ".$na;
						 		 				echo "<br> TURNO:".$turno_m."</strong>";
						 		 	}
						 		 	
						 		 echo "<br><div class='col-md-6 col-md-offset-3' >";
						 		 echo "<div class='alert alert-warning'> Nota : el simbolo ? significa que usted no ha registrado nota en ese casillero </div> </div>";

						 		 echo "<div align='right'>
										  	<a type='button' class='btn btn-default' href='index.php'>
											      <span class='glyphicon glyphicon-step-backward'></span><strong> REGRESAR A LA PÁGINA PRINCIPAL </strong>
										</a>						  
									 </div>";
								if($codigo_facultad==101){
									$conex6->preparar("SELECT a.codigo_alumno ,CONCAT(a.apellido_paterno,' ', a.apellido_materno), a.nombre_alumno, n.ex_parcial, n.ex_final,n.pc1,n.pc2,n.pc3,n.pc4,n.laboratorio,n.susti FROM alumno a, nota n  WHERE n.codigo_alumno =a.codigo_alumno and n.codigo_curso='$curso_m' and n.codigo_turno='$turno_m' ORDER BY a.apellido_paterno");
															}
								if($codigo_facultad==102){
									$conex6->preparar("SELECT a.codigo_alumno ,CONCAT(a.apellido_paterno,' ', a.apellido_materno), a.nombre_alumno, n.ex_parcial, n.ex_final,n.pc1,n.pc2,n.pc3,n.pc4,n.laboratorio,n.susti FROM alumno_fca a, nota_fca n , matricula_fca m WHERE n.codigo_matricula=m.codigo_matricula and m.codigo_curso='$curso_m' and m.codigo_turno='$turno_m' and m.codigo_alumno = a.codigo_alumno ORDER BY a.apellido_paterno");
							
								}
								$conex6->ejecutar();
								$conex6->prep()->bind_result($cod_a, $ap1, $nom,$ex_p,$ex_f,$pc1,$pc2,$pc3,$pc4,$labo,$susti);

								echo "<table class='table table-cell'
								 		 		<thead>
								 		 			<tr >
								 		 					<td class='info'> <strong>Codigo_Alumno </strong> </td>
								 		 					<td class='info'> <strong>Apellidos</strong> </td>
								 		 					<td class='info'> <strong>Nombres</strong></td>					 		 
								 		 					<td class='info'> <strong> Examen Parcial</strong></td>
								 		 					<td class='info' ><strong> Practica 1</strong></td>							 		 
								 		 					<td class='info'> <strong> Practica 2</strong></td>
								 		 					<td class='info' ><strong> Practica 3</strong></td>
								 		 					<td class='info'><strong> Practica 4</strong></td>
								 		 					<td class='info'><strong> Laboratorio </strong></td>
								 		 					<td class='info'><strong> Examen Final </strong></td>
								 		 					<td class='info'><strong> Sustitutorio</strong></td>
								 		 			</tr>
								 		 		 <tbody>
								 		 	  ";

								 		 	
						 		 			while($conex6->resultado()){
						 		 		
						 		 				echo "
						 		 					
						 		 					<tr>    
						 		 							<td><h6>$cod_a</h6></td>
						 		 							<td><h6>$ap1</h6></td>
										 		 			<td><h6>$nom</h6></td>
										 		 			<td><h6>$ex_p</h6></td>
										 		 			<td><h6>$pc1</h6></td>
										 		 			<td><h6>$pc2</h6></td>
										 		 			<td><h6>$pc3</h6></td>
										 		 			<td><h6>$pc4</h6></td>
										 		 			<td><h6>$labo</h6></td>
										 		 			<td><h6>$ex_f</h6></td>
										 		 			<td><h6>$susti</h6></td>

	
								 		 		    </tr>
								 		 		   "
								 		 		  ;


						 						 }
						 		echo " <br><form action='generar.php' method='POST' role='form' enctype='multipart/form-data'>
						 				<input type='text' name='nombre_curso' value='$course' hidden >
						 				<input type='text' name='turno' value='$turno_m' hidden >
										<input type='text' name='apellido' value='$ap' hidden >

						 				<input type='text' name='codigo_curso1' value='$curso_m' hidden >
						 				<input type='text' name='codigo_facu' value='$codigo_facultad' hidden >
										<input type='text' name='nombre' value='$na' hidden >
										<input type='text' name='nombre_facu' value='$facu' hidden >			 
				 		 			  <button type='submit' class='pull-right'> <span class='glyphicon glyphicon-print'></span> REPORTE PDF</button>
								 		</form>";

						 		  echo "</tbody>
						 		      </table>"
						 		      ;

							   
				 		   ?>
						 		 	
						  		
						</div>
						</div>
					</div>

<?php
 require 'inc/footer.inc'; ?>
	