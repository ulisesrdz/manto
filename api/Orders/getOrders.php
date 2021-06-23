<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        $sql = "SELECT idMaquina,numMaquina, descripcion, modelo, marca, area, vs, serie, dia_fabricacion ";
        $sql.= "FROM maquinas  WHERE numMaquina='".$_POST["MachineNo"]."'";
        
        
        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $orders = array();
            while($row = $result->fetch_assoc()) {
                $order = array(
                    "idMachine" =>  $row["id"],
                    "machineNo" =>  $row["numMaquina"],                    
                    "description" =>  $row["descripcion"],
                    "model" =>  $row["modelo"],
                    "brand" =>  $row["marca"],
                    "area" =>  $row["area"],                   
                    "vs" =>  $row["vs"],
                    "serie" =>  $row["serie"],
                    "fabrication_date" =>  $row["dia_fabricacion"]
                );
                array_push($orders , $order);
            }
            sendResponse(200,$orders , 'Order Details');
        } else {
            sendResponse(404,[],"Unregistered Order");
        }
        $conn->close();
    }