  /*=============================
       Cargar Tabla Dinamica Ventas
  ============================== */
 /* $.ajax({

	url: "ajax/datatable-ventas.ajax.php",
	success:function(respuesta){

		console.log("respuesta",respuesta);
	}

 })*/

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

$('.tablasVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
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

  $(".tablasVentas tbody").on("click", "button.agregarProducto", function(){

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
  				============================= */

  				if(stock == 0){
  					swal({
  						title:"No hay stock suficiente",
  						type:"error",
  						confirmButtonText: "¡Cerrar!"
  					});

  					$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

  					return;
  				}

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
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProductoVenta" precioReal="'+precio+'" name="nuevoPrecioProductoVenta" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

	      
			//Sumar Total
			sumarTotalPreciosVenta()

			//Agregar Impuestos
			agregarImpuestoVenta()

			//Listar Productos
			listarProductosVenta()

			//Dar Formato a los numeros
			$(".nuevoPrecioProductoVenta").number(true,2);

			
		}

	})

  }); 

   /* ======================================================
      Cuando navege en la tabla y se elimine un producto
  ========================================================== */

  $(".tablasVentas").on("draw.dt", function(){

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

 $(".formularioVenta").on("click", "button.quitarProducto", function(){

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

			$("#nuevoImpuestoVenta").val(0);
			$("#nuevoTotalVenta").val(0);
			$("#totalVenta").val(0);
			$("#nuevoTotalVenta").attr("total",0);

		}else{

			sumarTotalPreciosVenta()

			agregarImpuestoVenta()
			
			//Listar Productos
			listarProductosVenta()

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
	                 
	              '<input type="text" class="form-control nuevoPrecioProductoVenta" precioReal="" name="nuevoPrecioProductoVenta" readonly required>'+
	 
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
  				

				sumarTotalPreciosVenta()

				agregarImpuestoVenta()
  				
				

				// PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        	$(".nuevoPrecioProductoVenta").number(true, 2);
		}
	})
		
	
})

 /* ===========================================================
      	Seleccionar Precio-Productos para Dispositivos Moviles
  	========================================================== */

  	$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

  		var nombreProductos = $(this).val();

  		var nuevoPrecioProductoVenta = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProductoVenta");
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
				$(nuevaCantidadProducto).attr("nuevoStock",Number(respuesta["stock"]) - 1);
				$(nuevoPrecioProductoVenta).val(respuesta["precio_venta"]);
				$(nuevoPrecioProductoVenta).attr("precioReal",respuesta["precio_venta"]);

				// AGRUPAR PRODUCTOS EN FORMATO JSON

	        	listarProductosVenta()
			}
		})

  	})

  	/* =================================
      	Modificar la cantidad
  	================================= */
  	  	$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){


	  			if(Number($(this).val()) > Number($(this).attr("stock"))){

	  				$(this).val(1);

	  				swal({
  						title:"La cantidad supera el stock",
  						text:"¡Solo hay "+$(this).attr("stock")+" unidades",
  						type:"error",
  						confirmButtonText: "¡Cerrar!"
  					});
	  			}

	  			var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProductoVenta");

	  			var precioFinal = $(this).val() * precio.attr("precioReal");

	  			//console.log("precioFinal",precioFinal);
	  			precio.val(precioFinal);

	  			var nuevoStock = Number($(this).attr("stock")) - $(this).val();

				$(this).attr("nuevoStock", nuevoStock);

	  			sumarTotalPreciosVenta()

	  			agregarImpuestoVenta()

	  			//Listar Productos
				listarProductosVenta()
  	  	});

  	/* =================================
      	Sumar Precios
  	================================= */
function sumarTotalPreciosVenta(){


	var precioItem = $(".nuevoPrecioProductoVenta");
	console.log('precioItem',precioItem);
	var arraySumaPrecio = [];  
console.log('2',2);
	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}

	/* =================================
      	Funcion Agregar Impuestos
  	================================= */
  	
function agregarImpuestoVenta(){

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
	$("#nuevoTotalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}


  	/* =================================
      	Cuando cambia el impuesto
  	================================= */

  	$("#nuevoImpuestoVenta").change(function(){
		
		agregarImpuestoVenta();
  	
  	});

 /* =================================
      	Formato Total Venta
  	================================= */
	$("#nuevoTotalVenta").number(true,2);



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
	CAMBIO EN EFECTIVO
   =============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

 /*=============================================
	CAMBIO Transaccion
   =============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

	listarMetodo();

})

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosVenta(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProductoVenta");

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

    /*=====================================
          Listado Metodo de Pago
   ======================================*/
   $(".btnEditarVenta").click(function(){

   	var idVenta= $(this).attr("idVenta");
	//console.log("respuesta",idVenta);
   	window.location = "index.php?ruta=editar-ventas&idVenta="+ idVenta;
   })

   /*=============================================
				BORRAR VENTA
	=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })

})

/*=============================================
				Imprimir Factura
=============================================*/

   
$(".tablas").on("click", ".btnImprimirFactura", function(){

	var codigoVenta = $(this).attr("codigoVenta");
	//console.log("respuesta","extensiones/tcpdf/pdf/factura.php?codiggo="+codigoVenta,"_blanck");
	
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta,"_blanck");

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

		window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
	}
})