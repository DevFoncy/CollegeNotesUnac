<?php require 'inc/cabecera.inc'; ?>
<div class="container-fluid">
	    <div class="row">
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-body">


<?php 
		require 'conexion.php';
	    require 'Database.php';

		$curso_m = $_POST['curso'];
		$turno_m = $_POST['turno'];
		$nombre_m = $_POST['nombre'];
		$seleccion_m =  $_POST['sel'];

		echo $seleccion_m;

		echo $curso_m;
		echo $turno_m;
        $iterador=0;
     


		$conex2= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$conex2->preparar("SELECT m.codigo_alumno, a.nombre_alumno, n.codigo_nota  FROM matricula m , alumno a, nota n WHERE m.codigo_curso=$curso_m and m.codigo_turno='$turno_m' and m.codigo_alumno=a.codigo_alumno and n.codigo_alumno=m.codigo_alumno");
		$conex2->ejecutar();
		$conex2->prep()->bind_result($cod_alum1,$nombre_alum1, $codigo_nota1);

		 echo "<table class='table table-cell'
								 		 		<thead>
								 		 			<tr>

								 		 			<td> Codigo Alumno </td>

								 		 			<td> nombre alumno </td>

								 		 			<td> tipo de examen </td>



								 		 			</tr>
								 		 		 <tbody>
								 		 	  ";
	    echo "<form action='probando.php' method='POST' role='form'>";	
	    //$pila=array("123");
	    //print_r($pila);
	    //session_start();
	    //$array=array("");
		while($conex2->resultado()){
		
			echo "
				  <tr>
				  		 <td>$codigo_nota1</td>
						 <td>$cod_alum1</td>
						 <td>$nombre_alum1</td>
						 <td> <input type='text' name='ex_parcial[]' > </td>
						 <td> <input type='text' name='codigo_nota[]' value='$codigo_nota1' hidden ></td>
						 
				  </tr>

				
		  ";
		  //array_push($array,"ex_parcial");

		}
	
		//$_SESSION['array'] = $array;
		echo "<button type='submit' class='btn btn-primary pull-right'>Ingresar</button>
		      </form>";



        ?>

			 		</div>
				</div>    	 
			</div>
		</div>
	</div>


<?php require 'inc/footer.inc'; ?>