<?php
class Proceso_Materia{
    var $id;      	var $nombre;   		var $estado;
    
    function __construct($id, $nombre, $estado){
        $this->id=$id;      	$this->nombre=$nombre;          $this->estado=$estado;
    }
    
    function guardar(){
	    $id=$this->id;			$nombre=$this->nombre;		$estado=$this->estado;
			
        mysql_query("INSERT INTO materia (nombre, estado) 
                                  VALUES ('$nombre','$estado')");
								  
    }
	
	function actualizar(){
		$id=$this->id;			$nombre=$this->nombre;		$estado=$this->estado;
				
		mysql_query("UPDATE materia SET nombre='$nombre',
										estado='$estado'
								WHERE id='$id'");
	}
}

class Proceso_Salon{
    var $id;      	var $nombre;   	var $profesor;	var $grado;	var $estado;
    
    function __construct($id, $nombre, $profesor, $grado, $estado){
        $this->id=$id;      		$this->nombre=$nombre;          
		$this->profesor=$profesor;	$this->estado=$estado;		$this->grado=$grado;
    }
    
    function guardar(){
	    $id=$this->id;				$nombre=$this->nombre;		$estado=$this->estado;
		$profesor=$this->profesor;	$grado=$this->grado;
			
        mysql_query("INSERT INTO salon (nombre, grado, profesor, estado) 
                                  VALUES ('$nombre','$grado','$profesor','$estado')");
								  
    }
	
	function actualizar(){
		 $id=$this->id;				$nombre=$this->nombre;		$estado=$this->estado;
		$profesor=$this->profesor;	$grado=$this->grado;
				
		mysql_query("UPDATE salon SET nombre='$nombre',
										grado='$grado',
										profesor='$profesor',
										estado='$estado'
								WHERE id='$id'");
	}
}

class Proceso_Grado{
    var $id;      	var $nombre;   		var $estado;
    
    function __construct($id, $nombre, $estado){
        $this->id=$id;      	$this->nombre=$nombre;          $this->estado=$estado;
    }
    
    function guardar(){
	    $id=$this->id;			$nombre=$this->nombre;		$estado=$this->estado;
			
        mysql_query("INSERT INTO grado (nombre, estado) 
                                  VALUES ('$nombre','$estado')");
								  
    }
	
	function actualizar(){
		$id=$this->id;			$nombre=$this->nombre;		$estado=$this->estado;
				
		mysql_query("UPDATE grado SET nombre='$nombre',
										estado='$estado'
								WHERE id='$id'");
	}
}
?>