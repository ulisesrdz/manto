<?php


class ControladorGrupos{
/*=============================
Ingreso de Categoria
==============================*/

	static public function ctrCrearGrupo()
	{

		if(isset($_POST["nuevoGrupo"]))
		{
			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoGrupo"])){

				$tabla = "grupos";

				$datos= $_POST["nuevoGrupo"];

				$respuesta = ModeloGrupos::mdlCrearGrupo($tabla, $datos);

				if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El grupo se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "grupos";

								}

							});
				

					</script>';
					}

			}
			else{

						echo '<script>

							swal({

								type: "error",
								title: "El grupo no puede ir Vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{

								if(result.value){
								
									window.location = "grupos";

								}

							});
				

					</script>';
				

				}

		}
		
	}

	/*=============================
		Mostrar Categoria
	==============================*/
	static public function ctrMostrarGrupos($item,$valor){

		$tabla = "grupos";

		$respuesta = ModeloGrupos::mdlMostrarGrupos($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================
		Editar Grupos
	==============================*/

	static public function ctrEditarGrupo()
	{

		if(isset($_POST["editarGrupo"]))
		{
			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarGrupo"])){

				$tabla = "grupos";

				$datos= array("descripcion"=>$_POST["editarGrupo"],"id"=>$_POST["idGrupo"]);

				$respuesta = ModeloGrupos::mdlEditarGrupos($tabla, $datos);

				if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El grupo se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "grupos";

								}

							});
				

					</script>';
					}

			}
			else{

						echo '<script>

							swal({

								type: "error",
								title: "El grupo no puede ir Vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{

								if(result.value){
								
									window.location = "grupos";

								}

							});
				

					</script>';
				

				}

		}
	}

	/*=============================
		Editar Categoria
	==============================*/

	static public function ctrBorrarGrupo(){
		if(isset($_GET["idGrupo"])){

			$tabla = "grupos";
			$datos = $_GET["idGrupo"];

			$respuesta = ModeloGrupos::mdlBorrarGrupo($tabla, $datos);

			if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El grupo se borro correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "grupos";

								}

							});
				

					</script>';
					}

					
		}
	}

}