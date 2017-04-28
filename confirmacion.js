<script type="text/javascript">
$(document).ready(function(){
  
   $acumu=$("#acumulador").val()
	$("#formu").click(function(){
		$aviso=true;
		for($i=0;$i<$acumu;$i=$i+1){
			$nota_actual=$("#nota_examen"+$i).val();
			if($nota_actual!="" ){
				//$aviso=true;
			}
			else{
				$aviso=false;
			}
			
		}
	 if($aviso==false){
	 	sweetAlert("Oops...", "Mal ingreso de datos / Falta llenar datos", "error");
	 }

	
	else{

	
	// Damos formato a la Ventana de Diálogo	
				$('#dialogoFormulario').dialog({
					// Indica si la ventana se abre de forma automática
					autoOpen: false,
					// Indica si la ventana es modal
					modal: true,
					// Largo
					width: 350,
					// Alto
					height: 'auto',
					buttons: {
						"Continuar": function() {
							// Cerramos el diálogo
							
							document.formAjax.submit();		
						},
						'Cancelar': function() {
							// Cerramos el diálogo
							$( this ).dialog( "close" );
						}
					}
				});
	
	// Validamos el formulario
				$('#formAjax').validate({
					submitHandler: function(){
						
						// Abrimos el diàlogo de confirmación
						$('#dialogoFormulario').dialog('open');
						
						// Evitamos que se envíe el formulario
						return false;
						
					},
					

				});
	}


});
});


</script>