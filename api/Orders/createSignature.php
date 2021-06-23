<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');


$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    
    $conn=getConnection();
    
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{

    	$sql="INSERT INTO mttofirmas (idMttoMaestro, tipoUsuario, nombre, firma ) ";
        $sql .= "VALUES (".$_POST['IdMtto'].",'".$_POST['TypeUser']."', '".$_POST['Name']."' , '".$_POST['SignUser']."');";

        $result = mysqli_query($conn,$sql);

         if ($result) {
            sendResponse(200, $result , 'Successful.');
            //mysqli_commit($conn);
         } else {
            sendResponse(404, [] ,'Not Registered.');
            //mysqli_rollback($conn);
        }
        $conn->close();
    }
    