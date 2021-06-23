  /*=============================
       Cargar Tabla Dinamica Ventas
  ============================== */
 /*
  $.ajax({

	url: "ajax/datatable-productos.ajax.php",
	success:function(respuesta){

		console.log("respuesta",respuesta);
	}

 })
 */
  /*=============================
       Variable Local Storage
  ==============================*/
   
/*
  if(localStorage.getItem("capturarRango") != null){

  	$("#daterange-btn span").html(localStorage.getItem("capturarRango"));

  }else{

  	$("#daterange-btn span").html('<i class="fa fa-calendaer"></i> Rango Fecha');

  }*/


 /* =============================
       Cargar Tabla Dinamica Ventas
  =============================*/

$('.tablasCompras').DataTable( {
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );


   /* =============================
       Agregar Producto Ventas
  ============================== */

  $(".tablasCompras tbody").on("click", "button.agregarProducto", function(){

  		var idProducto = $(this).attr("idProducto");
  		

  		$(this).removeClass("btn-primary agregarProducto");

  		$(this).addClass("btn-default");

  		var datos  = new FormData();
  		datos.append("idProducto", idProducto);

  		$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			
			var descripcion = respuesta["descripcion"];
			var stock = respuesta["stock"];
			var precio = respuesta["precio_venta"];

			 /* =============================
       				    Stock en Cero
  				============================= 

  				if(stock == 0){
  					swal({
  						title:"No hay stock suficiente",
  						type:"error",
  						confirmButtonText: "¡Cerrar!"
  					});

  					$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

  					return;
  				}
*/
			$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto agregarProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+ (Number(stock) + 1) +'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

	      
			//Sumar Total
			sumarTotalPrecios()

			//Agregar Impuestos
			agregarImpuesto()

			//Listar Productos
			listarProductos()

			//Dar Formato a los numeros
			$(".nuevoPrecioProducto").number(true,2);

			
		}

	})

  }); 

   /* ======================================================
      Cuando navege en la tabla y se elimine un producto
  ========================================================== */

  $(".tablasCompras").on("draw.dt", function(){

  	if(localStorage.getItem("quitarProducto") != null){
  		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
  		for (var i = 0; i < listaIdProductos.length; i++) {
			
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass("btn-default");  			
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass("btn-primary agregarProducto");
  		}
  	}

  })


 /* =============================
       Eliminar Producto Ventas
  ============================== */
	var idQuitarProducto = [];

	localStorage.removeItem("quitarProducto");

 $(".formularioCompra").on("click", "button.quitarProducto", function(){

 	$(this).parent().parent().parent().parent().remove();

 	var idProducto = $(this).attr("idProducto");

 /* =============================================
   		Almacenar en el localStorage Producto Ventas
  =================================================== */

  	if(localStorage.getItem("quitarProducto") == null){
  		idQuitarProducto = [];
  	}else{
  		idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
  	}

  	idQuitarProducto.push({"idProducto":idProducto});

  	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

 	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
 	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

 	 if($(".nuevoProducto").children().length == 0 ){

			$("#nuevoImpuestoCompra").val(0);
			$("#nuevoTotalCompra").val(0);
			$("#totalCompra").val(0);
			$("#nuevoTotalCompra").attr("total",0);

		}else{

			sumarTotalPrecios()

			agregarImpuesto()
			
			//Listar Productos
			listarProductos()

		}

});

 /* =================================================
       Agregar Productos para Dispositivos Moviles
  =================================================== */
var numProducto = 0;
$(".btnAgregarProducto").click(function(){

	numProducto++;
	var datos = new FormData();
	datos.append("traerProductos", "ok");
	console.log("Datos",datos);
	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

	              '<select class="form-control nuevaDescripcionProducto agregarProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

	              '<option>Seleccione el producto</option>'+

	              '</select>'+  

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3 ingresoCantidad">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>');

	         /* ===========================================================
      				Agregar Productos al select para Dispositivos Moviles
  				=========================================================== */

  				respuesta.forEach(funcionForEach);
  				
  				function funcionForEach(item,index){

  					if(item.stock != 0){

  						$("#producto"+numProducto).append(

  							'<option idProducto="'+item.idProducto+'" value"'+item.descripcion+'">'+item.descripcion+'</option>'
  						)

  					}
  					
  				}
  				

				sumarTotalPrecios()

				agregarImpuesto()
  				
				

				// PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        	$(".nuevoPrecioProducto").number(true, 2);
		}
	})
		
	
})

 /* ===========================================================
      	Seleccionar Precio-Productos para Dispositivos Moviles
  	========================================================== */

  	$(".formularioCompra").on("change", "select.nuevaDescripcionProducto", function(){

  		var nombreProductos = $(this).val();

  		var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  		var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
		
  		var datos = new FormData();
		datos.append("nombreProductos", nombreProductos);

  		$.ajax({
			url: "ajax/productos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function(respuesta){
				$(nuevaCantidadProducto).attr("stock",respuesta["stock"]);
				$(nuevaCantidadProducto).attr("nuevoStock",Number(respuesta["stock"]) + 1);
				$(nuevoPrecioProducto).val(respuesta["precio_venta"]);
				$(nuevoPrecioProducto).attr("precioReal",respuesta["precio_venta"]);

				// AGRUPAR PRODUCTOS EN FORMATO JSON

	        	listarProductos()
			}
		})


  	})

  	/* =================================
      	Modificar la cantidad
  	================================= */
  	  	$(".formularioCompra").on("change", "input.nuevaCantidadProducto", function(){

	  			/*if(Number($(this).val()) > Number($(this).attr("stock"))){

	  				$(this).val(1);

	  				swal({
  						title:"La cantidad supera el stock",
  						text:"¡Solo hay "+$(this).attr("stock")+" unidades",
  						type:"error",
  						confirmButtonText: "¡Cerrar!"
  					});
	  			}*/
	  			
	  			var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	  			var precioFinal = $(this).val() * precio.attr("precioReal");

	  			//console.log("precioFinal",precioFinal);
	  			precio.val(precioFinal);

	  			var nuevoStock = Number($(this).attr("stock") + $(this).val());
	  			//console.log('stock ', nuevoStock);
				$(this).attr("nuevoStock", nuevoStock);

	  			sumarTotalPrecios()

	  			agregarImpuesto()

	  			//Listar Productos
				listarProductos()
  	  	});

  	/* =================================
      	Sumar Precios
  	================================= */
function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalCompra").val(sumaTotalPrecio);
	$("#totalCompra").val(sumaTotalPrecio);
	$("#nuevoTotalCompra").attr("total",sumaTotalPrecio);


}

	/* =================================
      	Funcion Agregar Impuestos
  	================================= */
  	
function agregarImpuesto(){

	var impuesto = $("#nuevoImpuestoCompra").val();
	var precioTotal = $("#nuevoTotalCompra").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
	$("#nuevoTotalCompra").val(totalConImpuesto);

	$("#totalCompra").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}


  	/* =================================
      	Cuando cambia el impuesto
  	================================= */

  	$("#nuevoImpuestoCompra").change(function(){
		
		agregarImpuesto();
  	
  	});

 /* =================================
      	Formato Total Venta
  	================================= */
	$("#nuevoTotalCompra").number(true,2);



/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "Efectivo"){

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			 '<div class="col-xs-4">'+ 

			 	'<div class="input-group">'+ 

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

			 		'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+

			 	'</div>'+

			 '</div>'+

			 '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+

			 	'</div>'+

			 '</div>'

		 )

		// Agregar formato al precio

		$('#nuevoValorEfectivo').number( true, 2);
      	$('#nuevoCambioEfectivo').number( true, 2);


      	// Listar método en la entrada
      	listarMetodo()

	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')

	}

	

})


/*=============================================
SELECCIONAR Forma DE PAGO Orden Compra
=============================================*/
$("#nuevoFormaPago").change(function(){

	var formaPago = $(this).val();

	if(formaPago == "S"){

   		$("#listaFormaPago").val("Semana");

   	}else{ 	
		
		if(formaPago == "Q"){

   			$("#listaFormaPago").val("Quincena");

   		}else {
		
			$("#listaFormaPago").val("Mes");

   		}

   	}

})


    function listarMetodo(){

   	var listaMetodos = "";
   	
   	if($("#nuevoMetodoPago").val() == "Efectivo"){

   		$("#listaMetodoPago").val("Efectivo");

   	}else{
   		
   		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());		
   	}
   	//console.log("metodoPago", listaMetodoPago);
   }

 /*=============================================
	CAMBIO EN EFECTIVO
   =============================================*/
$(".formularioCompra").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();
//console.log('efectivo',efectivo)
	var cambio =  Number(efectivo) - Number($('#nuevoTotalCompra').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

 /*=============================================
	CAMBIO Transaccion
   =============================================*/
$(".formularioCompra").on("change", "input#nuevoCodigoTransaccion", function(){

	listarMetodo();

})

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}
	//console.log("lista", JSON.stringify(listaProductos));

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}

 /*=====================================
          Listado Metodo de Pago
   ======================================*/
   function listarMetodo(){

   	var listaMetodos = "";

   	if($("#nuevoMetodoPago").val() == "Efectivo"){

   		$("#listaMetodoPago").val("Efectivo");

   	}else{
   		
   		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());		
   	}
   	//console.log("metodoPago", listaMetodoPago);
   }

    function listarMetodo(){

   	var listaMetodos = "";
   	
   	if($("#nuevoMetodoPago").val() == "Efectivo"){

   		$("#listaMetodoPago").val("Efectivo");

   	}else{
   		
   		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());		
   	}
   	//console.log("metodoPago", listaMetodoPago);
   }

    /*=====================================
          Listado Metodo de Pago
   ======================================*/
   $(".btnEditarCompra").click(function(){

   	var idCompra= $(this).attr("idCompra");
	//console.log("respuesta",idVenta);
   	window.location = "index.php?ruta=editar-compras&idCompra="+ idCompra;
   })

   /*=============================================
				BORRAR VENTA
	=============================================*/
$(".tablas").on("click", ".btnEliminarCompra", function(){

  var idCompra = $(this).attr("idCompra");

  swal({
        title: '¿Está seguro de borrar la Compra?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar compra!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=compras&idCompra="+idCompra;
        }

  })

})

/*=============================================
				Imprimir Factura
=============================================*/

   
$(".tablas").on("click", ".btnImprimirFacturaCompra", function(){

	var codigoCompra = $(this).attr("codigoCompra");
	//console.log("respuesta",codigoVenta);
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoCompra,"_blanck");

})

$(".tablas").on("click", ".btnImprimirCodigo", function(){

	//var codigoCompra = $(this).attr("codigoCompra");
	console.log("respuesta",'hola');
	window.open("extensiones/tcpdf/pdf/testPDF.php","_blanck");

})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  })

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
Capturar Hoy
=============================================*/
$(".daterangepicker .ranges li").on("click", function(){

	var texto = $(this).attr("data-range-key");

	if(texto == "Hoy"){

		var d = new Date();

		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var ano = d.getFullYear();

		if(dia < 10 && mes < 10){

			var fechaInicial = ano+"-0"+"-0"+dia;
			var fechaFinal = ano+"-0"+"-0"+dia;

		}else if(mes < 10){

			var fechaInicial = ano+"-0"+"-"+dia;
			var fechaFinal = ano+"-0"+"-+"+dia;

		}else if(dia < 10){

			var fechaInicial = ano+"-"+"-0"+dia;
			var fechaFinal = ano+"-"+"-0"+dia;

		}else{

			var fechaInicial = ano+"-"+mes+"-"+dia;
			var fechaFinal = ano+"-"+mes+"-"+dia;

		}		

		localStorage.setItem("capturarRango", "Hoy");

		window.location = "index.php?ruta=compras&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
	}
})