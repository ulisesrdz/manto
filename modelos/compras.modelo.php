<?php

require_once "conexion.php";

class ModeloCompras{

	 /*====================================
		Mostrar Usuarios
	 =====================================*/
	 static public function mdlMostrarCompras($tabla, $item, $valor){

	 	if($item != null)
	 	{
	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla where $item = :$item ORDER BY fecha ASC");
	 	
	 		$stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

	 		$stmt -> execute();

	 		return $stmt -> fetch();
	 	}
	 	else{
	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla ORDER BY fecha ASC");		 	

		 	$stmt -> execute();

		 	return $stmt -> fetchAll();
	 	}


	 	

	 	$stmt -> close();

	 	$stmt = null;
	 }

	  /*====================================
		Mostrar Orden de Compra
	 =====================================*/
	 static public function MdlMostrarOrdenCompras($tabla, $item, $valor){

	 	if($item != null)
	 	{
	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla where $item = :$item and tipo_docto='OC' ORDER BY fecha ASC");
	 	
	 		$stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

	 		$stmt -> execute();

	 		return $stmt -> fetch();
	 	}
	 	else{
	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla where tipo_docto='OC' ORDER BY fecha ASC");		 	

		 	$stmt -> execute();

		 	return $stmt -> fetchAll();
	 	}


	 	

	 	$stmt -> close();

	 	$stmt = null;
	 }

	static public function mdlIngresarCompras($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,id_proveedor,id_vendedor, productos, impuesto,neto,total,metodo_pago,tipo_docto) VALUES (:codigo, :id_proveedor, :id_vendedor, :productos, :impuesto,:neto,:total,:metodo_pago,:tipo_docto)");

		$stmt ->bindParam(":codigo" , $datos["codigo"], PDO::PARAM_INT);
		$stmt ->bindParam(":id_proveedor" , $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt ->bindParam(":id_vendedor" , $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt ->bindParam(":productos" , $datos["productos"], PDO::PARAM_STR);
		$stmt ->bindParam(":impuesto" , $datos["impuesto"], PDO::PARAM_STR);
		$stmt ->bindParam(":neto" , $datos["neto"], PDO::PARAM_STR);
		$stmt ->bindParam(":total" , $datos["total"], PDO::PARAM_STR);
		$stmt ->bindParam(":metodo_pago" , $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt ->bindParam(":tipo_docto" , "F", PDO::PARAM_STR);
		
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlIngresarOrdenCompras($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,id_proveedor,id_vendedor, productos, impuesto,neto,total,forma_pago,tipo_docto) VALUES (:codigo, :id_proveedor, :id_vendedor, :productos, :impuesto,:neto,:total,:forma_pago,:tipo_docto)");

		$stmt ->bindParam(":codigo" , $datos["codigo"], PDO::PARAM_INT);
		$stmt ->bindParam(":id_proveedor" , $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt ->bindParam(":id_vendedor" , $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt ->bindParam(":productos" , $datos["productos"], PDO::PARAM_STR);
		$stmt ->bindParam(":impuesto" , $datos["impuesto"], PDO::PARAM_STR);
		$stmt ->bindParam(":neto" , $datos["neto"], PDO::PARAM_STR);
		$stmt ->bindParam(":total" , $datos["total"], PDO::PARAM_STR);
		$stmt ->bindParam(":forma_pago" , $datos["forma_pago"], PDO::PARAM_STR);
		$stmt ->bindParam(":tipo_docto" , $datos["tipo_docto"], PDO::PARAM_STR);
		
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEditarCompra($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total= :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		//$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEliminarCompra($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlRangoFechaCompras($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt->execute();

			return $stmt -> fetchAll();

		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' ");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt -> fetchAll();

		}else {

			$fechaActual = new DateTime();
			$fechaActual -> add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 -> add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ");

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$	fechaInicial' AND '$fechaFinal' ");

			}

		

			$stmt->execute();

			return $stmt -> fetchAll();

		}
	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalCompras($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}