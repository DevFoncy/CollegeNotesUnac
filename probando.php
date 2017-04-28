<?php require 'inc/cabecera.inc'; ?>
<div class="container-fluid">
	    <div class="row">
	    	<div class="col-md-6 col-md-offset-3">
<?php 

   //session_start();
   //print_r($_SESSION['array']);
					require 'conexion.php';
					require 'Database.php';
					$aviso=false;
					$var=true;

				    $tipo_examen=$_POST['tipo_examen'];
				    $codigo_nota=$_POST['codigo_nota'];
				    $tipo_examen1= $_POST['seleccion'];
				    $codigo_profe = $_POST['codigo_profe']; 
					$codigo_turno = $_POST['codigo_turno'];
					$codigo_curso = $_POST['codigo_curso'];
					$codigo_facultad= $_POST['codigo_facultad'];
				 
				    //$name_tipo= "ex_parcial";	
				    //echo $tipo_examen1 ."<br>";
				    //echo $codigo_profe."<br>";
					//echo $codigo_turno."<br>";
					//echo $codigo_curso."<br>";
		           // var_dump($tipo_examen);
				   foreach($tipo_examen as $codigo){	
					    					    
				  if(($codigo<-1 || $codigo>20) || $codigo==""){
				      echo "<div class='alert alert-success' align='center' >
 					 		<a href='#' class='alert-warning'> <strong> Hubo un error al ingresar las notas intentalo nuevamente. Seras redirigido a la pagina inicial en 3 segundos</strong></a> <br></br>
 			 				<img src='img/warning.jpg' width='30' height='30'>
				 		</div>";
				  		header("Refresh:3; url=index.php");
				  		$aviso=true;
				  	}
				  }
		
				 if($aviso==false){
					   $size = count ($tipo_examen);	// cantidad de notas de	
		    		   $conex3= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);


					   for( $i=0;  $i< $size; $i++){
					     	
					      if($codigo_facultad==101){
					      	     if($tipo_examen[$i]==-1){
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
	 							 <a href='#' class='alert-danger'><strong> Hubo un error al ingresar las notas intentalo nuevamente. Seras redirigido a la pagina inicial en 3 segundos </strong></a>
	 							 <br></br>
	 							 <img src='img/warning.jpg' width='30' height='30'>
					 		</div>";
				
					      		header("Refresh:3; url=index.php");
					       		
					      }
					      else{
					      	echo "<div class='alert alert-success' align='center' >
	 							 <a href='#' class='alert-info'> <strong> Has ingresado con exito las notas .Seras redirigido a la pagina inicial en 3 segundos </strong> </a> <br></br>
	 			 			 <img src='img/check.png' width='30' height='30'> 
					 	</div>";
					 $conex3->ejecutar();
					 	header("Refresh:5; url=index.php");
					    

					      	}
					   }

					   	if($var!=false){
					   	 $conex3->preparar("UPDATE profesor_curso SET $tipo_examen1=1 WHERE codigo_curso='$codigo_curso' and codigo_profesor='$codigo_profe' and codigo_turno= '$codigo_turno'");
					    	
					   	$conex3->ejecutar();
					   	header("Refresh:1; url=index.php"); }

				  }

 ?>

</div></div></div>

<?php require 'inc/footer.inc'; 

        //RewriteRule ^fime/otic/(.*).html?$  prueba.html [NC,L]  ?>