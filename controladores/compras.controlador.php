<?php

class ControladorCompras{




		/*=============================
		Mostrar de Ventas
		==============================*/
	static public function ctrMostrarCompras($item, $valor){
		$tabla= "compras";
		$respuesta = ModeloCompras::MdlMostrarCompras($tabla, $item, $valor);

		return $respuesta;
	}

			/*=============================
		Mostrar de Orden Compra
		==============================*/
	static public function ctrMostrarOrdenCompra($item, $valor){
		$tabla= "compras";
		$respuesta = ModeloCompras::MdlMostrarOrdenCompras($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================
		Crear Ventas
	==============================*/

	static public function ctrCrearCompra(){

		if(isset($_POST["nuevaCompra"])){

				/*=============================
					Actializar las compras del cliente y reducir el STOCK, aumenta Ventas
				  ==============================*/

				  $listaProductos = json_decode($_POST["listaProductos"], true);


				  $totalProductosComprados = array();

				  //var_dump($listaProductos);
				  foreach ($listaProductos as $key => $value) {

				  	array_push($totalProductosComprados, $value["cantidad"]);
				  	
				  	var_dump($totalProductosComprados);
				  	
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


				  $tablaProveedores = "proveedores";

				  $item = "id";
				  $valor = $_POST["seleccionarProveedor"];

				  $traerProveedor = ModeloProveedores::mdlMostrarProveedores($tablaProveedores, $item , $valor);

				  $item1 = "compras";
				  $valor1 = array_sum($totalProductosComprados) + $traerProveedor["compras"];

				  $comprasProveedor = ModeloProveedores::mdlActualizarProveedores($tablaProveedores, $item1, $valor1, $valor);

				  $item1b = "ultima_compra";

				  $fecha = date('Y-m-d');
				  $hora = date('H:i:s');

				  $valor1b = $fecha.' '.$hora;

				   $comprasProveedor = ModeloProveedores::mdlActualizarProveedores($tablaProveedores, $item1b, $valor1b, $valor);

				  	/*=============================
							Guardar la Compra
					==============================*/

					$tabla = "compras";

					$datos = array("id_proveedor" => $_POST["seleccionarProveedor"],
									"id_vendedor" => $_POST["idVendedor"],
									"codigo" => $_POST["nuevaCompra"],
									"productos" => $_POST["listaProductos"],
									"impuesto" => $_POST["nuevoPrecioImpuesto"],
									"neto" => $_POST["nuevoPrecioNeto"],
									"total" => $_POST["totalCompra"],
									"metodo_pago" => $_POST["listaMetodoPago"]);
	
	//var_dump($datos);

					$respuesta = ModeloCompras::mdlIngresarCompras($tabla, $datos);
//var_dump($respuesta);
					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La compra se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "compras";

								}

							});
				

							</script>';
					}else{

						echo '<script>

							swal({

								type: "failed",
								title: "Ocurrio un error!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									

								}

							});
				

							</script>';
					}
		}

	}

	static public function ctrCrearOrdenCompra(){

		if(isset($_POST["nuevaOrdenCompra"])){

				/*=============================
					Actializar las compras del cliente y reducir el STOCK, aumenta Ventas
				  ==============================*/

				  $listaProductos = json_decode($_POST["listaProductos"], true);


				  $totalProductosComprados = array();

				  //var_dump($listaProductos);
				  foreach ($listaProductos as $key => $value) {

				  	array_push($totalProductosComprados, $value["cantidad"]);
				  	
				  	//var_dump($totalProductosComprados);
				  	
				  
				  }


				

				  	/*=============================
							Guardar la Compra
					==============================*/

					$tabla = "compras";

					$datos = array("id_proveedor" => $_POST["seleccionarProveedor"],
									"id_vendedor" => $_POST["idVendedor"],
									"codigo" => $_POST["nuevaOrdenCompra"],
									"productos" => $_POST["listaProductos"],
									"impuesto" => $_POST["nuevoPrecioImpuesto"],
									"neto" => $_POST["nuevoPrecioNeto"],
									"total" => $_POST["totalCompra"],
									"forma_pago" => $_POST["listaFormaPago"],
									"tipo_docto" => 'OC');
	
	//var_dump($datos);

					$respuesta = ModeloCompras::mdlIngresarOrdenCompras($tabla, $datos);
	//				var_dump($respuesta);
					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La compra se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "compras";

								}

							});
				

							</script>';
					}else{

						echo '<script>

							swal({

								type: "failed",
								title: "Ocurrio un error!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									

								}

							});
				

							</script>';
					}
		}

	}

	/*=============================
		Editar Ventas
	==============================*/
	static public function ctrEditarCompras(){

		if(isset($_POST["editarCompra"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "compras";

			$item = "codigo";
			$valor = $_POST["editarCompra"];

			$traerCompra = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);
			
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

				$tablaProveedores = "proveedores";

				$itempPoveedor = "id";
				$valorProveedor = $_POST["seleccionarCliente"];

				$traerProveedor = ModeloProveedores::mdlMostrarProveedores($tablaProveedores, $itemProveedor, $valorProveedor);

				$item1a = "compras";
				$valor1a = $traerProveedor["compras"] - array_sum($totalProductosComprados);

				$comprasProveedor = ModeloClientes::mdlActualizarProveedores($tablaProveedores, $item1a, $valor1a, $valorProveedor);

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

				$tablaProveedor_2 = "proveedores";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarProveedor"];

				$traerProveedor_2 = ModuloProveedores::mdlMostrarProveedores($tablaProveedor_2, $item_2, $valor_2);

				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerProveedor_2["compras"];

				$comprasProveedor_2 = ModeloClientes::mdlActualizarCliente($tablaProveedor_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarProveedores($tablaProveedor_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarProveedor"],
						   "codigo"=>$_POST["editarCompra"],
						   "productos"=>$listaProductos,
						   "impuesto" => $_POST["nuevoPrecioImpuesto"],
							"neto" => $_POST["nuevoPrecioNeto"],
							"total" => $_POST["totalCompra"],
						   "metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloCompras::mdlEditarCompra($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La compra ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "compras";

								}
							})

				</script>';

			}

		}

	}


	static public function ctrEditarCompra(){

		if(isset($_POST["editarCompra"])){

				/*=============================
					Formater tabla de Productos
				  ==============================*/

				  $tabla = "compras";

				  $item = "codigo";
				  $valor = $_POST["editarCompra"];

				  $traerCompra = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);  

				  $productos = json_decode($traerCompra["productos"],true);

				  

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

				  	$tablaProveedores = "proveedores";

					$itemProveedor = "id";
					$valorProveedor = $_POST["seleccionarProveedor"];
	   			    
	   			    $traerCliente = ModeloProveedores::mdlMostrarProveedores($tablaProveedores, $itemProveedor, $valorProveedor);

	   			    $item1 = "compras";
				    $valor1 = $traerCliente["compras"] - array_sum($totalProductosComprados) ;

				    $comprasProveedor = ModeloProveedores::mdlActualizarProveedores($tablaProveedores, $item1, $valor1, $valor);

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


				  $tablaProveedores_2 = "proveedores";

				  $item_2 = "id";
				  $valor_2 = $_POST["seleccionarProveedor"];

				  $traerProveedor = ModeloProveedores::mdlMostrarProveedores($tablaProveedores_2, $item , $valor);

					//var_dump($valor);

				  $item1_2 = "compras";
				  $valor1_2 = array_sum($totalProductosComprados) + $traerCliente["compras"];

				  $comprasCliente_2 = ModeloProveedores::mdlActualizarProveedores($tablaProveedores_2, $item1, $valor1, $valor);

				  $item1b_2 = "ultima_compra";

				  $fecha_2 = date('Y-m-d');
				  $hora_2 = date('H:i:s');

				  $valor1b_2 = $fecha_2.' '.$hora_2;

				    $comprasProveedor_2 = ModeloProveedores::mdlActualizarProveedores($tablaProveedores, $item1b, $valor1b, $valor);

				  	/*=============================
							Guardar la Cambios
					==============================*/

					$tabla = "compras";

					$datos = array(
									"id_vendedor" => $_POST["idVendedor"],
									"codigo" => $_POST["editarCompra"],
									"productos" => $_POST["listaProductos"],
									"impuesto" => $_POST["nuevoPrecioImpuesto"],
									"neto" => $_POST["nuevoPrecioNeto"],
									"total" => $_POST["totalCompra"],
									"metodo_pago" => $_POST["listaMetodoPago"]);

					$respuesta = ModeloCompras::mdlEditarCompras($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							swal({

								type: "success",
								title: "La compra se guardo correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								

							}).then((result)=>{

								if(result.value){
								
									window.location = "compras";

								}

							});
				

							</script>';
					}
		}

	}


	/*=============================
		Editar Ventas
	==============================*/
	static public function ctrEliminarCompras(){

		if(isset($_GET["idCompra"])){

			$tabla = "compras";
			$tablaProveedores = "proveedores";
			$item = "id";

			$valor = $_GET["idCompra"];

			$traerCompra = ModeloCompras::mdlMostrarCompras($tabla, $item,$valor);

			/*=============================
				Actualizar Fecha ultima Compra
			==============================*/

			$itemCompras = null;
			$valorCompras = null;

			$traerCompras = ModeloCompras::mdlMostrarCompras($tabla, $itemCompras,$valorCompras);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {


				if($value["id_proveedor"] == $traerCompras["id_proveedor"]){

					array_push($guardarFechas, $value["fecha"]);
				}

			}
			//var_dump(count($guardarFechas));
			if(count($guardarFechas) > 1){

				if($traerCompras["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item ="ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdProveedores = $traerCompras["id_proveedor"];

					$comprasProveedores = ModeloProveedores::mdlActualizarProveedores($tablaProveedores, $item,$valor,$valorIdProveedores);
				}else{

					$item ="ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdProveedor = $traerCompras["id_proveedor"];

					$comprasProveedor = ModeloProveedores::mdlActualizarProveedores($tablaProveedores, $item,$valor,$valorIdProveedor);
				}
			}else{
				
				$item ="ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdProveedor = $traerCompras["id_proveedor"];

				$comprasProveedor = ModeloProveedores::mdlActualizarProveedores($tablaProveedores, $item,$valor,$valorIdProveedor);
			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerCompras["productos"], true);

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

			$tablaProveedores = "proveedores";

			$itemProveedor = "id";
			$valorProveedor = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaProveedores, $itemProveedor, $valorProveedor);

			$item1a = "compras";
			$valor1a = $traerProveedor["compras"] - array_sum($totalProductosComprados);

			$comprasProveedores = ModeloProveedores::mdlActualizarProveedores($tablaProveedores, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/
//$respuesta="";
			$respuesta = ModeloCompras::mdlEliminarCompras($tabla, $_GET["idCompra"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La compra ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "compras";

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

		$tabla = "compras";

		$respuesta = ModeloCompras::mdlRangoFechaVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	/*=============================================
			DescargarReporte
	=============================================*/

	public function ctrDescargarReporte(){
		if (isset($_GET["reporte"])) {

			$tabla = "compras";
			$item = null;
			$valor = null;
			
			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$compras = ModeloCompras::mdlRangoFechaCompras($tabla,$_GET["fechaInicial"],$_GET["fechaFinal"]);

			}else{

				$compras = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

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

			foreach ($compras as $row => $item){

				$proveedores = ControladorProveedores::ctrMostrarProveedores("id", $item["id_proveedor"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$proveedores["nombre"]."</td>
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

	public function ctrSumaTotalCompras(){

		$tabla = "compras";

		$respuesta = ModeloCompras::mdlSumaTotalCompras($tabla);

		return $respuesta;

	}

}
