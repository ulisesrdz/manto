<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');


$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    
    $conn=getConnection();
    
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        
        $sql = @"SELECT 1 FROM smaster WHERE id=".$_POST["idSale"];       

        $result = mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            
            $sql="INSERT INTO sdetail (idSale, idPart, total, qty)";
            $sql .= "VALUES ('".$_POST["idSale"]."','".$_POST["idPart"]."',".$_POST["total"].",".$_POST["qty"]." )";

            $result = mysqli_query($conn,$sql);
            //var_dump($sql);
            //var_dump($result);
            if ($result) {
                sendResponse(200, $result , 'Successful.');
            } else {
                sendResponse(404, [] ,'Not Registered.');
            }



        } else {

            sendResponse(300, $result , 'NotHasRows.');           
           
        }
        
        
        $conn->close();
    }