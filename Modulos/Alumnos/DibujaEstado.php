<?php
	include_once('../php_conexion.php');
	$filtro	= $_GET['filtro'];
	if($filtro!=0){
		echo '<select name="salon" onchange="estado(this.value);">';
		echo '<option value="0">---SELECCIONE---</option>';
		$sql = "SELECT * FROM salon WHERE grado='".$filtro."'";
		$rs  = mysql_query($sql,$conexion);
		if(mysql_num_rows($rs)!=0){
			while($row=mysql_fetch_assoc($rs)){		
				echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
			}
		}
		echo '<option value="x">Sin Salon</option>';
		echo '</select>';
	}else{
		echo '<select name="salon" disabled class="row-fluid">';
		echo '<option value="0">---SELECCIONE---</option>';
		echo '</select>';
	}

?>


