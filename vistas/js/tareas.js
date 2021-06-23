/* =============================
         Editar Categoria
  ============================== */

  $(".btnAgregarTareas").click(function(){

  	var idInformacion= $(this).attr("idInform");
	
	//console.log("respuesta",idInformacion);
  	
  	$("#idInformacion").val(idInformacion);

  })

  $(".btnAgregarTarea").click(function(){

  	var idInformacion= $(this).attr("idInformacion");
	
	console.log("respuesta",idInformacion);
  	
  	$("#idInformacion").val(idInformacion);

  })

// $(".btnMostrarTareas").click(function(){
// //$(document).on("click", ".btnMostrarTareas", function(){
//   	var idInformacion= $(this).attr("idInformacion");
	
// 	var datos = new FormData();
//   	datos.append("idInformacion",idInformacion);
	
// 	console.log("respuesta",idInformacion);
	
// 	$.ajax({
//   		url:"ajax/mantenimiento.ajax.php",
// 		method: "POST", 
// 		data: 	datos,
// 		cache: false,
// 		contentType: false,
// 		processData: false,
// 		dataType: "json",
// 		success: function(respuesta){

// 			console.log("respuest2",respuesta["id"]);
// 			$("#idInformacion").val(respuesta["id"]);
// 			//$("#idInformacion").html(respuesta);
// 		}

//   	});
  
		

//   })


//$(".btnEditarInforme").click(function(){
$(document).on("click", ".btnEditarInforme", function(){

  	var idInformacion= $(this).attr("idInforme");
	
	var datos = new FormData();
  	datos.append("idInformacion",idInformacion);

//console.log("respuesta",idInformacion);

		$.ajax({
  		url:"ajax/mantenimiento.ajax.php",
		method: "POST", 
		data: 	datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			console.log("respuesta",respuesta);
			$("#editarIdInformacion").val(respuesta["id"]);
			$("#editarCategoria").val(respuesta["idTipoMtto"]);
			$("#editarPeriodo").val(respuesta["idPeriodo"]);
			$("#editarNumMaq").val(respuesta["idMaquina"]);
			$("#editarSerie").val(respuesta["serie"]);
		}
  	})
		

  })



$(".btnEliminarInforme").click(function(){

 	var idInforme = $(this).attr("idInforme");
//console.log("respuesta",idInforme);
 	swal({
 		title: '¿Esta seguro de eliminar el informe?',
 		text:  "¡Si no lo está, puede cancelar la accion", 
 		type: 'warning',
 		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar informe!'
 	}).then((result)=>{

 		if(result.value){
 			window.location = "index.php?ruta=mantenimiento&idInforme="+idInforme;
 		}
 	})
 })

$(".btnMostrarTarea").click(function(){

 	var idInforme = $(this).attr("idInforme");
	console.log("respuesta",idInforme);
 	window.location = "index.php?ruta=task&idInforme="+idInforme;

 	
 })


$(".btnRegresarOrden").click(function(){

 	
 	window.location = "mantenimiento";

 	
 })


$(".btnEliminarTarea").click(function(){

 	var idTask = $(this).attr("idTask");
	//console.log("respuesta",idInforme);
 	var idInforme = $(this).attr("idInforme");
 	swal({
 		title: '¿Esta seguro de eliminar la tarea?',
 		text:  "¡Si no lo está, puede cancelar la accion", 
 		type: 'warning',
 		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar tarea!'
 	}).then((result)=>{

 		if(result.value){
 			window.location = "index.php?ruta=task&idTask="+idTask+"&idInforme="+idInforme;
 		}
 	})
 })



