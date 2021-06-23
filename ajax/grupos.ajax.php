<?php


require_once "../controladores/grupos.controlador.php";
require_once "../modelos/grupos.modelo.php";
/**
 * 
 */
class AjaxGrupos{

	/*====================================
		Editar Grupos
	 =====================================*/
	 public $idGrupo;

	 public function ajaxEditarGrupos(){

	 	$item = "idGrupo";
	 	$valor = $this->idGrupo;
		
	 	$respuesta = ControladorGrupos::ctrMostrarGrupos($item, $valor);

	 	echo json_encode($respuesta);
	 }

	 public $validaGrupo;

	public function ajaxValidaGrupos(){

		$item = "descripcion";
		$valor = $this->validaGrupo;
		$respuesta = ControladorGrupos::ctrMostrarGrupos($item,$valor);

		echo json_encode($respuesta);
	}
}


	/*====================================
		Editar Categoria
	 =====================================*/

	 if(isset($_POST["idGrupo"])){

	 	$grupos = new AjaxGrupos();
	 	$grupos -> idGrupo = $_POST["idGrupo"];
	 	$grupos -> ajaxEditarGrupos();

	 }

	 /*====================================
		Valida Categoria
	 =====================================*/

	 if(isset($_POST["validaGrupo"])){

		$validaGrupo = new AjaxGrupos();
		$validaGrupo -> validaGrupo = $_POST["validaGrupo"];		
		$validaGrupo -> ajaxValidaGrupos();
	}
