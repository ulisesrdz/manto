<?php


require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";


class AjaxMantenimiento{

	/*====================================
		Enviar Id
	 =====================================*/
	 public $idInformacion;

	 public function ajaxEnviarID(){
	 		 	

		$item = "id";
	 	$valor = $this->idInformacion;
	 	//$_SESSION["informe"]= $this->idInforme;
		
	 	$respuesta = ControladorMantenimiento::ctrMostrarUnirversal($item, $valor);
		//$respuesta = array("idInformacion"=> $valor);
	 	echo json_encode($respuesta);
	 }

	 public $idInforme;

	 public function ajaxEditarInforme(){

	 	$item = "id";
	 	$valor = $this->idInforme;
		
	 	$respuesta = ControladorMantenimiento::ctrMostrarInforme($item, $valor);

	 	echo json_encode($respuesta);
	 }
}


/*====================================
	Editar Categoria
	 =====================================*/

	 if(isset($_POST["idInformacion"])){

	 	$informe = new AjaxMantenimiento();
	 	$informe -> idInformacion = $_POST["idInformacion"];
	 	$informe -> ajaxEnviarID();
		
	 }

	 if(isset($_POST["idInforme"])){

	 	$informe = new AjaxMantenimiento();
	 	$informe -> idInforme = $_POST["idInforme"];
	 	$informe -> ajaxEditarInforme();

	 }