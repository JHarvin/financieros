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
	var $iva;
	var $modelo;
	var $estante;
	var $marca;
	var $almacen;
	var $stock;
	var $stock_min;
	var $pv;
	var $pmy;
	
	function __construct($id,$codigo,$nombre,$cat,$und,$valor,$detalle,$estado,$iva,$modelo,$estante,$marca,$almacen,$stock,$stock_min,$pv,$pmy){
		$this->id=$id;						
		$this->codigo=$codigo;
		$this->nombre=$nombre;
		$this->cat=$cat;
		$this->und=$und;
		$this->valor=$valor;
		$this->detalle=$detalle;						
		$this->estado=$estado;
		$this->iva=$iva;
		$this->modelo=$modelo;
		$this->estante=$estante;
		$this->marca=$marca;
		$this->almacen=$almacen;
		$this->stock=$stock;
		$this->stock_min=$stock_min;
		$this->pv=$pv;
		$this->pmy=$pmy;	
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
		$iva=$this->iva;
		$modelo=$this->modelo;
		$estante=$this->estante;
		$marca=$this->marca;
		$almacen=$this->almacen;
		$stock=$this->stock;
		$stock_min=$this->stock_min;
		$pv=$this->pv;
		$pmy=$this->pmy;
		############ otras Operaciones ######	
		$fecha=date('Y-m-d');
		$importe_dos=$stock*$valor;	
							
		mysql_query("INSERT INTO articulos (codigo,nombre,cat,und,valor,detalle,estado,iva,modelo,estante,marca)	
			                        VALUES ('$codigo','$nombre','$cat','$und','$valor','$detalle','$estado','$iva','$modelo','$estante','$marca')");

		$cans=mysql_query("SELECT MAX(id) AS id FROM articulos");
			if($dat=mysql_fetch_array($cans))
			$id_articulo =$dat['id'];
			{
				$xSQL="INSERT INTO inventario (almacen,articulo,codigo,stock,stock_min,pv,pmy,cat)	
			                        VALUES ('$almacen','$id_articulo','$codigo','$stock','$stock_min','$pv','$pmy','$cat')";
				mysql_query($xSQL);
				mysql_query("Update articulos Set inv='ok' Where id='$id_articulo'");
				 ############### GUARDAMOS EN LA TABLA KARDEX#########################
                $detalle_sql="INSERT INTO kardex (tipo, id_articulo, cant, costok, importe, stockk, fecha, sucursal, usu)
                                VALUES ('INICIAL','$id_articulo','$stock','$valor','$importe_dos','$stock','$fecha','','')";
                mysql_query($detalle_sql);    
			}	
	}
	
	function actualizar(){
		$id=$this->id;				
		$almacen=$this->almacen;
		$stock=$this->stock;
		$stock_min=$this->stock_min;
		$pv=$this->pv;
		$pmy=$this->pmy;							
				
		mysql_query("UPDATE inventario SET almacen='$almacen',
			                                 stock='$stock',
			                                 stock_min='$stock_min',
			                                 pv='$pv',
			                                 pmy='$pmy' 
			                                 WHERE id='$id'");
	}
}
?>