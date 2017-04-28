<?php  require 'inc/cabecera.inc'; 
	   require 'conexion.php';
	   require 'Database.php';
	   require 'confirmacion.js';
	   require 'validacion.js';
		$curso_m = $_POST['curso'];
		$turno_m = $_POST['turno'];
		$nombre_m = $_POST['nombre'];
		$seleccion_m = $_POST['sel'];
		$codigo_profe=$_POST['cod_profe'];

		$codigo_facultad=$_POST['codigo_facultad'];
	
		


		if($seleccion_m == "ef"){
				    		$name_tipo = "ex_final";
				    	}
				    	else{
				    		if($seleccion_m == "ep"){
				    		$name_tipo= "ex_parcial";
				    		}
				    		else{
				    			if($seleccion_m == "p1"){
				    				$name_tipo = "pc1";
				    			}
				    			else{
				    				if($seleccion_m == "p2"){
								    		$name_tipo= "pc2";
								    	}
								    	else{
								    		if($seleccion_m == "p3"){
									    		$name_tipo = "pc3";
									    	}
									    	else{
												if($seleccion_m == "p4"){
										    		$name_tipo= "pc4";
										    	}
										    	else{
										    		if($seleccion_m == "lab"){
											    		$name_tipo = "laboratorio";
											    	}
											    	else{
											    		if($seleccion_m == "s"){
												    		$name_tipo = "susti";
												    	}
											    	}

										    	}

									    	}

								    	}

				    			}
				    		}

				    	}

	  $conex2= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	  $conex2->preparar("SELECT $name_tipo FROM profesor_curso  WHERE codigo_turno='$turno_m' and codigo_curso='$curso_m' and codigo_profesor='$codigo_profe'");
	  $conex2->ejecutar();
	  $conex2->prep()->bind_result($aviso);

	  while($conex2->resultado()){
	  			$var=$aviso;                  
			}
	  /*si var = 0 significa que no se ha ingresado notas aca 
	    si es 1 significa que si se ingreso notas*/



?>

<div class="container-fluid">
	    <div class="row">
	    	<div class="col-lg-4">
				        	<div class="panel panel-default">
							  <div class="alert alert-danger" align="center"><strong>INDICACIONES</strong></div>
							 
							  <ul class="list-group" ><strong>
							    <li class="list-group-item">Usted puede ingresar notas enteras como decimales usando una punto --> Ejemplo : 12.3  09.5 </li>
							    <li class="list-group-item">En caso el alumno no haya rendido el examen o no este en el curso machucar NSP( No se presento ) </li>
							    <li class="list-group-item">Cuando finalice de ingresar las notas dar clic en GUARDAR NOTAS</li>
							    <li class="list-group-item">Confirme su accion con el botón continuar</li>
							    <li class="list-group-item">Si no esta seguro presione Cancelar para hacer alguna modificación</li>					    
							    </strong>
							  </ul>
							  
							</div>

							<div  align="center">
							  	<a type="button" class="btn btn-default" href="index.php">
								      <span class="glyphicon glyphicon-step-backward"></span><strong> REGRESAR A LA PÁGINA PRINCIPAL </strong>
								</a>						  
							</div>
		    </div>
	    	
			<div class="col-sm-7">
					<div class="panel-body">
				     <table class="table table-bordered">
		                  <tr class="info">
		                    <td>
								<h2><img src="img/calificar.png" width="80" height="80">Listado de Alumnos del Grupo <?php echo " ".$turno_m."(".$name_tipo.")" ?> </h2>
								<h4>Curso : <?php echo $nombre_m ?></h4>								
		                    </td>
		                  </tr>
                	</table> 

<?php 
		
	
      //  $iterador=0;
       //FIME
	    if($codigo_facultad==101){
	    	$conex2->preparar("SELECT m.codigo_alumno, CONCAT(a.apellido_paterno,' ',a.apellido_materno,' ',a.nombre_alumno), n.codigo_nota, n.$name_tipo FROM matricula m , alumno a, nota n WHERE n.codigo_curso='$curso_m' and m.codigo_turno='$turno_m' and m.codigo_alumno=a.codigo_alumno and n.codigo_alumno=m.codigo_alumno and m.codigo_docente='$codigo_profe' ORDER BY a.apellido_paterno");
	    }
	    else{

	    //ADMINISTRACION
	    	

	    	$conex2->preparar("SELECT m.codigo_alumno, CONCAT(a.apellido_paterno,' ',a.apellido_materno,' ',a.nombre_alumno), n.codigo_nota, n.$name_tipo FROM matricula_fca m , alumno_fca a, nota_fca n WHERE m.codigo_curso=$curso_m and m.codigo_turno='$turno_m' and m.codigo_alumno=a.codigo_alumno and m.codigo_docente='$codigo_profe' and m.codigo_matricula=n.codigo_matricula ORDER BY a.apellido_paterno");
	    }
 
		
		$conex2->ejecutar();
		$conex2->prep()->bind_result($cod_alum1,$nombre_alum1, $codigo_nota1,$nota);

		 echo "<table class='table table-bordered'>
								 		 		<thead>
								 		 			<tr class='info'>

								 		 			<td> <strong> CODIGO </strong></td>

								 		 			<td> <strong>APELLIDO Y NOMBRES DEL ALUMNO </strong> </td>

								 		 			<td colspan='3' align='center'> <strong> NOTA  </strong></td>

								 		 			</tr>
								 		 		 <tbody>
								 		 	  ";
	    echo "<form name='formAjax' action='probando.php' method='POST' id= 'formAjax' > " ;	
		
	    
	    echo "<div id='dialogoFormulario' title='Atención' style='display:none;'>
				<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'>
				</span>¿Realmente desea enviar el contenido de este formulario?</p>
			</div>
		";
		$i=0;

		while($conex2->resultado()){
			if($var==1){
				echo "
				  <tr>
				  		 <td>$cod_alum1</td>
						 <td>$nombre_alum1</td>
						 <td>$nota</td>

				  </tr>

				
		  ";
			}
			else{
				echo "
				  <tr>
				  		 <td>$cod_alum1</td>
						 <td>$nombre_alum1</td>	
						 <td> <span  id='imagen".$i."'</span></td>	
						 <td> 
						 <input type='number' id='nota_examen".$i."' name='tipo_examen[$i]' onkeypress='return stopTab(event, $i);' onchange='validar($i)' min='0' max='20' step='any' required> 
						 </td>
						 <td> <div class='checkbox'> <label>
						 <input id='check".$i."'  type='checkbox'  onclick='verificar($i)'>NSP
						 </label> 
						 </div> 
						 </td>
						 <input type='text' name='codigo_nota[]' value='$codigo_nota1' hidden >
						 <input type='text' name='codigo_facultad' value='$codigo_facultad' hidden >
						 <input type='text' name='seleccion' value='$name_tipo' hidden >			 
						 <input type='text' name='codigo_profe' value='$codigo_profe' hidden>	
						 <input type='text' name='codigo_turno' value='$turno_m' hidden>	
						 <input type='text' name='codigo_curso' value='$curso_m' hidden>

						 		
				  </tr>


				
		 		 ";


		         $i++;
		    
			}

			
		  //array_push($array,"ex_parcial");
		
		}
		    echo "<input type='number' id='acumulador' value='$i' hidden>";
			echo " <div align='center'> <strong> Usted puede registrar nota de  ".$i." alumnos <strong> </div>";
		//$_SESSION['array'] = $array;
	          
		echo " </tbody>
	           </table>";
        if($var==1){
        					echo "<div class='alert alert-warning'>
								  <h4 href='#'' class='alert-danger' align='center'> Usted ya registro nota aca </h4>
						</div>";

        		// echo  " <div align='right'  role='toolbar'>
								  //  <div class='btn-group'>
								  //   <a type='button' class='btn btn-default'>
								  //     <span class='glyphicon glyphicon-phone-alt'></span> Solicitar Cambio de notas 
								  //   </a>
								  //    </form>
	         //   			</div>
	           			
	           
	    
        }
        else{
        		echo  " <div align='right'  role='toolbar'>
								  
								  <div class='btn-group'> 
								    <input id='' class='boton' type='submit' value='Continuar' hidden></input>


								    <button id=formu class='btn btn-default' value='Continuar' >
								      <span class='glyphicon glyphicon-floppy-disk'></span> Guardar Notas 
								    </button>
								    
								     </form>
	           </div>
	          
	           ";
	    
        }
         $conex2->cerrar_conex();
	   ?>

			

        </div>

		

   </div>
</div>

<?php
 require 'inc/footer.inc'; ?>
	