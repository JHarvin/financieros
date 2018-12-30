<?php
class Proceso_Almacen{
	var $id;	
	var $nombre;
	var $direccion;
	var $tel;	
	var $encargado;	
	var $estado;
	var $nom_imp;
	var $val;
	var $docc;
	var $vdocc;
	var $doco;
	var $vdoco;
	var $ftel;
		
	function __construct($id,$nombre,$direccion,$tel,$encargado,$estado,$nom_imp,$val,$docc,$vdocc,$doco,$vdoco,$ftel){
		$this->id=$id;						
		$this->nombre=$nombre;
		$this->direccion=$direccion;
		$this->tel=$tel;
		$this->encargado=$encargado;								
		$this->estado=$estado;	
		$this->nom_imp=$nom_imp;
		$this->val=$val;
		$this->docc=$docc;	
		$this->vdocc=$vdocc;	
		$this->doco=$doco;	
		$this->vdoco=$vdoco;	
		$this->ftel=$ftel;	
	}
	
	function crear(){
		$id=$this->id;						
		$nombre=$this->nombre;
		$direccion=$this->direccion;	
		$tel=$this->tel;
		$encargado=$this->encargado;									
		$estado=$this->estado;	
		$nom_imp=$this->nom_imp;	
		$val=$this->val;	
		$docc=$this->docc;	
		$vdocc=$this->vdocc;	
		$doco=$this->doco;	
		$vdoco=$this->vdoco;	
		$ftel=$this->ftel;	
							
		mysql_query("INSERT INTO almacenes (nombre,direccion,telefono,encargado,estado,nom_imp,val_imp,docc,vdocc,doco,vdoco,ftel)	VALUES ('$nombre','$direccion','$tel','$encargado','$estado','$nom_imp','$val','$docc','$vdocc','$doco','$vdoco','$ftel')");
	}
	
	function actualizar(){
		$id=$this->id;						
		$nombre=$this->nombre;
		$direccion=$this->direccion;	
		$tel=$this->tel;
		$encargado=$this->encargado;									
		$estado=$this->estado;	
		$nom_imp=$this->nom_imp;	
		$val=$this->val;	
		$docc=$this->docc;	
		$vdocc=$this->vdocc;	
		$doco=$this->doco;	
		$vdoco=$this->vdoco;			
		$ftel=$this->ftel;			
				
		mysql_query("UPDATE almacenes SET nombre='$nombre',
			                            	direccion='$direccion',
			                            	telefono='$tel',
			                           		encargado='$encargado', 
			                              	estado='$estado', 
			                              	nom_imp='$nom_imp',
			                              	val_imp='$val', 
			                              	docc='$docc', 
			                              	vdocc='$vdocc', 
			                              	doco='$doco', 
			                              vdoco='$vdoco', 
			                              ftel='$ftel' 
			                              WHERE id='$id'");
	}
}
?>