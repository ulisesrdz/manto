<?php
 //ini_set('display_errors', 1);
 //ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
 //error_reporting(0);
class ControladorInformacion{


/*=============================
Mostrar Informacion
==============================*/
	static public function ctrMostrarInformacion($item, $valor){
		$tabla= "configuracion";
		$respuesta = ModeloInformacion::MdlMostrarInformacion($tabla, $item, $valor);

		return $respuesta;
	}


/*=============================
Crear Informacion
==============================*/

	static public function ctrCrearInformacion(){

		if(isset($_POST["nuevoNombre"])){

			/*=============================================
					=            Guardar Imagen            =
			=============================================*/

			$ruta = "";
					
				if (isset($_FILES["nuevaFoto"]["tmp_name"])){
						
						list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

						$nuevoAncho = 500;
						$nuevoAlto = 183;

						/*=============================================
						CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
						=============================================*/

						$directorio = "vistas/img/empresa";

						mkdir($directorio, 0755);
						
						
						
						# code...

						if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$ruta = "vistas/img/empresa/logoEmpresa.jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$ruta = "vistas/img/empresa/logoEmpresa.png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

					$filename = "vistas/img/empresa/logoEmpresa.png";
					$file = fopen($filename, "rb");
					$contents = fread($file, filesize($filename));
					fclose($file);

					$tabla = "configuracion";
										

					$datos = array("nombre" => $_POST["nuevoNombre"],
					           "rfc" => $_POST["nuevoRfc"],
					           "imagenAPK" => $contents,
					           "diaCreacion" => $_POST["nuevaFecha"],
					           "logo" => $ruta
					           );

					$respuesta = ModeloInformacion::mdlCrearInformacion($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La informacion se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "settings";

								}

							});
				

					</script>';
					}
					else{
						echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentar</div>';
					}
				


				}  else{

						echo '<script>

							swal({

								type: "error",
								title: "La informacion no puede ir Vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{

								if(result.value){
								
									window.location = "settings";

								}

							});
				

					</script>';
				}

			}
		
	}

	static public function ctrEditarInformacion(){

		if(isset($_POST["Nombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Nombre"])) {

				/*=============================
					Editar de Usuario
				==============================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
						
							list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

							$nuevoAncho = 500;
							$nuevoAlto = 183;

							/*=============================================
							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
							=============================================*/

							$directorio = "vistas/img/empresa";

							/*=============================================
							PREGUNTARMOS SI EXISTE LA FOTO DEL USUARIO
							=============================================*/
							if(!empty($_POST["fotoActual"])){

								unlink($_POST["fotoActual"]);

							}else {

								mkdir($directorio, 0755); 

							}
							/* mkdir($directorio, 0755); */
						}

						if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$ruta = "vistas/img/empresa/logoEmpresa.png";

						//$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

							$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

					}
						
					$filename = "vistas/img/empresa/logoEmpresa.png";
					$file = fopen($filename, "rb");
					$contents = fread($file, filesize($filename));
					fclose($file);


					

					
					$tabla = "configuracion";
										

					$datos = array("nombre" => $_POST["Nombre"],
					           "rfc" => $_POST["editarRfc"],
					           "imagenAPK" => $contents,
					           "diaCreacion" => $_POST["editarFecha"],
					           "logo" => $ruta,
					           "id" => $_POST["idEmpresa"]
					           );

				//	var_dump($datos);
					$respuesta = ModeloInformacion::mdlEditarInformacion($tabla, $datos);
					//$respuesta="";
					if($respuesta == "ok"){
						clearstatcache();
						echo '<script>

							swal({

								type: "success",
								title: "La configuracion se modifico correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "salir";

								}

							});
				

					</script>';

					}
					else{
						echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentar</div>';
					}

		}else{

			echo '<script>

						swal({

							type: "error",
							title: "El nombre no puede ir Vacio o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){
							
								window.location = "settings";

							}

						});
	

					</script>';
				}
		}

	}
}