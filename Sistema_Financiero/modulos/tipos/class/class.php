<?php
class Proceso_Tipos{
	var $id;	
	var $nombre;	
	var $estado;
	
	function __construct($id,$nombre,$estado){
		$this->id=$id;						
		$this->nombre=$nombre;						
		$this->estado=$estado;	
	}
	
	function crear(){
		$id=$this->id;						
		$nombre=$this->nombre;					
		$estado=$this->estado;	
							
		mysql_query("INSERT INTO tipos (nombre, estado)	VALUES ('$nombre','$estado')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$nombre=$this->nombre;					
		$estado=$this->estado;			
				
		mysql_query("UPDATE tipos SET nombre='$nombre', estado='$estado' WHERE id='$id'");
	}
}
?>