/* =============================
       Variable Local Storage
  ============================== */

  if(localStorage.getItem("capturarRango2") != null){

  	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));

  }else{

  	$("#daterange-btn2 span").html('<i class="fa fa-calendaer"></i> Rango Fecha');

  }

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn2').daterangepicker(
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
    $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn2 span").html();
   
   	localStorage.setItem("capturarRango2", capturarRango);

   	window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  })

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango2");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
Capturar Hoy
=============================================*/
$(".daterangepicker.opensright .ranges li").on("click", function(){

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

		localStorage.setItem("capturarRango2", "Hoy");

		window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
	}
})