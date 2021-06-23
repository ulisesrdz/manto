$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php",
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
         Editar Categoria
  ============================== */
  
$(document).on("click", ".btnEditarMaquina", function(){
  	var idMaquina= $(this).attr("idMaquina");

  	var datos = new FormData();
  	datos.append("idMaquina",idMaquina);
  	console.log("respuesta",idMaquina);
  	$.ajax({
  		url:"ajax/maquinas.ajax.php",
		method: "POST", 
		data: 	datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			console.log("respuesta",respuesta);

			$("#editarIdGrupo").val(respuesta["idGrupo"]);
			$("#editarNumMaquina").val(respuesta["numMaquina"]);
			$("#editarModelo").val(respuesta["modelo"]);
			$("#editarMarca").val(respuesta["marca"]);
			$("#editarArea").val(respuesta["area"]);
			$("#editarVS").val(respuesta["vs"]);
			$("#editarSerie").val(respuesta["serie"]);			
			$("#editarWB").val(respuesta["wb"]);		
			$("#editarVoltaje").val(respuesta["voltaje"]);			
			$("#editarFase").val(respuesta["fase"]);			
			$("#editarDF").val(respuesta["df"]);				
			$("#idMaquina").val(respuesta["idMaquina"]);
		}
  	});

  })


  /* =============================
         Eliminar Maquina
  ============================== */

 //$(".btnEliminarMaquina").click(function(){
$(document).on("click", ".btnEliminarMaquina", function(){
 	var idMaquina = $(this).attr("idMaquina");
//console.log("respuesta",idMaquina);
 	swal({
 		title: '¿Esta seguro de eliminar la maquina?',
 		text:  "¡Si no lo está, puede cancelar la accion", 
 		type: 'warning',
 		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar maquina!'
 	}).then((result)=>{

 		if(result.value){
 			window.location = "index.php?ruta=maquinas&idMaquina="+idMaquina;
 		}
 	})
 })

 /*=============================================
	=            Maquina Repetida            =
	=============================================*/
$("#nuevoNumMaquina").change(function(){ 

	$(".alert").remove();
	var maquina = $(this).val();
console.log("respuesta",datos);
	var datos = new FormData();
	datos.append("validaMaquina", maquina);

	$.ajax({

			url:"ajax/maquinas.ajax.php",
			method: "POST", 
			data: 	datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

				/*console.log("respuesta",respuesta);*/

				if(respuesta){
					$("#nuevoNumMaquina").parent().after('<div class="alert alert-warning">La maquina ya Existe</div>');
					$("#nuevoNumMaquina").val("");
				}
				
		}

	})

})
