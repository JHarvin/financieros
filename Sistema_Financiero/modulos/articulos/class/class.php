<?php
class Proceso_Articulos{
	var $id;	
	var $codigo;
	var $nombre;	
	var $cat;
	var $und;	
	var $valor;
	var $detalle;			
	var $estado;
	var $modelo;
	var $estante;
	var $marca;
	var $iva;
	
	function __construct($id,$codigo,$nombre,$cat,$und,$valor,$detalle,$estado,$modelo,$estante,$marca,$iva){
		$this->id=$id;						
		$this->codigo=$codigo;
		$this->nombre=$nombre;
		$this->cat=$cat;
		$this->und=$und;
		$this->valor=$valor;
		$this->detalle=$detalle;						
		$this->estado=$estado;
		$this->modelo=$modelo;
		$this->estante=$estante;
		$this->marca=$marca;
		$this->iva=$iva;
	}
	
	function crear(){
		$id=$this->id;						
		$codigo=$this->codigo;
		$nombre=$this->nombre;	
		$cat=$this->cat;
		$und=$this->und;	
		$valor=$this->valor;	
		$detalle=$this->detalle;						
		$estado=$this->estado;
		$modelo=$this->modelo;
		$estante=$this->estante;
		$marca=$this->marca;	
		$iva=$this->iva;	
							
		mysql_query("INSERT INTO articulos (codigo,nombre,cat,und,valor,detalle,estado,modelo,estante,marca,iva)	
			                        VALUES ('$codigo','$nombre','$cat','$und','$valor','$detalle','$estado','$modelo','$estante','$marca','$iva')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$codigo=$this->codigo;
		$nombre=$this->nombre;	
		$cat=$this->cat;
		$und=$this->und;		
		$valor=$this->valor;	
		$detalle=$this->detalle;						
		$estado=$this->estado;
		$modelo=$this->modelo;
		$estante=$this->estante;
		$marca=$this->marca;
		$iva=$this->iva;
				
		mysql_query("UPDATE articulos SET codigo='$codigo',
											nombre='$nombre',
											cat='$cat',
											und='$und',
											valor='$valor',
											detalle='$detalle', 
											estado='$estado', 
											modelo='$modelo',
											estante='$estante',
											marca='$marca',											
											iva='$iva'											
			                                WHERE id='$id'");
	}
}
?>