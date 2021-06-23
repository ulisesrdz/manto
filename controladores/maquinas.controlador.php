<?php

class ControladorMaquinas{

	static public function ctrCrearMaquina(){

		if(isset($_POST["nuevaNumMaquina"]))
		{
			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevaNumMaquina"])){

				$tabla = "maquinas";

				
				$datos= array(
					"numMaquina"=>$_POST["nuevaNumMaquina"],					
					"idGrupo"=>$_POST["idGrupo"],
					"modelo"=>$_POST["nuevaModelo"],
					"marca"=>$_POST["nuevaMarca"],
					"area"=>$_POST["nuevaArea"],
					"vs"=>$_POST["nuevaVS"],
					"voltaje"=>$_POST["nuevaVoltaje"],
					"fase"=>$_POST["nuevaFase"],
					"df"=>$_POST["nuevaDF"],
					"wb"=>$_POST["nuevaWB"],
					"serie"=>$_POST["nuevaSerie"]);

				$respuesta = ModeloMaquinas::mdlCrearMaquina($tabla, $datos);



				if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La maquina se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "maquinas";

								}

							});
				

					</script>';
					}

			}
			else{

						echo '<script>

							swal({

								type: "error",
								title: "La maquina no puede ir Vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{

								if(result.value){
								
									window.location = "maquinas";

								}

							});
				

					</script>';
				

				}

		}
	
	}


	static public function ctrMostrarMaquinas($item,$valor){

		$tabla = "maquinas";

		$respuesta = ModeloMaquinas::mdlMostrarMaquinas($tabla,$item,$valor);

		return $respuesta;

	}


	static public function ctrEditarMaquinas()
	{

		if(isset($_POST["editarNumMaquina"]))
		{
			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarNumMaquina"])){

				$tabla = "maquinas";

				$datos= array(
					"numMaquina"=>$_POST["editarNumMaquina"],
					"idGrupo"=>$_POST["editarIdGrupo"],
					"modelo"=>$_POST["editarModelo"],
					"marca"=>$_POST["editarMarca"],
					"area"=>$_POST["editarArea"],
					"vs"=>$_POST["editarVS"],
					"serie"=>$_POST["editarSerie"],
					"voltaje"=>$_POST["editarVoltaje"],
					"fase"=>$_POST["editarFase"],
					"df"=>$_POST["editarDF"],
					"wb"=>$_POST["editarWB"],
					"id"=>$_POST["idMaquina"]);

				
				$respuesta = ModeloMaquinas::mdlEditarMaquinas($tabla, $datos);

				if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La Maquina se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "maquinas";

								}

							});
				

					</script>';
					}
					else{

						echo '<script>

							swal({

								type: "error",
								title: "El campo no puede ir Vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{

								if(result.value){
								
									window.location = "maquinas";

								}

							});
				

					</script>';
				

				}

			}
			
		}
	}

	/*=============================
		Editar Categoria
	==============================*/

	static public function ctrBorrarMaquinas(){
		
		if(isset($_GET["idMaquina"])){

			$tabla = "maquinas";
			$datos = $_GET["idMaquina"];

			$respuesta = ModeloMaquinas::ctrBorrarMaquinas($tabla, $datos);

			if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La Maquina se borro correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "maquinas";

								}

							});
				

					</script>';
					}
		}
	}

}

