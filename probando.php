<?php require 'inc/cabecera.inc'; ?>

<?php 

   //session_start();
   //print_r($_SESSION['array']);
					require 'conexion.php';
					require 'Database.php';

				    $ex_parcial1=$_POST['ex_parcial'];

				     $codigo_nota=$_POST['codigo_nota'];
				     
				    $name_tipo= "ex_parcial";	

				   /* foreach($ex_parcial1 as $e){

				      echo $e . "<br>";
				    }

				     foreach($codigo_nota as $codigo){

				      echo $codigo . "<br>";
				    }


				    print_r($ex_parcial1[1]);*/
				    $size = count ($ex_parcial1);
				    echo "<br>".$size;
					
				    $conex3= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

				    for( $i=0;  $i< $size; $i++){
				       //$conex3->preparar("REPLACE INTO nota(codigo_nota, $name_tipo) VALUES ($codigo_nota[$i],$ex_parcial1[$i])");	
				       $conex3->preparar("UPDATE nota SET $name_tipo=$ex_parcial1[$i] WHERE codigo_nota=$codigo_nota[$i]");
				       $conex3->ejecutar();
				    }
 ?>



<?php require 'inc/footer.inc'; ?>