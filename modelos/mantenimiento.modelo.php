e<?php

require_once "conexion.php";

class ModeloMantenimiento{

	static public function mdlMostrarInformacion(){

		$stmt = Conexion::conectar()->prepare("SELECT m.id, p.descripcion, ma.descripcion descripcionG, ma.idGrupo 
			FROM mantenimiento m 
			JOIN periodo p ON p.id = m.idPeriodo 
			JOIN grupos ma ON m.idGrupo = ma.idGrupo");

 		$stmt -> execute();

 		return $stmt -> fetchALL();
	 	
	 	$stmt -> close();
	 	$stmt = null;
	 }

	 static public function mdlMostrarDoctos(){

		$stmt = Conexion::conectar()->prepare("SELECT m.id id, nomenclatura,tipoDocumento, p.descripcion, ma.numMaquina FROM mttomaestro m LEFT JOIN periodo p ON p.id = m.idFrecuencia JOIN maquinas ma ON m.idMaquina = ma.idMaquina");

 		$stmt -> execute();

 		return $stmt -> fetchALL();
	 	
	 	$stmt -> close();
	 	$stmt = null;
	 }

	 static public function mdlMostrarPeriodo($tabla){

	 
 		$stmt = Conexion::conectar()->prepare("SELECT id,identificador,descripcion FROM $tabla ");

 		$stmt -> execute();

 		return $stmt -> fetchALL();
	 	

	 	$stmt -> close();
	 	$stmt = null;
	 }

	 static public function mdlIngresarInformacion($tabla, $datos){
	 	
	 	
	 	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idTipoMtto, idGrupo,idPeriodo ) VALUES (:idTipoMtto, :idGrupo, :idPeriodo) ");

		$stmt -> bindParam(":idTipoMtto", $datos["idTipoMtto"], PDO::PARAM_STR);
		$stmt -> bindParam(":idGrupo", $datos["idGrupo"], PDO::PARAM_STR);
		$stmt -> bindParam(":idPeriodo", $datos["idPeriodo"], PDO::PARAM_STR);
		
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }


	 static public function mdlIngresarTarea($tabla, $datos){
	 	
	 	
	 	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idMtto, tarea ) VALUES (:idMtto, :tarea) ");

		$stmt -> bindParam(":idMtto", $datos["idMtto"], PDO::PARAM_STR);
		$stmt -> bindParam(":tarea", $datos["nuevaTarea"], PDO::PARAM_STR);		
		
			
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }


	 static public function mdlMostrarTarea($tabla, $item, $valor){

	 
 		if($item != null){

	 		$stmt = Conexion::conectar()->prepare("SELECT id, tarea, idMtto FROM $tabla WHERE $item = :$item");

	 		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	 		$stmt -> execute();

	 		return $stmt ->fetchALL();
	 	}
	 	else{
	 		$stmt = Conexion::conectar()->prepare("SELECT id, tarea, idMtto FROM $tabla");

	 		$stmt -> execute();

	 		return $stmt -> fetchALL();
	 	}

	 	$stmt -> close();
	 	$stmt = null;
	 }

	 /*====================================
		Borrar Tarea
	 =====================================*/
	 static public function mdlBorrarTarea($tabla, $datos){
	 	
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


	 static public function mdlMostrarUnirseral($tabla, $item, $valor){

	 
 		if($item != null){

	 		$stmt = Conexion::conectar()->prepare("SELECT id, idTipoMtto, idMaquina, idPeriodo FROM $tabla WHERE $item = :$item");

	 		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	 		$stmt -> execute();

	 		return $stmt ->fetch();
	 	}
	 	
	 	$stmt -> close();
	 	$stmt = null;
	 }

	 static public function mdlMostrarInforme(){

		$stmt = Conexion::conectar()->prepare("SELECT id, idTipoMtto, idMaquina, idPeriodo FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

 		$stmt -> execute();

 		return $stmt -> fetchALL();
	 	
	 	$stmt -> close();
	 	$stmt = null;
	 }


	 static public function mdlEditarInforme($tabla, $datos){

	 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idTipoMtto = :idTipoMtto, idMaquina = :idMaquina, idPeriodo = :idPeriodo, serie = :serie WHERE id = :id");

		$stmt -> bindParam(":idTipoMtto", $datos["idTipoMtto"], PDO::PARAM_STR);
		$stmt -> bindParam(":idMaquina", $datos["idMaquina"], PDO::PARAM_STR);
		$stmt -> bindParam(":idPeriodo", $datos["idPeriodo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		
			
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
	 }


	  static public function mdlBorrarInforme($tabla, $datos){
	 	
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
?>