<?php

require_once "conexion.php";

class ModeloInformacion{

	 /*====================================
		Mostrar 
	 =====================================*/
	 static public function mdlMostrarInformacion($tabla, $item, $valor){

	 	if($item != null)
	 	{
	 		$stmt = Conexion::conectar()->prepare("SELECT id,nombre,diaCreacion,imagenWeb,rfc FROM  $tabla where id = :id");
	 	
	 		$stmt -> bindParam(":id" ,$valor, PDO::PARAM_STR);

	 		$stmt -> execute();

	 		return $stmt -> fetch();
	 	}
	 	else{
	 		$stmt = Conexion::conectar()->prepare("SELECT id,nombre,diaCreacion,imagenWeb,rfc FROM  $tabla ");		 	

		 	$stmt -> execute();

		 	return $stmt -> fetchAll();
	 	}


	 	

	 	$stmt -> close();

	 	$stmt = null;
	 }

	 /*====================================
		Registro Usuarios
	 =====================================*/
	 static public function mdlCrearInformacion($tabla, $datos){
	 	
	 	
	 	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, imagenAPK, diaCreacion, imagenWeb, rfc) VALUES (:nombre,:imagenAPK,:diaCreacion,:imagenWeb, :rfc) ");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagenAPK", $datos["imagenAPK"], PDO::PARAM_STR);
		$stmt -> bindParam(":diaCreacion", $datos["diaCreacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagenWeb", $datos["logo"], PDO::PARAM_STR);
		$stmt -> bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
		
			
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }

	 /*====================================
		Editar Usuarios  2712680
	 =====================================*/
	 static public function mdlEditarInformacion($tabla, $datos){	 	
	 	
	 	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, imagenAPK = :imagenAPK, rfc=:rfc ");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);		
		$stmt -> bindParam(":imagenAPK", $datos["imagenAPK"], PDO::PARAM_STR);
		//$stmt -> bindParam(":diaCreacion", $datos["diaCreacion"], PDO::PARAM_STR);
		//$stmt -> bindParam(":imagenWeb", $datos["logo"], PDO::PARAM_STR);
		$stmt -> bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
		//$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
		
			
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }
}