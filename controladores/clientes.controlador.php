<?php



class ControladorClientes{

		/*=============================
		Crear Clientes
		==============================*/

		static public function ctrCrearCliente(){

			if(isset($_POST["nuevoCliente"])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) && 
					preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"])) {


						$tabla = "clientes";

						$datos = array("nuevoCliente" => $_POST["nuevoCliente"],
										"nuevoRFC"=>$_POST["nuevoRFC"],
							           "nuevoDocumentoId" => $_POST["nuevoDocumentoId"],
							           "nuevoEmail" => $_POST["nuevoEmail"],
							           "nuevoTelefono" => $_POST["nuevoTelefono"],
							           "nuevoDireccion" => $_POST["nuevoDireccion"],
							           "nuevaFechaNacimiento" => $_POST["nuevaFechaNacimiento"]
							           );

						$respuesta = ModeloClientes::mdlCrearCliente($tabla, $datos);
						/*$respuesta="ok";
						*/
						if($respuesta == "ok"){

								echo '<script>

									swal({

										type: "success",
										title: "El cliente se guardo correctamente!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"
										

									}).then((result)=>{

										if(result.value){
										
											window.location = "clientes";

										}

									});
						

							</script>';
							}
						
					}
					else{

								echo '<script>

									swal({

										type: "error",
										title: "La Cliente no puede ir Vacio o llevar caracteres especiales!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false

									}).then((result)=>{

										if(result.value){
										
											window.location = "categorias";

										}

									});
						

							</script>';
						

						
						}

				
			}
		}

	/*=============================
		Mostrar Clientes
	==============================*/

		static public function ctrMostrarCliente($item,$valor){
			$tabla = "clientes";

			$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

			return $respuesta;

		}



		/*=============================
		Editar Clientes
		==============================*/

		static public function ctrEditarCliente(){

			if(isset($_POST["editarCliente"])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) && 
					preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"])) {


						$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "nombre"=>$_POST["editarCliente"],
					           "RFC"=>$_POST["editarRFC"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);

						$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
						//$respuesta="ok";
						if($respuesta == "ok"){

								echo '<script>

									swal({

										type: "success",
										title: "El cliente se modifico correctamente!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"
										

									}).then((result)=>{

										if(result.value){
										
											window.location = "clientes";

										}

									});
						

									</script>';
							}

					}
					else{

								echo '<script>

									swal({

										type: "error",
										title: "La Cliente no puede ir Vacio o llevar caracteres especiales!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false

									}).then((result)=>{

										if(result.value){
										
											window.location = "categorias";

										}

									});
						

							</script>';
						

						
						}

				
			}
		}

		static public function ctrBorrarCliente(){
		if(isset($_GET["idCliente"])){

			$tabla = "clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlBorrarCliente($tabla, $datos);

			if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La Categoria se borro correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "clientes";

								}

							});
				

					</script>';
					}
		}
	}

}