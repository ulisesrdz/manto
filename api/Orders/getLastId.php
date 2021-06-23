<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{

    	$sql = "SELECT MAX(folio)+1 folio FROM mttomaestro WHERE tipoDocumento='C'; ";

    	$result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            //$photo = mysql_fetch_array($result); 
            
            $folio=  $row["folio"];

            sendResponse(200,$folio , 'Document Details');
            }
            //sendResponse(200,$logo , 'Document Details');
        } else {
            sendResponse(404,[],"Unregistered document");
        }

    	$conn->close();

    }