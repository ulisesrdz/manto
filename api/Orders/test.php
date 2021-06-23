<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');


$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    
    $conn=getConnection();
    
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
     	$path = "PDF/Image";
     	$blob = $_POST["sign"];
     	$name = 'Ulises';
     	$directorio = $path."/".$name;
		
		

		
        $file = fopen($path."/".$name .".png","w+");
	   	// echo "File name: ".$path."$name\n";
	   	fwrite($file, base64_decode($image));
	   	fclose($file);
    }



     $conn->close();