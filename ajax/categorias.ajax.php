<?php


require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
/**
 * 
 */
class AjaxCategorias{

	/*====================================
		Editar Categoria
	 =====================================*/
	 public $idCategoria;

	 public function ajaxEditarCategoria(){

	 	$item = "id";
	 	$valor = $this->idCategoria;
		
	 	$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

	 	echo json_encode($respuesta);
	 }

	 public $validaCategoria;

	public function ajaxValidaCategorias(){

		$item = "categoria";
		$valor = $this->validaCategoria;
		$respuesta = ControladorCategorias::ctrMostrarCategorias($item,$valor);

		echo json_encode($respuesta);
	}
}


	/*====================================
		Editar Categoria
	 =====================================*/

	 if(isset($_POST["idCategoria"])){

	 	$categoria = new AjaxCategorias();
	 	$categoria -> idCategoria = $_POST["idCategoria"];
	 	$categoria -> ajaxEditarCategoria();

	 }

	 /*====================================
		Valida Categoria
	 =====================================*/

	 if(isset($_POST["validaCategoria"])){

		$validarCategoria = new AjaxCategorias();
		$validarCategoria -> validaCategoria = $_POST["validaCategoria"];		
		$validarCategoria -> ajaxValidaCategorias();
	}
