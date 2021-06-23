 /* =============================
         Editar Categoria
  ============================== */

  //$(".btnEditargrupo").click(function(){
$(document).on("click", ".btnEditargrupo", function(){
  	var idGrupo= $(this).attr("idGrupo");
	
	console.log("respuesta",idGrupo);
  	
  	var datos = new FormData();
  	datos.append("idGrupo",idGrupo);

  	$.ajax({
  		url:"ajax/grupos.ajax.php",
		method: "POST", 
		data: 	datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			console.log("respuesta",respuesta);

			$("#editarGrupo").val(respuesta["descripcion"]);
			$("#idGrupo").val(respuesta["idGrupo"]);
		}
  	});

  })

   /* =============================
         Eliminar Categoria
  ============================== */

 //$(".btnEliminarGrupo").click(function(){
$(document).on("click", ".btnEliminarGrupo", function(){
 	var idGrupo = $(this).attr("idGrupo");

 	swal({
 		title: '¿Esta seguro de eliminar el grupo?',
 		text:  "¡Si no lo está, puede cancelar la accion", 
 		type: 'warning',
 		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar categoria!'
 	}).then((result)=>{

 		if(result.value){
 			window.location = "index.php?ruta=grupos&idGrupo="+idGrupo;
 		}
 	})
 })

 /*=============================================
	=            Categoria Repetida            =
	=============================================*/
$("#nuevoGrupo").change(function(){ 

	$(".alert").remove();
	var descripcion = $(this).val();

	var datos = new FormData();
	datos.append("validaGrupo", descripcion);

	$.ajax({

			url:"ajax/grupos.ajax.php",
			method: "POST", 
			data: 	datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

				/*console.log("respuesta",respuesta);*/

				if(respuesta){
					$("#nuevoGrupo").parent().after('<div class="alert alert-warning">El grupo ya Existe</div>');
					$("#nuevoGrupo").val("");
				}
				
		}

	})

})
