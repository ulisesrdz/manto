<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        $sql = "SELECT id, categoria FROM categorias";
        
        
        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $ordersType = array();
            while($row = $result->fetch_assoc()) {
                $orderType = array(
                    "Id" =>  $row["id"],
                    "Name" =>  $row["categoria"]
                );
                array_push($ordersType , $orderType);
            }
            sendResponse(200,$ordersType , 'Order Type Details');
        } else {
            sendResponse(404,[],"Unregistered Order type");
        }
        $conn->close();
    }