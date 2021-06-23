<?php


class ControladorUsuarios{




		/*=============================
		Mostrar de Usuario
		==============================*/
	static public function ctrMostrarUsuarios($item, $valor){
		$tabla= "usuarios";
		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

/*=============================
Ingreso de Usuario
==============================*/

	static public function ctrIngresoUsuario()
	{
		if(isset($_POST["ingUsuario"]))
		{
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"]))
				{

						$tabla = "usuarios";

						$item = "usuario";
						$valor = $_POST["ingUsuario"];

						$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

						/*var_dump($respuesta);*/
						$encriptar = crypt($_POST["ingPassword"],'$2a$07$usesomesillystringforsalt$');

						if ($respuesta["usuario"] == $_POST["ingUsuario"] && 
								$respuesta["password"] == $encriptar) {
								/*$respuesta["password"] == $_POST["ingPassword"]) { */
								if ($respuesta["estado"] == 1) {
									
									$_SESSION["iniciarSesion"] = "ok";
									$_SESSION["id"] = $respuesta["id"];
									$_SESSION["nombre"] = $respuesta["nombre"];
									$_SESSION["usuario"] = $respuesta["usuario"];
									$_SESSION["foto"] = $respuesta["foto"];
									$_SESSION["perfil"] = $respuesta["perfil"];

									//$_SESSION["informe"]=$respuesta["id"];

									date_default_timezone_get('America/Mexico_City');
									$fecha = date('Y-m-d');
									$hora = date('H:i:s');

									$fechaActual= $fecha.'  '.$hora;

									$item1 = "ultimo_login";
									$valor1 = $fechaActual;

									$item2 = "id";
									$valor2 = $respuesta["id"];

									$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);


									if($ultimoLogin == "ok"){

										if($_SESSION["perfil"] =="Administrador"){

									      echo '<script>
										
													window.location = "usuarios";
											
												</script>';

									    }
									    if($_SESSION["perfil"] =="Tecnico"){

									      echo '<script>
										
													window.location = "maquinas";
												
												</script>';

									    }
									    if($_SESSION["perfil"] =="Operador"){

									      echo '<script>
										
													window.location = "doctos";
												
												</script>';

									    }

										
									}
									

									

									
								
								}else {
									echo '<br><div class="alert alert-danger">El usuario no esta Activo</div>';
								}
							

								/*echo '<br><div class="alert alert-success">Bienvenido al Sistema, vuelve a intentar</div>';*/

						}else{

							echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentar</div>';

						}

				}
		}

	}

/*=============================
Registro de Usuario
==============================*/

		static public function ctrCrearUsuario(){
			if(isset($_POST["nuevoUsuario"])){
								
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){
						
					
					/*=============================================
					=            Guardar Imagen            =
					=============================================*/
					$ruta = "";
					
					if (isset($_FILES["nuevaFoto"]["tmp_name"])){
						
						list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

						$nuevoAncho = 500;
						$nuevoAlto = 500;

						/*=============================================
						CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
						=============================================*/

						$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

						mkdir($directorio, 0755);
						
						
						
						# code...

						if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}


					}
					
					
					/*=====  End of Section comment block  ======*/
					

					
					$tabla = "usuarios";
					
					$encriptar = crypt($_POST["nuevoPassword"],'$2a$07$usesomesillystringforsalt$');
					
					$datos = array("nombre" => $_POST["nuevoNombre"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "perfil" => $_POST["nuevoPerfil"],
					           "foto" => $ruta
					           );

					$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El usuario se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "usuarios";

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
								title: "El usuario no puede ir Vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{

								if(result.value){
								
									window.location = "usuarios";

								}

							});
				

					</script>';
				

				}
			}
		}
  
/*=============================
Editar de Usuario
==============================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

				/*=============================
					Editar de Usuario
				==============================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
						
							list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

							$nuevoAncho = 500;
							$nuevoAlto = 500;

							/*=============================================
							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
							=============================================*/

							$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

							/*=============================================
							PREGUNTARMOS SI EXISTE LA FOTO DEL USUARIO
							=============================================*/
							if(!empty($_POST["fotoActual"])){

								unlink($_POST["fotoActual"]);

							}else {

								mkdir($directorio, 0755); 

							}
							/* mkdir($directorio, 0755); */
							
							
							
							# code...

							if($_FILES["editarFoto"]["type"] == "image/jpeg"){

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);

							$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

							$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);

						}

						if($_FILES["editarFoto"]["type"] == "image/png"){

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);

							$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

							$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

						}


					}

					$tabla = "usuarios";

					if($_POST["editarPassword"] != ""){

						if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

							$encriptar = crypt($_POST["editarPassword"],'$2a$07$usesomesillystringforsalt$');

						}else{

							echo '<script>

									swal({

										type: "error",
										title: "El password no puede ir Vacio o llevar caracteres especiales!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false

									}).then((result)=>{

										if(result.value){
										
											window.location = "usuarios";

										}

									});
				

								</script>';

						}
						
					}else{

						$encriptar = $_POST["passwordActual"];

					}
					
					
					$datos = array("nombre" => $_POST["editarNombre"],
					           "usuario" => $_POST["editarUsuario"],
					           "password" => $encriptar,
					           "perfil" => $_POST["editarPerfil"],
					           "foto" => $ruta
					           );

					$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
					
					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El usuario se modifico correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "usuarios";

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
							
								window.location = "usuarios";

							}

						});
	

					</script>';
				}
		}

	}

	/*=============================
Registro de Usuario
==============================*/
static function ctrBorrarUsuario(){

	if(isset($_GET["idUsuario"])){

		$tabla="usuarios";
		$datos = $_GET["idUsuario"];

		if($_GET["fotoUsuario"] != ""){

			unlink($_GET["fotoUsuario"]);
			rmdir('vistas/img/usuarios/'.$_GET["usuario"]);
		}

		$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

		if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El usuario se borro correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "usuarios";

								}

							});
				

					</script>';
					}
			else{
				echo '<script>

							swal({

								type: "error",
								title: "Ocurrio un Error",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "usuarios";

								}

							});
				

					</script>';
			}
	}
}

}

