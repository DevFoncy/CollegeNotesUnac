<?php require 'inc/cabecera.php'; 
$ok="123";
if($_POST){	
		$nombre=$_POST['user'];
		$contra=$_POST['password'];
		session_start();
		$conex2= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

		/*Validacion de credenciales*/
		$validar_usuario = $conex2->validar_datos('usuario','credenciales',$nombre);
		$validar_contra= $conex2->validar_datos('contraseña','credenciales',$contra);

		if($validar_usuario==1 && $validar_contra==1){
		
			$_SESSION['user']=$nombre;
			$_SESSION['contra']=$contra;
			$ok="1002";
		}
		/*Cuando no es igual */
		else{			
			$ok="1001";
		}
}

?>

 <!--Ventana principal para el logeo-->

			<div class="container-fluid">
				    <div class="row">
				    	 <div class="col-sm-12 text-center">
				    	 	<div align="center" class="alert alert-info">
                			<h1 class="text-info"> <strong>BIENVENIDO AL SISTEMA DE ADMINISTRACIÓN DE NOTAS</strong> </h1>
                			<div class="row">

                			<div class="col-sm-3 col-sm-offset-1">  <img src="../img/logo_otic.png" width="400" height="120" > </div>
                			<div class="col-sm-2 col-lg-offset-1">  <img src="../img/admin.png" width="120" height="170" > </div>
                			<div class="col-sm-2 col-lg-offset-1 ">  <img src="../img/logo.png" width="400" height="150" > </div>
				    	 	</div>

				    	 </div>
				    </div>
<!--Mensaje de verificacón de usuario-->
<?php 
	if($ok=="1001"){
	echo "<div class='col-md-12'>
			<div class='alert alert-danger' align='center'>
			  <strong><span class='glyphicon glyphicon-remove'> </span> Error!</strong> Datos ingresados incorrectos
			</div> </div> <br>";
			
	}
	else{
		if($ok=="1002"){
		echo "<div class='col-md-12'>
			<div class='alert alert-success' align='center'>
			  <strong><span class='glyphicon glyphicon-ok'> </span> Correcto!</strong> Datos correctos
			<h5>Seras dirigido a tu perfil en 3 segundos </h5> 
			</div>
			</div> 
			<br><br>";

			header("Refresh:2; url=busqueda_profesores.php");
			}

	}
	
 ?>
				    <div class="row">

				        <div class="col-lg-3 col-lg-offset-2">
				          <br><br><br>
				        	<div class="panel panel-default">
							  <div class="alert alert-danger"><strong> INSTRUCCIONES </strong></div>
							  <div class="panel-body">
							    <p class="text-justify" >A continuación le presentamos el sistema para la modificacion de notas de los profesor en cada turno y curso de su respectiva escuela
							    </p>
							    <p class="text-justify" >Debe ingresar su usuario y contraseña que se le ha brindado
							    </p>
							  </div>
							 
							  
							</div>
				        </div>

						<div class="col-lg-6"> 
						 		 
							<div class="container">
							    <div class="">
							    <br><br><br>
							    	<div class="col-md-4 col-md-offset-1">
							    		<div class="panel panel-default">
										  	<div class="panel-heading">
										    	<h3 class="panel-title">Ingrese sus datos aqui	</h3>
										 	</div>
										  	<div class="panel-body">
										    	<form accept-charset="UTF-8" role="form" method="POST" action="index_admin.php" name="form1">
							               
										    	  	<div class="form-group">
										    		    <input class="form-control" placeholder="Usuario" name="user" type="text" required="">
										    		</div>
										    		<div class="form-group">
										    			<input class="form-control" placeholder="Contraseña" name="password" type="password" value="" required="">
										    		</div>
										    		 	<button style="margin-left: 100px; width: 150px;"  type="submit" class="btn btn-primary">Ingresar</button>
										   			 	
										      	</form>
										    </div>
										</div>
									</div>
								</div>
							</div>
					  		
						</div>
						</div>
					</div>
<?php require 'inc/footer.inc'; ?>

