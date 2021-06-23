/*=============================================
EDITAR PRODUCTO
=============================================*/

//$(".tablas").on("click", ".btnEditarCliente", function(){
//$(".tablas tbody").on("click", "button.btnEditarCliente", function(){
 $(".btnEditarCliente").click(function(){
	
  var idCliente = $(this).attr("idCliente");
	//console.log("idCliente",idCliente);

	var datos = new FormData();
    datos.append("idCliente", idCliente);

     $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        //console.log("respuesta",respuesta);
         $("#idCliente").val(respuesta["id"]);
         $("#editarCliente").val(respuesta["nombre"]);
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

 $(".btnEliminarCliente").click(function(){

  var idCliente = $(this).attr("idCliente");

  swal({
    title: '¿Esta seguro de eliminar el cliente?',
    text:  "¡Si no lo está, puede cancelar la accion", 
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cliente!'
  }).then((result)=>{

    if(result.value){
      window.location = "index.php?ruta=clientes&idCliente="+idCliente;
    }
  })
 })