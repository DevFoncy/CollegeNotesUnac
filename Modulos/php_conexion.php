<?php
	
	$conexion = mysql_connect("localhost","root","");
	mysql_select_db("2013school",$conexion);
	date_default_timezone_set("America/Bogota");
    mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER_SET utf");
	$s='$';
	
	$paa=mysql_query("SELECT * FROM empresa WHERE id=1");					
	if($dato=mysql_fetch_array($paa)){
		$maxima_nota=$dato['maxima'];
		$minima_nota=$dato['minima'];
	}
	
	
	function limpiar($tags){
		

		return $tags;
	}

	
?>