<?php 
if(isset($_POST) && !empty($_POST)) {
    include('../../extensiones/phpqrcode/qrlib.php'); 
    $codesDir = "imagen/"; 
    
    if( !file_exists($codesDir)){						
		mkdir($codesDir);
	}  
    
    $codeFile = date('d-m-Y-h-i-s').'.png';
    $filename = 'vistas/modulos/'.$codesDir.$codeFile;
    
    QRcode::png($_POST['formData'], $codesDir.$codeFile, $_POST['ecc'], $_POST['size']); 
    echo '<img class="img-thumbnail" src="vistas/modulos/'.$codesDir.$codeFile.'" />';
    		echo"
				  <ul>
				  <li><a href='javascript:void(0);' onclick=\"VoucherPrint('".$filename."','#".$_POST['formData']."');\" >".$_POST['formData']."</a></li>
				</ul>
  				";
} else {
    header('location:./');
}
?>