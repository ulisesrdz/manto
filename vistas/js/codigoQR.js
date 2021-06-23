




$(".btnImprimirCodigo").click(function(){

	window.open("extensiones/tcpdf/pdf/testPDF.php","_blanck");
   	
 })


function imprim1(imp1){
var printContents = document.getElementById('imp1').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
		w.print();
		w.close();
        return true;}



function printImg() {
     pwin = window.open(document.getElementById("mainImg").src,"_blank");
     pwin.onload = function () {window.print();}
}

function VoucherSourcetoPrint(source, fileName) {
		return "<html><head><script>function step1(){\n" +
				"setTimeout('step2()', 10);}\n" +
				"function step2(){window.print();window.close()}\n" +
				"</scri" + "pt></head><body onload='step1()'>\n" +
				"<center><img src='" + source + "' /></body></html></center>"+
				"<center><h1>'"+fileName+"'</h1></center>";
	}
	function VoucherPrint(source,fileName) {
		
		Pagelink = "about:blank";
		var pwa = window.open(Pagelink, "_new");
		pwa.document.open();		
		pwa.document.write(VoucherSourcetoPrint(source,fileName));		
		pwa.document.close();
	}


	$(document).ready(function() {
    $("#codeForm").submit(function(){
        $.ajax({
            url:'vistas/modulos/generate_code.php',
            type:'POST',
            data: {formData:$("#content").val(), ecc:$("#ecc").val(), size:$("#size").val()},
            success: function(response) {
                $(".showQRCode").html(response);  
            },
         });
    });
});


