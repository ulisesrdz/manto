<?php

require_once "conexion.php";

class ModeloProductos{

	 /*====================================
		Mostrar Productos
	 =====================================*/
	 static public function mdlMostrarProductos($tabla, $item, $valor, $orden){

	 	if($item != null)
	 	{
	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla where $item = :$item order by $orden desc" );
	 	
	 		$stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

	 		$stmt -> execute();

	 		return $stmt -> fetch();
	 	}
	 	else{
	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla ORDER BY $orden DESC");		 	

		 	$stmt -> execute();

		 	return $stmt -> fetchAll();
	 	}


	 	
	 	$stmt -> close();

	 	$stmt = null;
	 }

	  /*====================================
				Crear Productos
	 =====================================*/
	 static public function mdlIngresarProductos($tabla, $datos){
	 	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_Categoria, codigo, descripcion, stock, precio_venta, precio_compra, imagen) VALUES (:id_Categoria, :codigo, :descripcion, :stock, :precio_venta, :precio_compra, :imagen) ");

		$stmt -> bindParam(":id_Categoria", $datos["id_Categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		
			
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }

	 /*====================================
				Editar Productos
	 =====================================*/
	 static public function MdlEditarProductos($tabla, $datos){
	 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, stock = :stock, precio_venta = :precio_venta, precio_compra = :precio_compra, imagen = :imagen WHERE codigo = :codigo");

		
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		
			
		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }

	 /*====================================
		Borrar PRoductos
	 =====================================*/
	 static public function mdlBorrarProducto($tabla, $datos){
	 	
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

	  /*====================================
		Actualizar Productos
	 =====================================*/

	 static public  function mdlActualizarProductos($tabla, $item1, $valor1, $valor){

	 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);
		

		if( $stmt -> execute() ){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	 }

	 static public function mdlMostrarSumaVentas($tabla){

	 	$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla ");

	 	$stmt -> execute();

	 	return $stmt -> fetch();

	 	$stmt -> close();

	 	$stmt = null;

	 }


}