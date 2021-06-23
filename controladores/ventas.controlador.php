<?php

class ControladorVentas{




		/*=============================
		Mostrar de Ventas
		==============================*/
	static public function ctrMostrarVentas($item, $valor){
		$tabla= "ventas";
		$respuesta = ModeloVentas::MdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================
		Crear Ventas
	==============================*/

	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

				/*=============================
					Actializar las compras del cliente y reducir el STOCK, aumenta Ventas
				  ==============================*/

				  $listaProductos = json_decode($_POST["listaProductos"], true);


				  $totalProductosComprados = array();

				  //var_dump($listaProductos);
				  foreach ($listaProductos as $key => $value) {

				  	array_push($totalProductosComprados, $value["cantidad"]);
				  	
				  	$tablaProductos = "productos";

				  	$item = "id";
				  	$valor = $value["id"];
				  	$orden = "id";

				  	$traerProductos = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor,$orden);

				  	//var_dump($traerProductos);

				  	$item1a = "ventas";
				  	$valor1a = $value["cantidad"] +  $traerProductos["ventas"];

				  	$nuevasVentas = ModeloProductos::mdlActualizarProductos($tablaProductos, $item1a, $valor1a, $valor);

				  	$item1b = "stock";
				  	$valor1b = $value["stock"];

				  	$nuevoStock = ModeloProductos::mdlActualizarProductos($tablaProductos, $item1b, $valor1b, $valor);
				  }


				  $tablaClientes = "clientes";

				  $item = "id";
				  $valor = $_POST["seleccionarCliente"];

				  $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item , $valor);

				  $item1 = "compras";
				  $valor1 = array_sum($totalProductosComprados) + $traerCliente["compras"];

				  $comprasCliente = ModeloClientes::mdlActualizarClientes($tablaClientes, $item1, $valor1, $valor);

				  $item1b = "ultima_compra";

				  $fecha = date('Y-m-d');
				  $hora = date('H:i:s');

				  $valor1b = $fecha.' '.$hora;

				    $comprasCliente = ModeloClientes::mdlActualizarClientes($tablaClientes, $item1b, $valor1b, $valor);

				  	/*=============================
							Guardar la Compra
					==============================*/

					$tabla = "ventas";

					$datos = array("id_cliente" => $_POST["seleccionarCliente"],
									"id_vendedor" => $_POST["idVendedor"],
									"codigo" => $_POST["nuevaVenta"],
									"productos" => $_POST["listaProductos"],
									"impuesto" => $_POST["nuevoPrecioImpuesto"],
									"neto" => $_POST["nuevoPrecioNeto"],
									"total" => $_POST["totalVenta"],
									"metodo_pago" => $_POST["listaMetodoPago"]);

					$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La venta se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "ventas";

								}

							});
				

							</script>';
					}
		}

	}

	/*=============================
		Editar Ventas
	==============================*/
	static public function ctrEditarVentas(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			
			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   "impuesto" => $_POST["nuevoPrecioImpuesto"],
							"neto" => $_POST["nuevoPrecioNeto"],
							"total" => $_POST["totalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

	}


	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

				/*=============================
					Formater tabla de Productos
				  ==============================*/

				  $tabla = "ventas";

				  $item = "codigo";
				  $valor = $_POST["editarVenta"];

				  $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);  

				  $productos = json_decode($traerVenta["productos"],true);

				  

				  $totalProductosComprados = array();

				  foreach ($productos as $key => $value) {

				  	array_push($totalProductosComprados, $value["cantidad"]);

				  	$tablaProductos = "productos";

				  	$item = "id";
				  	$valor =  $value["id"];

				  	$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
				  	
				  	$item1a = "ventas";
				  	$valor1a =  $traerProducto["ventas"] - $value["cantidad"];

				  	$nuevaVentas = ModeloProductos::mdlActualizarProductos($tablaProductos, $item1a, $valor1a, $valor);

				  	$item1b = "stock";
				  	$valor1b =  $value["cantidad"] + $traerProducto["stock"];

				  	$nuevoStock = ModeloProductos::mdlActualizarProductos($tablaProductos, $item1b, $valor1b, $valor);

				  	$tablaClientes = "clientes";

					$itemCliente = "id";
					$valorCliente = $_POST["seleccionarCliente"];
	   			    
	   			    $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

	   			    $item1 = "compras";
				    $valor1 = $traerCliente["compras"] - array_sum($totalProductosComprados) ;

				    $comprasCliente = ModeloClientes::mdlActualizarClientes($tablaClientes, $item1, $valor1, $valor);

				  }

				/*========================================================================
					Actializar las compras del cliente y reducir el STOCK, aumenta Ventas
				  ========================================================================*/

				  $listaProductos = json_decode($_POST["listaProductos"], true);
				  //var_dump($listaProductos);

				  $totalProductosComprados_2 = array();

				  //var_dump($listaProductos);
				  

				  foreach ($listaProductos_2 as $key => $value) {

				  		array_push($totalProductosComprados_2, $value["cantidad"]);
					  	
					  	$tablaProductos_2 = "productos";

					  	$item_2 = "id";
					  	$valor_2 = $value["id"];

					  	$traerProductos_2 = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

					  	//var_dump($traerProductos);

					  	$item1a_2 = "ventas";
					  	$valor1a_2 = $value["cantidad"] +  $traerProductos_2["ventas"];

					  	$nuevasVentas_2 = ModeloProductos::mdlActualizarProductos($tablaProductos, $item1a, $valor1a, $valor);

					  	$item1b_2 = "stock";
					  	$valor1b_2 = $value["stock"];

					  	$nuevoStock_2 = ModeloProductos::mdlActualizarProductos($tablaProductos, $item1b, $valor1b, $valor);
				  }


				  $tablaClientes_2 = "clientes";

				  $item_2 = "id";
				  $valor_2 = $_POST["seleccionarCliente"];

				  $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item , $valor);

					//var_dump($valor);

				  $item1_2 = "compras";
				  $valor1_2 = array_sum($totalProductosComprados) + $traerCliente["compras"];

				  $comprasCliente_2 = ModeloClientes::mdlActualizarClientes($tablaClientes, $item1, $valor1, $valor);

				  $item1b_2 = "ultima_compra";

				  $fecha_2 = date('Y-m-d');
				  $hora_2 = date('H:i:s');

				  $valor1b_2 = $fecha_2.' '.$hora_2;

				    $comprasCliente_2 = ModeloClientes::mdlActualizarClientes($tablaClientes, $item1b, $valor1b, $valor);

				  	/*=============================
							Guardar la Cambios
					==============================*/

					$tabla = "ventas";

					$datos = array(
									"id_vendedor" => $_POST["idVendedor"],
									"codigo" => $_POST["editarVenta"],
									"productos" => $_POST["listaProductos"],
									"impuesto" => $_POST["nuevoPrecioImpuesto"],
									"neto" => $_POST["nuevoPrecioNeto"],
									"total" => $_POST["totalVenta"],
									"metodo_pago" => $_POST["listaMetodoPago"]);

					$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La venta se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "ventas";

								}

							});
				

							</script>';
					}
		}

	}


	/*=============================
		Editar Ventas
	==============================*/
	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";
			$tablaClientes= "clientes";
			$item = "id";

			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item,$valor);

			/*=============================
				Actualizar Fecha ultima Compra
			==============================*/

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas,$valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {


				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);
				}

			}
			//var_dump(count($guardarFechas));
			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item ="ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarClientes($tablaClientes, $item,$valor,$valorIdCliente);
				}else{

					$item ="ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarClientes($tablaClientes, $item,$valor,$valorIdCliente);
				}
			}else{
				
				$item ="ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarClientes($tablaClientes, $item,$valor,$valorIdCliente);
			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProductos($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProductos($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarClientes($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/
//$respuesta="";
			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}


			
		}


	}

	/*=============================
		Rango de Fechas
	==============================*/

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechaVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	/*=============================================
			DescargarReporte
	=============================================*/

	public function ctrDescargarReporte(){
		if (isset($_GET["reporte"])) {

			$tabla = "ventas";
			$item = null;
			$valor = null;
			
			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechaVentas($tabla,$_GET["fechaInicial"],$_GET["fechaFinal"]);

			}else{

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}

			/*=============================================
						Crear Archivo Excel
			=============================================*/
			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarCliente("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}
	}

	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

}
