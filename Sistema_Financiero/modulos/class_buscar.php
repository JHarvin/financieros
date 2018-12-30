<?php
class Consultar_Cajero{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM usuario, persona, cajero WHERE cajero.usu='$codigo' and usuario.doc=persona.doc and usuario.doc='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}


class Consultar_Clientes{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM clientes WHERE id='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Articulos{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM articulos WHERE id='$codigo' or nombre='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Categoria{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM categorias WHERE id='$codigo' or nombre='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}


class Consultar_Usuario{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM username, persona WHERE username.usu=persona.doc and username.usu='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Persona{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM persona WHERE doc='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}


class Consultar_Deposito{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM almacenes WHERE id='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}


class Consultar_Sistema{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM unidad WHERE id=$codigo");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Proveedor{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM proveedor WHERE id='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Tipo{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM tipos WHERE id='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class Consultar_Marca{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM marcas WHERE id='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class Consultar_Tarifa{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM tarifas WHERE id=$codigo");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

?>