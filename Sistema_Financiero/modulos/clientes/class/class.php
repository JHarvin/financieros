<?php
class Proceso_Cliente{
	var $id;	
	var $nombre;
	var $dir;
	var $dui;
	var $sexo;
	var $tel;
	var $nrc;
	var $estado;
	var $tipo;
	
	function __construct($id,$nombre,$dir,$dui,$sexo,$tel,$nrc,$estado,$tipo){
		$this->id=$id;						
		$this->nombre=$nombre;
		$this->dir=$dir;	
		$this->dui=$dui;
		$this->sexo=$sexo;
		$this->tel=$tel;
		$this->nrc=$nrc;												
		$this->estado=$estado;	
		$this->tipo=$tipo;	
	}
	
	function crear(){
		$id=$this->id;						
		$nombre=$this->nombre;
		$dir=$this->dir;
		$dui=$this->dui;
		$sexo=$this->sexo;
		$tel=$this->tel;
		$nrc=$this->nrc;				
		$estado=$this->estado;	
		$tipo=$this->tipo;	
							
		mysql_query("INSERT INTO  clientes (nombre,dir,dui,sexo,tel,nrc,estado, tipo)	
			                        VALUES ('$nombre','$dir','$dui','$sexo','$tel','$nrc','$estado','$tipo')");
	}
	
	function actualizar(){
		$id=$this->id;						
		$nombre=$this->nombre;
		$dir=$this->dir;
		$dui=$this->dui;
		$sexo=$this->sexo;
		$tel=$this->tel;
		$nrc=$this->nrc;				
		$estado=$this->estado;			
		$tipo=$this->tipo;			
				
		mysql_query("UPDATE clientes SET nombre='$nombre',
										  dir='$dir',
										  dui='$dui',
										  sexo='$sexo',
										  tel='$tel',
										  nrc='$nrc',										   
										  estado='$estado',
										  tipo='$tipo'
										  WHERE id='$id'");
	}
}
?>