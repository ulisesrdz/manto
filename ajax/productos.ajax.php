<?php

require_once "../modelos/productos.modelo.php";
require_once "../controladores/productos.controlador.php";

class AjaxProductos{
 /* =============================
  	Genera Codigo Productos
  ============================== */
	public $idCategoria;
	public function ajaxCrearCodigoProducto(){

		$item = "id_Categoria";
		$valor = $this->idCategoria;
		$orden = "id";

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

		echo json_encode($respuesta);
	}

	public $idProducto;
	public $traerProductos;
	public $nombreProductos;

	public function ajaxEditarProducto(){

		if($this->traerProductos == "ok"){

			$item = null;
			$valor = null;
			$orden = "id";

			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

			

			echo json_encode($respuesta);

		}else if($this->nombreProductos != ""){

			$item = "descripcion";
			$valor = $this->nombreProductos;
			$orden = "id";

			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

			echo json_encode($respuesta);

		}else{
			$item = "id";
			$valor = $this->idProducto;
			$orden = "id";

			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

			echo json_encode($respuesta);
		}

		
	}
}
/* =============================
  	Genera Codigo Productos
  ============================== */
if(isset($_POST["idCategoria"])){
	$codigoProducto = new AjaxProductos();
	$codigoProducto -> idCategoria = $_POST["idCategoria"];
	$codigoProducto -> ajaxCrearCodigoProducto();
}

/* =============================
  	Editar Productos
  ============================== */
if(isset($_POST["idProducto"])){
	$editarProducto = new AjaxProductos();
	$editarProducto -> idProducto = $_POST["idProducto"];
	$editarProducto -> ajaxEditarProducto();
}

/* =============================
  	Traer Productos
  ============================== */
if(isset($_POST["traerProductos"])){
	$traerProductos = new AjaxProductos();
	$traerProductos -> traerProductos = $_POST["traerProductos"];
	$traerProductos -> ajaxEditarProducto();
}

/* =============================
  	Traer nombre Productos
  ============================== */
if(isset($_POST["nombreProductos"])){
	$nombreProductos = new AjaxProductos();
	$nombreProductos -> nombreProductos = $_POST["nombreProductos"];
	$nombreProductos -> ajaxEditarProducto();
}