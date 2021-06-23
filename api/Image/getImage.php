<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        
            
        $sql = "SELECT imagenAPK FROM configuracion";
        
        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            //$photo = mysql_fetch_array($result); 
            header('Content-Type:image/png');
            $logo=  $row["imagenAPK"];

                
            echo $logo;
            //sendResponse(200,$logo , 'Document Details');
            }
            //sendResponse(200,$logo , 'Document Details');
        } else {
            sendResponse(404,[],"Unregistered document");
        }
        $conn->close();
    }