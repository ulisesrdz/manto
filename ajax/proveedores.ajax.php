<?php


require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

/**
 * editarCliente
 */
class AjaxProveedores{


	public $idProveedor;
	
	public function ajaxEditarProveedor(){
		

		$item = "id";
		$valor = $this->idProveedor;

		$respuesta = ControladorProveedores::ctrMostrarProveedor($item, $valor);

		echo json_encode($respuesta);
	}
	
}

	/*====================================
		Editar Categoria
	 =====================================*/

	 if(isset($_POST["idProveedor"])){

	 	$proveedor = new AjaxProveedores();
	 	$proveedor -> idProveedor = $_POST["idProveedor"];
	 	$proveedor -> ajaxEditarProveedor();
	 
	 }