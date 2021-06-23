/*=============================================
EDITAR PRODUCTO
=============================================*/

//$(".tablas").on("click", ".btnEditarCliente", function(){
//$(".tablas tbody").on("click", "button.btnEditarCliente", function(){
 $(".btnEditarProveedor").click(function(){
	
  var idProveedor = $(this).attr("idProveedor");
	//console.log("idCliente",idCliente);

	var datos = new FormData();
    datos.append("idProveedor", idProveedor);

     $.ajax({

      url:"ajax/proveedores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        //console.log("respuesta",respuesta);
         $("#idProveedor").val(respuesta["id"]);
         $("#editarProveedor").val(respuesta["nombre"]);
         $("#editarRFC").val(respuesta["RFC"]);
         $("#editarDocumentoId").val(respuesta["documento"]);
         $("#editarEmail").val(respuesta["email"]);
         $("#editarTelefono").val(respuesta["telefono"]);
         $("#editarDireccion").val(respuesta["direccion"]);
         $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);

      }
   })
})

  /* =============================
         Eliminar Cliente
  ============================== */

 $(".btnEliminarProveedor").click(function(){

  var idProveedor = $(this).attr("idProveedor");

  swal({
    title: '¿Esta seguro de eliminar al Proveedor?',
    text:  "¡Si no lo está, puede cancelar la accion", 
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar proveedor!'
  }).then((result)=>{

    if(result.value){
      window.location = "index.php?ruta=proveedor&idProveedor="+idProveedor;
    }
  })
 })