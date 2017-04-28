<?php 
require 'conexion.php';
require 'Database.php';
$conex= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
session_start();
if(isset($_REQUEST['cod'])){
	$codigo= $_GET['cod'];
   // $undefined=$_GET['undefined'];
	$undefined=123;
    //$undefined2 = round(microtime(true));
    //$r1= $undefined2-5;
    //$r2=$undefined2+5;
}
else
	$codigo='';

		if($codigo=='')
	 		echo "USUARIO NO REGISTRADO EN LA AULA VIRTUAL";

		else
		{ 
			  //echo strlen($codigo);
			//&& ($undefined>$r1 && $undefined<$r2)
			if(strlen ($codigo)==4){
				$_SESSION['codigo']=$codigo;
				$_SESSION['undefined']=$undefined;
				header('Location: index.php');

?>			 
					
<?php
					//echo "ok";
			}

			else{
				echo "no tiene 4 digitos";
				$_SESSION['codigo']=$codigo;
				$_SESSION['undefined']=$undefined;

				header('Location: index2.php');

				}
		}
?>