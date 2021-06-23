<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');




    
    $conn=getConnection();
    
    if($conn==null){
        sendResponse(400, $conn, 'Server Connection Error !');
    }else{
       
        $sql = "SELECT Count(id) id FROM usuarios ";
       
        
        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $users=array();
            if($row = $result->fetch_assoc()) {
                 $count = $row["id"];

               
            }
            sendResponse(200,$count,'Success');
        } else {
            sendResponse(404,[],$password);
        }
        $conn->close();
    }

