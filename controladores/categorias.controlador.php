<?php


class ControladorCategorias{
/*=============================
Ingreso de Categoria
==============================*/

	static public function ctrCrearCategoria()
	{

		if(isset($_POST["nuevaCategoria"]))
		{
			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevaCategoria"])){

				$tabla = "categorias";

				$datos= $_POST["nuevaCategoria"];

				$respuesta = ModeloCategorias::mdlCrearCategoria($tabla, $datos);

				if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La categoria se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "categorias";

								}

							});
				

					</script>';
					}

			}
			else{

						echo '<script>

							swal({

								type: "error",
								title: "La Categoria no puede ir Vacio o llevar caracteres especiales!",
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
		Mostrar Categoria
	==============================*/
	static public function ctrMostrarCategorias($item,$valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================
		Editar Categoria
	==============================*/

	static public function ctrEditarCategoria()
	{

		if(isset($_POST["editarCategoria"]))
		{
			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarCategoria"])){

				$tabla = "categorias";

				$datos= array("categoria"=>$_POST["editarCategoria"],"id"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarInforme($tabla, $datos);

				if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La Categoria se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "categorias";

								}

							});
				

					</script>';
					}

			}
			else{

						echo '<script>

							swal({

								type: "error",
								title: "La Categoria no puede ir Vacio o llevar caracteres especiales!",
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
		Editar Categoria
	==============================*/

	static public function ctrBorrarCategoria(){
		if(isset($_GET["idCategoria"])){

			$tabla = "categorias";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La Categoria se borro correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "categorias";

								}

							});
				

					</script>';
					}

					
		}
	}

}