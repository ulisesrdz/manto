<?php

class ControladorMantenimiento{

	static public function ctrMostrarInformacion(){
		
		$respuesta = ModeloMantenimiento::mdlMostrarInformacion();

		return $respuesta;
	}

	static public function ctrMostrarPeriodo(){
		
		$tabla= "periodo";
		$respuesta = ModeloMantenimiento::mdlMostrarPeriodo($tabla);

		return $respuesta;
	}


	static public function ctrMostrarDoctos(){
		
		$respuesta = ModeloMantenimiento::mdlMostrarDoctos();

		return $respuesta;
	}

	static public function ctrIngresarInformacion(){
			
			if(isset($_POST["idGrupo"])){					

					$tabla = "mantenimiento";
					
					
					$datos = array("idTipoMtto" => '1',
					           "idGrupo" => $_POST["idGrupo"],
					           
					           "idPeriodo" => $_POST["nuevoPeriodo"]					           
					           );

					$respuesta = ModeloMantenimiento::mdlIngresarInformacion($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El informe se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "mantenimiento";

								}

							});
				

					</script>';
					}
					else{
						echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentar</div>';
					}


				}

			}
		
	static public function ctrIngresarTarea(){
			
			if(isset($_POST["idInformacion"])){				

					
					$tabla = "tareas";					
					
					$datos = array("idMtto" => $_POST["idInformacion"],
					           "nuevaTarea" => $_POST["nuevaTarea"]           
					           );

					$respuesta = ModeloMantenimiento::mdlIngresarTarea($tabla, $datos);
					//var_dump($datos);
					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La tarea se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "index.php?ruta=task&idInforme='.$_POST["idInformacion"].'";

								}

							});
				

					</script>';
					}
					else{
						echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentar</div>';
					}


		}  
	}	

	/*=============================
		Eliminar Tarea
	==============================*/

	static public function ctrBorrarTarea(){
		
		if(isset($_GET["idTask"])){

			$tabla = "tareas";
			$datos = $_GET["idTask"];

			$respuesta = ModeloMantenimiento::mdlBorrarTarea($tabla, $datos);

			if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La tarea se borro correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "index.php?ruta=task&idInforme='.$_GET["idInforme"].'";

								}

							});
				

					</script>';
					}
		}
	}

	static public function ctrMostrarTareas($item,$valor){

		$tabla = "tareas";

		$respuesta = ModeloMantenimiento::mdlMostrarTarea($tabla,$item,$valor);

		return $respuesta;

	}


	static public function ctrMostrarUnirversal($item,$valor){

		$tabla = "mantenimiento";
		
		$respuesta = ModeloMantenimiento::mdlMostrarUnirseral($tabla,$item,$valor);

		return $respuesta;

	}	

	static public function ctrMostrarInforme($item,$valor){

		$tabla = "mantenimiento";

		$respuesta = ModeloMantenimiento::mdlMostrarInforme($tabla,$item,$valor);

		return $respuesta;

	}	


	static public function ctrEditarInforme(){

		if(isset($_POST["editarIdInformacion"]))
		{
			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarNumMaq"])){

				$tabla = "mantenimiento";

				$datos= array("idTipoMtto"=>$_POST["editarCategoria"],"idPeriodo"=>$_POST["editarPeriodo"],"idMaquina"=>$_POST["editarNumMaq"],"serie"=>$_POST["editarSerie"],"id"=>$_POST["editarIdInformacion"]);

				
				$respuesta = ModeloMantenimiento::mdlEditarInforme($tabla, $datos);

				if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "El Informe se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "mantenimiento";

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
								
									window.location = "mantenimiento";

								}

							});
				

				// 	</script>';
				

				 }

			}
			
		}
	}

	static public function ctrBorrarInforme(){
		
		if(isset($_GET["idInforme"])){

			$tabla = "mantenimiento";
			$datos = $_GET["idInforme"];			

			$respuesta = ModeloMantenimiento::mdlBorrarInforme($tabla, $datos);

			if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La Informe se borro correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "mantenimiento";

								}

							});
				

					</script>';
			}
			

					
		}
	}

}