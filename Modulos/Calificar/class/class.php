<?php

class Proceso_Calificar{
    var $id;    	var $materia;      var $alumno;       	var $actividad;		var $valor;
	var $periodo;	var $fecha;
    
    function __construct($id, $materia, $alumno, $actividad, $valor, $periodo, $fecha){
        $this->id=$id;      		$this->materia=$materia;    
		$this->alumno=$alumno;		$this->actividad=$actividad;  
		$this->valor=$valor;		$this->periodo=$periodo;			$this->fecha=$fecha;
    }
    
    function guardar(){
        $id=$this->id;				$materia=$this->materia;	
		$alumno=$this->alumno;		$actividad=$this->actividad;		
		$valor=$this->valor;		$periodo=$this->periodo;			$fecha=$this->fecha;
			
        mysql_query("INSERT INTO notas (materia, alumno, actividad, valor, periodo, fecha) 
                                  VALUES ('$materia','$alumno','$actividad','$valor','$periodo','$fecha')");
								  
    }
	
	function actualizar(){
       	$id=$this->id;				$materia=$this->materia;	
		$alumno=$this->alumno;		$actividad=$this->actividad;		
		$valor=$this->valor;		$periodo=$this->periodo;			$fecha=$this->fecha;
		
		mysql_query("UPDATE notas SET valor='$valor' WHERE id='$id'");
	}
}
?>