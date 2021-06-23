<?php


require_once "../controladores/maquinas.controlador.php";
require_once "../modelos/maquinas.modelo.php";


class AjaxMaquinas{

	/*====================================
		Editar Categoria
	 =====================================*/
	 public $idMaquina;

	 public function ajaxEditarMaquinas(){

	 	$item = "idMaquina";
	 	$valor = $this->idMaquina;
		
	 	$respuesta = ControladorMaquinas::ctrMostrarMaquinas($item, $valor);

	 	echo json_encode($respuesta);
	 }

	 public $validaMaquina;

	public function ajaxValidaMaquinas(){

		$item = "idMaquina";
		$valor = $this->validaMaquina;
		$respuesta = ControladorMaquinas::ctrMostrarMaquinas($item,$valor);

		echo json_encode($respuesta);
	}
}

/*====================================
	Editar Categoria
	 =====================================*/

	 if(isset($_POST["idMaquina"])){

	 	$maquina = new AjaxMaquinas();
	 	$maquina -> idMaquina = $_POST["idMaquina"];
	 	$maquina -> ajaxEditarMaquinas();

	 }

	 /*====================================
		Valida Categoria
	 =====================================*/

	 if(isset($_POST["validaMaquina"])){

		$validaMaquinas = new AjaxMaquinas();
		$validaMaquinas -> validaCategoria = $_POST["validaMaquina"];		
		$validaMaquinas -> ajaxValidaMaquinas();
	}