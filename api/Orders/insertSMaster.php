<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');


$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    
    $conn=getConnection();
    
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        
   
        $sql="INSERT INTO smaster (idStore, idUser, saleNumber, total, type)";
        $sql .= "VALUES ('".$_POST["idStore"]."','".$_POST["idUser"]."',".$_POST["saleNumber"].",".$_POST["total"]." ,".$_POST["type"].")";

        $result = mysqli_query($conn,$sql);
        //var_dump($sql);
        //var_dump($result);
        if ($result) {
            sendResponse(200, $result , 'Successful.');
        } else {
            sendResponse(404, [] ,'Not Registered.');
        }



        
        
        
        $conn->close();
    }