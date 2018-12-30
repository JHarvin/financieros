<?php
class Proceso_Proveedor{
	var $id;	
	var $nombre;
	var $dir;
	var $nit;
	var $nrc;
	var $tel;
	var $fax;
	var $contacto;
	var $email;
	var $tel_fijo;
	var $cel;	
	var $estado;
	
	function __construct($id,$nombre,$dir,$nit,$nrc,$tel,$fax,$contacto,$email,$tel_fijo,$cel,$estado){
		$this->id=$id;						
		$this->nombre=$nombre;
		$this->dir=$dir;	
		$this->nit=$nit;
		$this->nrc=$nrc;
		$this->tel=$tel;
		$this->fax=$fax;
		$this->contacto=$contacto;
		$this->email=$email;
		$this->tel_fijo=$tel_fijo;
		$this->cel=$cel;													
		$this->estado=$estado;	
	}
	
	function crear(){
		$id=$this->id;						
		$nombre=$this->nombre;
		$dir=$this->dir;
		$nit=$this->nit;
		$nrc=$this->nrc;
		$tel=$this->tel;
		$fax=$this->fax;
		$contacto=$this->contacto;
		$email=$this->email;
		$tel_fijo=$this->tel_fijo;
		$cel=$this->cel;					
		$estado=$this->estado;	
							
		mysql_query("INSERT INTO  proveedor (nombre,dir,nit,nrc,tel,fax,contacto,email,tel_fijo,cel,estado)	
			                        VALUES ('$nombre','$dir','$nit','$nrc','$tel','$fax','$contacto','$email','$tel_fijo','$cel','$estado')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$nombre=$this->nombre;					
		$dir=$this->dir;
		$nit=$this->nit;
		$nrc=$this->nrc;
		$tel=$this->tel;
		$fax=$this->fax;
		$contacto=$this->contacto;
		$email=$this->email;
		$tel_fijo=$this->tel_fijo;
		$cel=$this->cel;					
		$estado=$this->estado;				
				
		mysql_query("UPDATE proveedor SET nombre='$nombre',
										  dir='$dir',
										  nit='$nit',
										  nrc='$nrc',
										  tel='$tel',
										  fax='$fax',
										  contacto='$contacto',
										  email='$email',
										  tel_fijo='$tel_fijo',
										  cel='$cel', 
										  estado='$estado' WHERE id='$id'");
	}
}
?>