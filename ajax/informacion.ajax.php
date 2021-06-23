<?php


require_once "../controladores/informacion.controlador.php";
require_once "../modelos/informacion.modelo.php";

class AjaxInformacion{

	/*=============================
			Editar Informacion
	==============================*/

	public $idEmpresa;

	public function ajaxEditarInformacion(){

		$item = "id";
		$valor = $this->idEmpresa;
		$respuesta = ControladorInformacion::ctrMostrarInformacion($item,$valor);
		//var_dump($respuesta);
		echo json_encode($respuesta);
	}
}

/*=============================
			Editar Informacion
	==============================*/
if(isset($_POST["idEmpresa"])){

	$editar = new AjaxInformacion();
	$editar -> idEmpresa = $_POST["idEmpresa"];
	$editar -> ajaxEditarInformacion();

}