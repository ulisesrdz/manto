 /* =============================
         Editar Categoria
  ============================== */

  $(".btnEditarCategoria").click(function(){

  	var idCategoria= $(this).attr("idCategoria");

  	var datos = new FormData();
  	datos.append("idCategoria",idCategoria);

  	$.ajax({
  		url:"ajax/categorias.ajax.php",
		method: "POST", 
		data: 	datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			/*console.log("respuesta",respuesta);*/

			$("#editarCategoria").val(respuesta["categoria"]);
			$("#idCategoria").val(respuesta["id"]);
		}
  	})

  })

   /* =============================
         Eliminar Categoria
  ============================== */

 $(".btnEliminarCategoria").click(function(){

 	var idCategoria = $(this).attr("idCategoria");

 	swal({
 		title: '¿Esta seguro de eliminar la categoria?',
 		text:  "¡Si no lo está, puede cancelar la accion", 
 		type: 'warning',
 		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar categoria!'
 	}).then((result)=>{

 		if(result.value){
 			window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
 		}
 	})
 })

 /*=============================================
	=            Categoria Repetida            =
	=============================================*/
$("#nuevaCategoria").change(function(){ 

	$(".alert").remove();
	var categoria = $(this).val();

	var datos = new FormData();
	datos.append("validaCategoria", categoria);

	$.ajax({

			url:"ajax/categorias.ajax.php",
			method: "POST", 
			data: 	datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

				/*console.log("respuesta",respuesta);*/

				if(respuesta){
					$("#nuevaCategoria").parent().after('<div class="alert alert-warning">La categoria ya Existe</div>');
					$("#nuevaCategoria").val("");
				}
				
		}

	})

})
