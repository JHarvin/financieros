<?php
class Proceso_Inventario{
	var $id;	
	var $almacen;
	var $id_art;	
	var $codigo;
	var $stock;	
	var $stock_min;
	var $pv;			
	var $pmy;
	var $cat;
	
	function __construct($id,$almacen,$id_art,$codigo,$stock,$stock_min,$pv,$pmy,$cat){
		$this->id=$id;						
		$this->almacen=$almacen;
		$this->id_art=$id_art;
		$this->codigo=$codigo;
		$this->stock=$stock;
		$this->stock_min=$stock_min;
		$this->pv=$pv;						
		$this->pmy=$pmy;
		$this->cat=$cat;	
	}
	
	function crear(){
		$id=$this->id;						
		$almacen=$this->almacen;
		$id_art=$this->id_art;	
		$codigo=$this->codigo;
		$stock=$this->stock;	
		$stock_min=$this->stock_min;	
		$pv=$this->pv;						
		$pmy=$this->pmy;
		$cat=$this->cat;	
							
		mysql_query("INSERT INTO inventario (almacen,articulo,codigo,stock,stock_min,pv,pmy,cat)	
			                        VALUES ('$almacen','$id_art','$codigo','$stock','$stock_min','$pv','$pmy','$cat')");
		mysql_query("Update articulos Set inv='ok' Where id='$id_art'");	
	}
	
	function actualizar(){
		$id=$this->id;		
		$almacen=$this->almacen;
		$id_art=$this->id_art;	
		$codigo=$this->codigo;
		$stock=$this->stock;	
		$stock_min=$this->stock_min;	
		$pv=$this->pv;						
		$pmy=$this->pmy;
		$cat=$this->cat;	
				
		mysql_query("UPDATE inventario SET codigo='$codigo',
											nombre='$nombre',
											cat='$cat',
											und='$und',
											valor='$valor',
											detalle='$detalle', 
											estado='$estado' 
			                                WHERE id='$id'");
	}
}
?>