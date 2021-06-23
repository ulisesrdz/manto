<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        $sql = "SELECT idMaquina,numMaquina, gr.descripcion, modelo, marca, area, vs, serie, df FROM maquinas LEFT JOIN grupos gr ON gr.idGrupo= maquinas.idGrupo WHERE numMaquina='".$_POST["Code"]."'";
        //$sql.= "FROM maquinas LEFT JOIN grupos gr ON gr.idGrupo= maquinas.idgrupo WHERE numMaquina='".$_POST["Code"]."'";
        
        
        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $orders = array();
            while($row = $result->fetch_assoc()) {
                $order = array(
                    "IdMachine" =>  $row["idMaquina"],
                    "MachineNo" =>  $row["numMaquina"],                    
                    "Description" =>  $row["descripcion"],
                    "Model" =>  $row["modelo"],
                    "Brand" =>  $row["marca"],
                    "Area" =>  $row["area"],                   
                    "VS" =>  $row["vs"],
                    "Serie" =>  $row["serie"],
                    "Fabrication_Date" =>  $row["df"]
                );
                array_push($orders , $order);
            }
            sendResponse(200,$orders , 'Machine Details');
        } else {
            sendResponse(404,[],"Unregistered Machine");
        }
        $conn->close();
    }