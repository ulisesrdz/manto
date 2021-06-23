<?php



class ControladorProveedores{

		/*=============================
		Crear Clientes
		==============================*/

		static public function ctrCrearProveedor(){

			if(isset($_POST["nuevoProveedor"])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProveedor"]) && 
					preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"])) {


						$tabla = "proveedores";

						$datos = array("nuevoProveedor" => $_POST["nuevoProveedor"],
							           "nuevoRFC" => $_POST["nuevoRFC"],
							           "nuevoDocumentoId" => $_POST["nuevoDocumentoId"],
							           "nuevoEmail" => $_POST["nuevoEmail"],
							           "nuevoTelefono" => $_POST["nuevoTelefono"],
							           "nuevoDireccion" => $_POST["nuevoDireccion"],
							           "nuevaFechaNacimiento" => $_POST["nuevaFechaNacimiento"]
							           );

						$respuesta = ModeloProveedores::mdlCrearProveedor($tabla, $datos);
						//$respuesta="ok";
						//*/
						if($respuesta == "ok"){

								echo '<script>

									swal({

										type: "success",
										title: "El Proveedor se guardo correctamente!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"
										

									}).then((result)=>{

										if(result.value){
										
											window.location = "proveedores";

										}

									});
						

							</script>';
							}
						
					}
					else{

								echo '<script>

									swal({

										type: "error",
										title: "La Proveedor no puede ir Vacio o llevar caracteres especiales!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false

									}).then((result)=>{

										if(result.value){
										
											window.location = "proveedores";

										}

									});
						

							</script>';
						

						
						}

				
			}
		}

	/*=============================
		Mostrar Clientes
	==============================*/

		static public function ctrMostrarProveedor($item,$valor){
			$tabla = "proveedores";

			$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

			return $respuesta;

		}



		/*=============================
		Editar Clientes
		==============================*/

		static public function ctrEditarProveedor(){

			if(isset($_POST["editarProveedor"])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProveedor"]) && 
					preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"])) {


						$tabla = "proveedores";

			   	$datos = array("id"=>$_POST["idProveedor"],
			   				   "nombre"=>$_POST["editarProveedor"],
			   				   "RFC"=>$_POST["editarRFC"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);

						$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);
						//$respuesta="ok";
						if($respuesta == "ok"){

								echo '<script>

									swal({

										type: "success",
										title: "El Proveedor se modifico correctamente!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"
										

									}).then((result)=>{

										if(result.value){
										
											window.location = "proveedores";

										}

									});
						

									</script>';
							}

					}
					else{

								echo '<script>

									swal({

										type: "error",
										title: "La Proveedor no puede ir Vacio o llevar caracteres especiales!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false

									}).then((result)=>{

										if(result.value){
										
											window.location = "proveedores";

										}

									});
						

							</script>';
						

						
						}

				
			}
		}

		static public function ctrBorrarProveedor(){
		if(isset($_GET["idProveedor"])){

			$tabla = "proveedores";
			$datos = $_GET["idProveedor"];

			$respuesta = ModeloProveedores::mdlBorrarProveedor($tabla, $datos);

			if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El Proveedor se borro correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "proveedores";

								}

							});
				

					</script>';
					}
		}
	}

}