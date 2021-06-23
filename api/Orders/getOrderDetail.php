<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        $sql = @"SELECT id,idSale,partNumber,description,total,qty FROM sdetail sd 
                JOIN parts p on p.id=sd.idpart WHERE sd.idSale=";
        $sql.=$_POST["idSale"];
        
        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $orders = array();
            while($row = $result->fetch_assoc()) {
                $order = array(
                    "id" =>  $row["id"],
                    "idSale" =>  $row["idSale"],
                    "partNumber" =>  $row["partNumber"],
                    "description" =>  $row["description"],
                    "total" =>  $row["total"],
                    "qty" =>  $row["qty"]
                );
                array_push($orders , $order);
            }
            sendResponse(200,$orders , 'Order Details');
        } else {
            sendResponse(404,[],"Unregistered Order");
        }
        $conn->close();
    }