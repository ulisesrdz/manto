<?php

require_once "conexion.php";

class ModeloGrupos{

	/*====================================
		Registro Categoria
	 =====================================*/
	 static public function mdlCrearGrupo($tabla, $datos){
	 	
	 	
	 	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (descripcion) VALUES (:descripcion) ");

		$stmt -> bindParam(":descripcion", $datos, PDO::PARAM_STR);
		
		
			
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }

	 /*====================================
		Mostrar Categoria
	 =====================================*/
	 static public function mdlMostrarGrupos($tabla, $item , $valor){

	 	if($item != null){

	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

	 		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	 		$stmt -> execute();

	 		return $stmt ->fetch();
	 	}
	 	else{
	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

	 		$stmt -> execute();

	 		return $stmt -> fetchALL();
	 	}

	 	$stmt -> close();
	 	$stmt = null;
	 }

	 /*====================================
		Editar Categoria
	 =====================================*/
	 static public function mdlEditarGrupos($tabla, $datos){

	 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE idGrupo = :id");

		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		
			
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
	 }

	  /*====================================
		Borrar Categoria
	 =====================================*/
	 static public function mdlBorrarCategoria($tabla, $datos){
	 	
	 	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

	 	if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
	 }
}