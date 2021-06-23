<?php

require_once "conexion.php";

class ModeloMaquinas{

	 static public function mdlCrearMaquina($tabla, $datos){
	 	
	 	
	 	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (numMaquina,modelo,marca,area,vs,serie,wb,voltaje,fase,df,idGrupo) VALUES (:numMaquina, :modelo,:marca,:area,:vs,:serie,:wb,:voltaje,:fase,:df,:idGrupo) ");

		$stmt -> bindParam(":numMaquina", $datos["numMaquina"], PDO::PARAM_STR);
		$stmt -> bindParam(":idGrupo", $datos["idGrupo"], PDO::PARAM_STR);
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":area", $datos["area"], PDO::PARAM_STR);
		$stmt -> bindParam(":vs", $datos["vs"], PDO::PARAM_STR);
		$stmt -> bindParam(":wb", $datos["wb"], PDO::PARAM_STR);
		$stmt -> bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
		$stmt -> bindParam(":voltaje", $datos["voltaje"], PDO::PARAM_STR);
		$stmt -> bindParam(":fase", $datos["fase"], PDO::PARAM_STR);
		$stmt -> bindParam(":df", $datos["df"], PDO::PARAM_STR);
					
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }



	  static public function mdlMostrarMaquinas($tabla, $item , $valor){

	 	if($item != null){

	 		$stmt = Conexion::conectar()->prepare("SELECT idMaquina, numMaquina, gr.descripcion, modelo, marca, area, vs, serie,wb,voltaje,fase,df, maquinas.idGrupo FROM $tabla LEFT JOIN grupos gr ON gr.idGrupo= maquinas.idgrupo WHERE $item = :$item");

	 		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	 		$stmt -> execute();

	 		return $stmt ->fetch();
	 	}
	 	else{
	 		$stmt = Conexion::conectar()->prepare("SELECT idMaquina, numMaquina, gr.descripcion, modelo,serie,wb,voltaje,fase,df, maquinas.idGrupo FROM $tabla LEFT JOIN grupos gr ON gr.idGrupo= maquinas.idgrupo");

	 		$stmt -> execute();

	 		return $stmt -> fetchALL();
	 	}

	 	$stmt -> close();
	 	$stmt = null;
	 }

	 static public function mdlEditarMaquinas($tabla, $datos){

	 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idGrupo = :idGrupo, numMaquina = :numMaquina, modelo=:modelo, marca=:marca ,area=:area ,vs=:vs, serie=:serie, wb=:wb,voltaje=:voltaje,fase=:fase WHERE idMaquina = :id");

		$stmt -> bindParam(":idGrupo", $datos["idGrupo"], PDO::PARAM_STR);
		$stmt -> bindParam(":numMaquina", $datos["numMaquina"], PDO::PARAM_STR);
		$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":area", $datos["area"], PDO::PARAM_STR);
		$stmt -> bindParam(":vs", $datos["vs"], PDO::PARAM_STR);
		$stmt -> bindParam(":wb", $datos["wb"], PDO::PARAM_STR);
		$stmt -> bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
		$stmt -> bindParam(":voltaje", $datos["voltaje"], PDO::PARAM_STR);
		$stmt -> bindParam(":fase", $datos["fase"], PDO::PARAM_STR);
		//$stmt -> bindParam(":df", $datos["df"], PDO::PARAM_STR);
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
	 static public function ctrBorrarMaquinas($tabla, $datos){
	 	
	 	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idMaquina = :id");

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