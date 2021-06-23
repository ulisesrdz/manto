<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        $password=doEncrypt($_POST["Password"]);
        
        $sql = "SELECT id,nombre,estado FROM usuarios WHERE usuario='".$_POST["Username"]."' AND password = '".$password."'";
       
        
        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $users=array();
            while($row = $result->fetch_assoc()) {
                $user=array(
                    "id" =>  $row["id"],
                    "name" =>  $row["nombre"],
                    "status" =>  $row["estado"]
                );
                array_push($users,$user);
            }
            sendResponse(200,$users,'User Details');
        } else {
            sendResponse(404,[],$password);
        }
        $conn->close();
    }

