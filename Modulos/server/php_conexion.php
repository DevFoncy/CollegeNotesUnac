<?php
	
	$conexion = mysql_connect("localhost","softunic_USU","america2007");
	mysql_select_db("softunic_colegio",$conexion);
	date_default_timezone_set("America/Bogota");
    mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER_SET utf");
	$s='$';
	
	function limpiar($tags){
		$tags = strip_tags($tags);
		$tags = stripslashes($tags);
		$tags = htmlentities($tags);
		return $tags;
	}

	
?>