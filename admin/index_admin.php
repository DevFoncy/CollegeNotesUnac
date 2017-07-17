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

<div class="row" style="padding-top: 20px;">
 <div class="col-sm-3 col-sm-offset-1">  <img  src="../img/logo_otic.png" width="400" height="120" > </div>
 <div class="col-sm-2 col-lg-offset-1" style="margin-top: -40px;">  <img src="../img/admin.png" width="120" height="170" > </div>
</div>

<div class="row" align="center">
		<div class="col-md-5">
			<div class="panel panel-default">
			<div class="panel-body">
			<h4 style="color: red;">INSCRIPCIÓN</h4>
			<button class="boton_hover" type="button">Examen de Admisión</button> <br /><br />
			<h4><span style="color: #ff0000;">VERIFICACIÓN DE INSCRIPCIÓN</span></h4>
			<button class="boton_hover" type="button">Verificar</button> <br /><br />
			<h4><span style="color: #ff0000;">RESULTADOS DE EXAMEN</span></h4>
			<button class="boton_hover" type="button">Ver Resultados</button> <br /><br /></div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-4">
					 <img  src="../img/huella.gif"  width="200" height="70">
					 <h3>Flujograma de inscripción</h3>	
					 <p>La inscripción para las diferentes modalidades es vía internet mediante los siguientes pasos...</p>
				</div>
				<div class="col-md-4">
					  <img  src="../img/instru.png" width="200" height="150" >	
					  <h3>Instrucciones</h3>	
					  <p>El examen de Admisión comprende una prueba que incluye preguntas de aptitud académica ...</p>
				</div>
				<div class="col-md-4">
						 <img  src="../img/temario.png" width="200" height="150" >
						 <h3>Temario</h3>

				</div>

			</div>
		</div>
</div>

<button class="boton_imagen">
	
</button>


<div class="row" align="center">
		<div class="col-md-5">
				<div class="panel panel-default">
				<div class="panel-body">
				<h4 style="color: red;">INSCRIPCIÓN</h4>
				<button class="boton_hover" type="button">Examen de Admisión</button> <br /><br />
				<h4><span style="color: #ff0000;">VERIFICACIÓN DE INSCRIPCIÓN</span></h4>
				<button class="boton_hover" type="button">Verificar</button> <br /><br />
				<h4><span style="color: #ff0000;">RESULTADOS DE EXAMEN</span></h4>
				<button class="boton_hover" type="button">Ver Resultados</button> <br /><br /></div>
				</div>
				</div>
		<div class="col-md-7">
		<div class="panel panel-default">
		<div class="panel-body">
		<div class="col-md-4"><button class="flujo"></button>
		<h3>Flujograma de inscripción</h3>
		<p>La inscripción para las diferentes modalidades es vía internet mediante los siguientes pasos...</p>
		</div>
		<div class="col-md-4"><button class="tema"></button>
		<h3>Instrucciones</h3>
		<p>El examen de Admisión comprende una prueba que incluye preguntas de aptitud académica ...</p>
		</div>
		<div class="col-md-4"><button class="instru"></button>
		<h3>Temario</h3>
		</div>
		</div>
</div>

<div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.7296456045347!2d-77.119219484738!3d-12.062113345471465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105cbeed7c0f247%3A0x2fe368e8fd6d30af!2sJuan+Pablo+II%2C+Bellavista+07011!5e0!3m2!1ses!2spe!4v1500059344627" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>


<div class="row">
	<div class="col-md-6">
	<iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.7296456045347!2d-77.119219484738!3d-12.062113345471465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105cbeed7c0f247%3A0x2fe368e8fd6d30af!2sJuan+Pablo+II%2C+Bellavista+07011!5e0!3m2!1ses!2spe!4v1500059344627" width="600" height="450" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
	</div>
	<div class="col-md-5 col-md-offset-1">
		<h2>Informes</h2>
		<h4><strong>Horario de Atención</strong>Lunes-Viernes : 8:00 - 4:45 </h4>
		<h4><strong>Teléfono</strong> 652-1399 | 652-1398 | 453-3005</h4>
		<h5>Ciudad Universitaria Av. Juan Pablo II Nº306, Bellavista-Callao, Pabellón de Telemática 1er. piso</h5>

	</div>

</div>