<?php require 'inc/cabecera.php'; ?>
<div class="container-fluid">
	    <div class="row">
	    	<div class="col-md-6 col-md-offset-3">
<?php 

					$aviso=false;
					$var=true;

				    $tipo_examen=$_POST['tipo_examen'];
				    $codigo_nota=$_POST['codigo_nota'];
				    $tipo_examen1= $_POST['seleccion'];
				    $codigo_profe = $_POST['codigo_profe']; 
					$codigo_turno = $_POST['codigo_turno'];
					$codigo_curso = $_POST['codigo_curso'];
					$codigo_facultad= $_POST['codigo_facultad'];
				 
				   foreach($tipo_examen as $codigo){	
					    					    
				  if((($codigo<-1 || $codigo>20) || $codigo=="")){
				      echo "<div class='alert alert-success' align='center' >
 					 		<a href='busqueda_profesores.php' class='alert-warning'> <strong> Hubo un error al ingresar las notas intentalo nuevamente. Seras redirigido a la pagina inicial en 3 segundos</strong></a> <br></br>
 			 				<img src='img/warning.jpg' width='30' height='30'>
				 		</div>";
				  		header("Refresh:3; url=busqueda_profesores.php");
				  		$aviso=true;
				  	}
				  }
				  if($codigo=="NSP"){
				  	 $aviso==false;
				  
				  }
		
				 if($aviso==false){
					   $size = count ($tipo_examen);	// cantidad de notas de	
		    		   $conex3= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);


					   for( $i=0;  $i< $size; $i++){
					     	
					      if($codigo_facultad==101){
					      	     if($tipo_examen[$i]=="NSP"){
					      	     	$var= $conex3->preparar("UPDATE nota SET $tipo_examen1='NSP' WHERE codigo_nota=$codigo_nota[$i]");
					      	     }
					      	     else{
					      	     	$var= $conex3->preparar("UPDATE nota SET $tipo_examen1=$tipo_examen[$i] WHERE codigo_nota=$codigo_nota[$i]");
					      	     }
					    		 
					      }
					      if($codigo_facultad==102){
					      		if($tipo_examen[$i]==-1){
					      	     	$var= $conex3->preparar("UPDATE nota SET $tipo_examen1='NSP' WHERE codigo_nota=$codigo_nota[$i]");
					      	     }
					      	     else{
					      		 $var= $conex3->preparar("UPDATE nota_fca SET $tipo_examen1=$tipo_examen[$i] WHERE codigo_nota=$codigo_nota[$i]");
					      		}
					      }
					      
					      if($var==false){
					      		echo "<div class='alert alert-success' align='center' >
	 							 <a href='busqueda_profesores.php' class='alert-danger'><strong> Hubo un error al ingresar las notas intentalo nuevamente. Seras redirigido a la pagina inicial en 3 segundos </strong></a>
	 							 <br></br>
	 							 <img src='img/warning.jpg' width='30' height='30'>
					 		</div>";
				
					      		header("Refresh:2; url=busqueda_profesores.php");
					       		
					      }
					      else{
					      	echo "<div class='alert alert-success' align='center' >
	 							 <a href='busqueda_profesores.php' class='alert-info'> <strong> Has ingresado con exito las notas .Seras redirigido a la pagina inicial en 3 segundos </strong> </a> <br></br>
	 			 			 <img src='../img/check.png' width='30' height='30'> 
					 	</div>";
					    $conex3->ejecutar();
					 	header("Refresh:2; url=busqueda_profesores.php");
					    

					      	}
					   }

					   	if($var!=false){

					   	 $conex3->preparar("UPDATE profesor_curso SET $tipo_examen1=2 WHERE codigo_curso='$codigo_curso' and codigo_profesor='$codigo_profe' and codigo_turno= '$codigo_turno'");
					    	
					   	$conex3->ejecutar();
					   	header("Refresh:2; url=busqueda_profesores.php"); }

				  }
				

 ?>

</div></div></div>
