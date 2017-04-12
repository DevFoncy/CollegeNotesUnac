<?php require 'inc/cabecera.inc'; ?>

<?php 

   //session_start();
   //print_r($_SESSION['array']);
					require 'conexion.php';
					require 'Database.php';

				    $tipo_examen=$_POST['tipo_examen'];
				    $codigo_nota=$_POST['codigo_nota'];
				    $tipo_examen1= $_POST['seleccion'];
				    $codigo_profe = $_POST['codigo_profe']; 
					$codigo_turno = $_POST['codigo_turno'];
					$codigo_curso = $_POST['codigo_curso'];
				     
				    //$name_tipo= "ex_parcial";	
				    echo $tipo_examen1 ."<br>";
				    echo $codigo_profe."<br>";
					echo $codigo_turno."<br>";
					echo $codigo_curso."<br>";

 

				   /* foreach($ex_parcial1 as $e){

				      echo $e . "<br>";
				    }

				     foreach($codigo_nota as $codigo){

				      echo $codigo . "<br>";
				    }


				    print_r($ex_parcial1[1]);*/
				    $size = count ($tipo_examen);
				    //echo "<br>".$size;
					
				    $conex3= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

				    for( $i=0;  $i< $size; $i++){
				       //$conex3->preparar("REPLACE INTO nota(codigo_nota, $name_tipo) VALUES ($codigo_nota[$i],$ex_parcial1[$i])");	
				       $conex3->preparar("UPDATE nota SET $tipo_examen1=$tipo_examen[$i] WHERE codigo_nota=$codigo_nota[$i]");
				       $conex3->ejecutar();
				    }

				     //segundo update

				    	 $conex3->preparar("UPDATE profesor_curso SET $tipo_examen1=1 WHERE codigo_curso=$codigo_curso and codigo_profesor=$codigo_profe and codigo_turno= '$codigo_turno'");
				    	$conex3->ejecutar();


 ?>



<?php require 'inc/footer.inc'; ?>