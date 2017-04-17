<script type="text/javascript">
$(document).ready(function(){

	$("#formu").click(function(){
	
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
		errorPlacement: function(error, element) {
			error.appendTo(element.prev("span").append());
		}
	});
	});
});


</script>