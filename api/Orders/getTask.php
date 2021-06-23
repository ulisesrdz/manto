<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        $sql = "SELECT md.id, md.tarea ";
        $sql.= "FROM mantenimiento m ";
        $sql.= "JOIN maquinas maq ON maq.idGrupo = m.idGrupo ";
        $sql.= "JOIN tareas md ON md.idMtto = m.id ";
        $sql.= "WHERE maq.numMaquina='".$_POST["MachineNo"]."' AND m.idPeriodo=".$_POST["IdFrecuency"];
        
        
        
        //sendResponse($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $orders = array();
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
               $task= iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($row["tarea"]));
                $order = array(
                    "Id" =>  $row["id"],
                    "Task" =>  $task
                    
                );
                //echo "\n ".$row["tarea"];
                array_push($orders , $order);
                
            }
            //echo json_encode( $orders);
            //$data = json_encode(array('data' =>  $orders));
            //var_dump(json_encode(array('data' =>  $orders)));
            sendResponse(200,$orders , 'Task Details');
        } else {
            sendResponse(404,[],"Unregistered Task");
        }
        $conn->close();
    }