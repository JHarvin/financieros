<?php
class Proceso_Empleado{
	var $id;	
	var $nombre;
	var $dir;
	var $dui;
	var $sexo;
	var $tel;
	var $nit;
	var $cargo;
	var $sueldo;
	var $estado;
	
	function __construct($id,$nombre,$dir,$dui,$sexo,$tel,$nit,$cargo,$sueldo,$estado){
		$this->id=$id;						
		$this->nombre=$nombre;
		$this->dir=$dir;	
		$this->dui=$dui;
		$this->sexo=$sexo;
		$this->tel=$tel;
		$this->nit=$nit;
		$this->cargo=$cargo;
		$this->sueldo=$sueldo;												
		$this->estado=$estado;	
	}
	
	function crear(){
		$id=$this->id;						
		$nombre=$this->nombre;
		$dir=$this->dir;
		$dui=$this->dui;
		$sexo=$this->sexo;
		$tel=$this->tel;
		$nit=$this->nit;
		$cargo=$this->cargo;
		$sueldo=$this->sueldo;				
		$estado=$this->estado;	
							
		mysql_query("INSERT INTO  empleados (nombre,dir,dui,nit,tel,sexo,cargo,sueldo,estado)	
			                        VALUES ('$nombre','$dir','$dui','$nit','$tel','$sexo','$cargo','$sueldo','$estado')");
	}
	
	function actualizar(){
		$id=$this->id;						
		$nombre=$this->nombre;
		$dir=$this->dir;
		$dui=$this->dui;
		$sexo=$this->sexo;
		$tel=$this->tel;
		$nit=$this->nit;
		$cargo=$this->cargo;
		$sueldo=$this->sueldo;				
		$estado=$this->estado;			
				
		mysql_query("UPDATE empleados SET nombre='$nombre',
										  dir='$dir',
										  dui='$dui',
										  nit='$nit',
										  tel='$tel',
										  sexo='$sexo',
										  cargo='$cargo',
										  sueldo='$sueldo',										   
										  estado='$estado' WHERE id='$id'");
	}
}
?>