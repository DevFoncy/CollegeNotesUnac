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

						<div class="col-md-8 col-md-offset-2"> 
							<div class="panel panel-default">



						 		 <?php 
						 		 session_start();
						 		$codigo=$_SESSION['codigo'];		
						 		 $iterador=0;

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
						 		 			$nombre_completo=$app." ".$apm." ".$n;
						 		 		
						 		 			echo "<form action='generar_alumno.php' method='POST' role='form' enctype='multipart/form-data'>
									 			  <input type='text' name='codigo_alumno' value='$codigo' hidden >	
									 			  <input type='text' name='nombre_completo' value='$nombre_completo' hidden >			 
							 		 			  <button type='submit' class='pull-right'> <span class='glyphicon glyphicon-print'></span> Reporte en PDF</button>
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

						 		   else{
						 		   			echo "usted no pertenece , fuera";
						 		   }

					
						 		  ?>

						 		 	
						  		
						</div>
						</div>
					</div>

<?php 
	
	/*require_once ("dompdf/dompdf_config.inc.php");
	$codigoHTML=null;
	$codigoHTML= utf8_decode($codigoHTML);
	$dompdf= new DOMPDF();
	$dompdf->load_html($codigoHTML);
	ini_set("memory_limit","128M");
	$dompdf->render();
	$dompdf->stream("Reporte_Notas_Alumnos_2017-1");
 */
	require 'inc/footer.inc'; 
?>



