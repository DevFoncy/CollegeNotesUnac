 <?php
    
 class Database{
 	public $db;
 	protected	$resultado;
 	protected	$prep;
 	protected	$consulta;

    
 	function __construct ( $dbhost, $dbuser, $dbpass, $dbname){
        
 		$this->db= new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        
 		if($this->db->connect_errno ){
            trigger_error("Falto la conexion con MySQL,Tipo de Error -> ({$this->db->connect_error})", E_USER_ERROR);
 		}
 		
        // este metodo debe ir despues de hacer una creacion
        $this->db->set_charset(DB_CHARSET);
        
 	}
    
    public function getUsuarios(){
        $this->resultado = $this->db->query("SELECT * from usuario");
        return $this->resultado ->fetch_all(); //devuelve un array de todos los registross
 	}
 	public function preparar ($consulta){//preparar una consulta
 		$this->consulta= $consulta;
 		$this->prep= $this->db->prepare($this->consulta);
 		if(!$this->prep){
 			return  false;
 		}
 		else{
 			return true;
 		}
 	}
 	public function ejecutar (){
 		$this->prep->execute();
 	}
 	// como prep es una variable protegida no podre llamarlo de otra clase
 	public function prep(){
 		return $this->prep;
 	}

 	public function resultado(){
 		return $this->prep->fetch(); //el fetch devuelve el array asociativo
 	}
 	public function cambiarDB($db){
 		$this->db->select_db($db);
 	}
     
     public function cerrar_conex(){
        $this->prep->close();
        $this->db->close();
     
     }
      


 	public function validar_datos($columna, $tabla, $condicion){
 		$this->resultado=$this->db->query("SELECT $columna FROM $tabla WHERE $columna='$condicion'");
        $chequear=$this->resultado->num_rows;
        return $chequear;
 	}




}


?>
