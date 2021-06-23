/*=============================================
=            Subiendo Imagen           =
=============================================*/

$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	
	/*=============================================
	=            Validar imagen           =
	=============================================*/

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir imagen",
			text: "¡La imagen debe de estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});


	
	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load",function(event){
  			var rutaImagen= event.target.result;

  			$(".previsualizar").attr("src",rutaImagen);
  		})
  	}


})
/*=============================================
=            Editar Usuario           =
=============================================*/
/*$(".btnEditarUsuario").click(function(){*/
$(document).on("click", ".btnEditarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");


	// console.log("respuesta",idEmpresa);
	var datos= new FormData();
	datos.append("idEmpresa",idEmpresa);

	$.ajax({
		url:"ajax/informacion.ajax.php",
		method: "POST", 
		data: 	datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$("#Nombre").val(respuesta["nombre"]);
			$("#editarRfc").val(respuesta["rfc"]);
			$("#editarFecha").val(respuesta["diaCreacion"]);
			
			$("#fotoActual").val(respuesta["imagenWeb"]);

			if(respuesta["imagenWeb"] != ""){

				$(".previsualizar").attr("src", respuesta["imagenWeb"]);
			}

		//console.log("respuesta",respuesta);
		} 
	});


})

/*=============================================
				Imprimir Documento
=============================================*/

   
$(".tablas").on("click", ".btnImpimirDocto", function(){

	var nomenclatura = $(this).attr("nomenclatura");
	var id = $(this).attr("id");
	var tipoDocto = $(this).attr("tipoDocto");
	//console.log("respuesta","extensiones/tcpdf/pdf/factura.php?codiggo="+nomenclatura,"_blanck");
	
	if (tipoDocto == "P") {
		//window.open("../../maintenanceAPP/api/PDF/pdfFile.php?Id="+id+"&Nomenclature="+nomenclatura,"_blanck");
		//window.open("vistas/modulos/pdfFile.php?Id="+id+"&Nomenclature='"+nomenclatura,"'_blanck");
		var path = "vistas/modulos/pdfFile.php?Id="+id+"&Nomenclature='"+nomenclatura+"'";
		var name = "Mantenimiento Preventivo";	
		 var prntWin = window.open();
            prntWin.document.write("<html><head><title>"+name+"</title><link rel='icon'  href='vistas/img/plantilla/icono-negro.png'></head><body>"
                + '<embed width="100%" height="100%" name="plugin" src="'+ path+ '" '
                + 'type="application/pdf" internalinstanceid="21"></body></html>');
            prntWin.document.close();
	}
	if (tipoDocto == "C") {
		//window.open("vistas/PDF/pdfFileCorrec.php?Id="+id+"&Nomenclature='"+nomenclatura,"'_blank");
		var path = "vistas/modulos/pdfFileCorrec.php?Id="+id+"&Nomenclature='"+nomenclatura+"'";
		var name = "Mantenimiento Correctivo";	
		 var prntWin = window.open();
            prntWin.document.write("<html><head><title>"+name+"</title><link rel='icon' href='vistas/img/plantilla/icono-negro.png'></head><body>"
                + '<embed width="100%" height="100%" name="plugin" src="'+ path+ '" '
                + 'type="application/pdf" internalinstanceid="21"></body></html>');
            prntWin.document.close();	
	}
	if (tipoDocto == "T") {
		//window.open("vistas/PDF/pdfFileTrouble.php?Id="+id,"_blank");
		var path = "vistas/modulos/pdfFileTrouble.php?Id="+id;
		var name = "Troubleshooting";	
		 var prntWin = window.open();
            prntWin.document.write("<html><head><title>"+name+"</title><link rel='icon' href='vistas/img/plantilla/icono-negro.png'></head><body>"
                + '<embed width="100%" height="100%" name="plugin" src="'+ path+ '" '
                + 'type="application/pdf" internalinstanceid="21"></body></html>');
            prntWin.document.close();	
	}

})