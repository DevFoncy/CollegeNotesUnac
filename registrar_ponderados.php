<?php require 'inc/cabecera.inc'; ?>



<?php 
		require 'conexion.php';
		require 'Database.php';
		 $conex= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

		 $codigo=$_GET['coddoc'];

		 if(isset($_REQUEST['envia'])!='')
		 	$envia=$_POST[envia];
		 else
		 	$envia='';





         $validar_profe =  $conex->validar_datos('codigo_profesor','peso',$codigo);
         if($validar_profe>=1){

         	echo "ustede ya registro su peso";



         }
         else{

           if($envia=='ok'){

           }
           else{
         	echo "necesita registrar";
				}

         }


		
?>
						 	
						 		    	<form action="registrar_ponderados.php?coddoc=$codigo" enctype="multipart/form-data" method="POST" role="form">
						 		        <legend>Registrar ponderados</legend>

										<div class="form-group">
						 		 			<input name = parcial type="number" class="form-control" id="" placeholder="Peso Parcial">
						 		 		</div>
						 		 		<div class="form-group">
						 		 			<input name = Final type="number" class="form-control" id="" placeholder="Peso Final">
						 		 		</div>
						 		 		<div class="form-group">
						 		 			<input name = pc1 type="number" class="form-control" id="" placeholder="Peso PC1">
						 		 		</div>
						 		 		<div class="form-group">
						 		 			<input name = pc2 type="number" class="form-control" id="" placeholder="Peso PC2">
						 		 		</div>
						 		 		<div class="form-group">
						 		 			<input name = pc3 type="number" class="form-control" id="" placeholder="Peso PC3">
						 		 		</div>
						 		 		<div class="form-group">
						 		 			<input name = pc4 type="number" class="form-control" id="" placeholder="Peso PC4">
						 		 		</div>	
						 		 		<div class="form-group">
						 		 			<input name = labo type="number" class="form-control" id="" placeholder="Peso Labo">
						 		 		</div>
						 		 		<div class="form-group">
						 		 			<input name = envia type="text" class="form-control" id="" value="ok" hidden>
						 		 		</div>
						 		 		
						 		 		<button type="submit" class="btn btn-primary">Registrar</button>
						 		 	</form> 


<?php require 'inc/footer.inc'; ?>