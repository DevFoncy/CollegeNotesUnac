<?php require 'inc/cabecera.php'; 
session_start();
$user=$_SESSION['user'];

	  $conex3= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	  /*Busqueda de el nombre de la escuela*/
	  $conex3->preparar("SELECT e.nombre,c.codigo_escuela FROM escuela e, credenciales c  WHERE c.usuario='$user' and e.id=c.codigo_escuela");
	  $conex3->ejecutar();
	  $conex3->prep()->bind_result($nombre_escuela,$codigo_escuela);

	  while($conex3->resultado()){
	  			             
			}

if($_POST){	
	  $codigo_escuela=$_POST['codigo_escuela'];
	  $codigo_profe=$_POST['codigo_profe'];
		/*Busqueda de los cursos que dicta el profesor*/
	  
	  $conex3->preparar("SELECT c.nombre_curso, pc.codigo_turno, p.apellido_profesor,p.nombre_profesor FROM profesor p, profesor_curso pc, curso c WHERE pc.codigo_profesor='$codigo_profe' and pc.codigo_curso=c.codigo_curso and pc.codigo_profesor=p.codigo_profesor and c.codigo_escuela=");
	  $conex3->ejecutar();
	  $conex3->prep()->bind_result($nombre_escuela);

	  while($conex3->resultado()){
	  			             
			}

}
 ?>

 <div class="container-fluid">
				    <div class="row">
				    	 <div class="col-sm-12 text-center">
				    	 	<div align="center" class="alert alert-info">
                			<h1 class="text-info"> Sistema de Administración de Notas <strong>ESCUELA:</strong> <?php echo $nombre_escuela; ?> </h1>
                			<div class="row">

                			<div class="col-sm-3 col-sm-offset-1">  <img src="../img/logo_otic.png" width="400" height="120" > </div>
                			<div class="col-sm-2 col-lg-offset-1">  <img src="../img/admin.png" width="120" height="170" > </div>
                			<div class="col-sm-2 col-lg-offset-1 ">  <img src="../img/logo.png" width="400" height="150" > </div>
				    	 	</div>

				    	 </div>
				    	</div>

					</div>

				<div class="col-sm-4 col-sm-offset-4">
					<div class="row">
							<form action="busqueda_profesores.php" method="POST" role="form">
	
								<label>INGRESE EL CÓDIGO DEL PROFESOR AQUI ---> </label>
								<input type="text" name="codigo_profe" placeholder="" required="">
								<input type="text" name="codigo_escuela" hidden="">
								<button style="margin-left: 350px; margin-top: 20px; width: 150px; height: 30PX;"  type="submit" class="btn btn-info"><span class="glyphicon glyphicon-zoom-in"></span> BUSCAR</button>
							</form>
					</div>
				</div>
				
</div>
<?php require 'inc/footer.inc'; ?>