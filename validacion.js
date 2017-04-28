<script>

 
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

	function validar(numero,e){
		 var valor=document.getElementById("nota_examen"+numero).value;
		 


		
		 if(valor<0 || valor>20){
		 	document.getElementById("nota_examen"+numero).value="";
		 	document.getElementById("imagen"+numero).setAttribute("class","glyphicon glyphicon-remove");
		 	return false;
		 	 	
		 }
		 else{
		 	document.getElementById("imagen"+numero).setAttribute("class","glyphicon glyphicon-ok");
		 }
		 
	}
	function verificar(numero){
			elemento=document.getElementById("check"+numero);
			//var numero_post=document.getElementById("nota_examen"+numero);
			if(elemento.checked){
				document.getElementById("nota_examen"+numero).value="-1";
				document.getElementById("nota_examen"+numero).style.display='none';
				document.getElementById("imagen"+numero).setAttribute("class","none");
				 
				 //numero_post.textContent=" ";	 
			}	 
			if(!elemento.checked){
				 document.getElementById("nota_examen"+numero).disabled=false;
				document.getElementById("nota_examen"+numero).style.display='block';
				 document.getElementById("nota_examen"+numero).value="";
			}
	}


</script>