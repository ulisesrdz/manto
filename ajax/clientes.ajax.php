<?php


require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

/**
 * editarCliente
 */
class AjaxClientes{


	public $idCliente;
	
	public function ajaxEditarCliente(){
		

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarCliente($item, $valor);

		echo json_encode($respuesta);
	}
	
}

	/*====================================
		Editar Categoria
	 =====================================*/

	 if(isset($_POST["idCliente"])){

	 	$cliente = new AjaxClientes();
	 	$cliente -> idCliente = $_POST["idCliente"];
	 	$cliente -> ajaxEditarCliente();
	 
	 }