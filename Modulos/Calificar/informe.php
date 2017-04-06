<?php
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
	include_once "../class_buscar.php";
	
	if(!empty($_GET['cod']) and !empty($_GET['periodo'])){
		$id_periodo=decrypt($_GET['periodo'],'Valorar_Alumno');
		$id_alumno=decrypt($_GET['cod'],'Valorar_Alumno');
		$id_periodo=substr($id_periodo,5);
		$id_alumno=substr($id_alumno,5);
		$oPeriodo=new Consultar_Periodo($id_periodo);
		$oAlumno=new Consultar_Alumno($id_alumno);	
		$nombre_alumno=$oAlumno->consultar('nombre');
		
		$oGrado= new Consultar_Grado($oAlumno->consultar('grado'));
		$oSalon= new Consultar_Salon($oAlumno->consultar('salon'));
		
		$nombre_salon=$oSalon->consultar('nombre');
		$nombre_grado=$oGrado->consultar('nombre');
		
		$oEmpresa= new Consultar_Empresa('1');
		
		$dir='Direccion: '.$oEmpresa->consultar('direccion').'<br>'.$oEmpresa->consultar('pais').' - '.$oEmpresa->consultar('ciudad');
		
		$regresar=encrypt('ABCDF'.$oAlumno->consultar('salon'),'Salon_Valorar');#5
	}else{
		header('Location:error.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
	function imprimir(){
	  var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
	  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
	  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
	  ventana.document.close();  //cerramos el documento
	  ventana.print();  //imprimimos la ventana
	  ventana.close();  //cerramos la ventana
	}
</script>
<title><?php echo $nombre_alumno; ?></title>
</head>

<body>
	<strong>
        <h3 align="center">
        <a href="index.php?salon=<?php echo $regresar; ?>" title="Regresar al Listado de Alumnos">
            &lt;&lt; Regresar
        </a> | 
        <button onclick="imprimir();">
            Imprimir Informe
        </button>
        </h3>
    </strong>	
    <div align="center" id="imprimeme">
        <table width="90%" style="font-family:Arial, Helvetica, sans-serif">
          <tr>
            <td width="50%"><center><img src="../../img/logo.png" width="207" height="200" alt="" /></center></td>
            <td colspan="2">
            	<div align="center">
            	<p><?php echo $oEmpresa->consultar('empresa'); ?></p>
                <p>Nit: <?php echo $oEmpresa->consultar('nit'); ?></p>
                <p><?php echo $dir; ?></p>
                <p>Tel: <?php echo $oEmpresa->consultar('tel'); ?> Fax: <?php echo $oEmpresa->consultar('fax'); ?></p>
                <p><?php echo $oEmpresa->consultar('web'); ?></p>
                </div>
            </td>
          </tr>
          </table>
          <br />
          <table width="90%" rules="all" border="1" style="font-family:Arial, Helvetica, sans-serif">
          <tr>
            <td><br />
            	<center><strong>Nombre del Alumno</strong><br /><?php echo $nombre_alumno; ?></center>
            </td>
            <td width="25%"><center><strong>Grado</strong><br /><?php echo $nombre_grado; ?></center></td>
            <td width="25%"><center><strong>Salon<br /></strong><?php echo $nombre_salon; ?></center></td>
          </tr>
          <tr>
            <td colspan="3"><br /><center><strong>Informe del Periodo <?php echo $oPeriodo->consultar('nombre'); ?></strong></center></td>
          </tr>
          </table>
          <bR />
          <table width="90%" rules="all" border="1" style="font-family:Arial, Helvetica, sans-serif">
          <tr>
            <td width="50%"><strong><center>Materia</center></strong></td>
            <td width="50%"><strong><center>Calificacion</center></strong></td>
          </tr>
          <?php 
		  	$pa=mysql_query("SELECT * FROM calificar WHERE alumno='$id_alumno' and periodo='$id_periodo'");				
			while($row=mysql_fetch_array($pa)){
				$oMateria=new Consultar_Materias($row['materia']);
		  ?>
          <tr>
            <td><center><?php echo $oMateria->consultar('nombre'); ?></center></td>
            <td><center><?php echo $row['nota']; ?></center></td>
          </tr>
          <?php } ?>
        </table>
    </div>
</body>
</html>