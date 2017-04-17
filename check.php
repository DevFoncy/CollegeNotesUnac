<?php 
require 'conexion.php';
require 'Database.php';
$conex= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
session_start();
if(isset($_REQUEST['cod']))
	$codigo= $_GET['cod'];
else
	$codigo='';

if($codigo=='')
	echo "NO SE RECONOCE EL USUARIO";
else
{ 
	  //echo strlen($codigo);
	if(strlen ($codigo)==4){
		$_SESSION['codigo']=$codigo;
		header('Location: index.php');

?>			 
			
<?php
			//echo "ok";
	}
	else{
		echo "no tiene 4 digitos";
		$_SESSION['codigo']=$codigo;
		header('Location: index2.php');

	}
}
?>