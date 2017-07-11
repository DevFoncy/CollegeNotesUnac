<script type="text/javascript">
$(document).ready(function(){
   
   $acumu=$("#acumulador").val()
	
	$("#formu").click(function(){
		$aviso=true;
		for($i=0;$i<$acumu;$i=$i+1){
			$nota_actual=$("#nota_examen"+$i).val();
			if($nota_actual!="" ){
				
			}
			else{
				$aviso=false;
			}			
		}


	if($aviso==false){
		sweetAlert("Oops...", "Falta ingresar notas ", "error");
	
	}
	else{
		swal({
			  title: "Estas Seguro que deseas registrar esta informacion?",
			  text: " ",
			  type: "info",
			  showCancelButton: true,
			  confirmButtonColor: "#91B0EF",
			  confirmButtonText: "Si, deseo registrar todas las notas cambiadas",
			  closeOnConfirm: false
			},
			function(){
				document.getElementById("formEnvio").submit();
			});
	}
});


});


</script>