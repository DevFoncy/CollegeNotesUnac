<script>

	function cambiar(numero){
		var r=confirm("Estas seguro que deseas realizar cambios en esta Nota?");

		if(r==true){
			document.getElementById("nota_examen"+numero).value="";
			document.getElementById("nota_examen"+numero).removeAttribute("readonly", false);
			document.getElementById("nota_examen"+numero).setAttribute("style","background-color:#E89292");
			document.getElementById("nota_examen"+numero).setAttribute("type","number");
		}
		else{

		}
	}
	
	
	function limpiardatos(){
		var r=confirm("Deseas deshacer los cambios realizados");
		if(r==true){
		 location.reload(true);
		}
	}

	function validar(numero,e){
		 var valor=document.getElementById("nota_examen"+numero).value;
		 

	
		 if(valor<0 || valor>20 ){
		 	document.getElementById("nota_examen"+numero).value="";
		 	document.getElementById("imagen"+numero).setAttribute("class","glyphicon glyphicon-remove");
		 
		 	return false;
		 	 	
		 }
		 else{
		 	document.getElementById("imagen"+numero).setAttribute("class","glyphicon glyphicon-ok");
		 }
		 
	}
	function stopTab( e,indice ) {
    var acumulador=document.getElementById("acumulador").value; //7
    var indicador=indice+1;       
	  if(indicador==acumulador){
	    	var evt = e || window.event
	    	if ( evt.keyCode === 13 ) {
	     		return false
	    	}

	    }
	}
	function verificar(numero){
			elemento=document.getElementById("check"+numero);
			//var numero_post=document.getElementById("nota_examen"+numero);
			if(elemento.checked){
				var r=confirm("Estas seguro que el alumno no se presento?");
				if(r==true){
				document.getElementById("nota_examen"+numero).value="NSP";;
				document.getElementById("nota_examen"+numero).setAttribute("style","background-color:#E89292");
				}
				else{
				document.getElementById("check"+numero).checked=false;
				}
			}	 
			
	}



</script>