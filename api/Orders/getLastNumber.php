<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        $sql = "SELECT id,number FROM masterID WHERE identity=";
                
        $sql.="'".$_POST["identity"]."'";
        
        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $masters = array();
            while($row = $result->fetch_assoc()) {
                $master = array(
                    "id" =>  $row["id"],
                    "number" =>  $row["number"]
                );
                array_push($masters , $master);
            }
            sendResponse(200,$masters , 'Order Details');
        } else {
            sendResponse(404,[],"Unregistered Order");
        }
        $conn->close();
    }