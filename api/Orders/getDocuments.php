<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        if($_POST["IdMachine"] == 0){
            
            $sql = "SELECT id, idMaquina, idFrecuencia, fecha, horaInicio, horaTermino, tiempoMuerto, comentarios, nomenclatura, folio ";
            $sql.= "FROM mttomaestro ";
            $sql.= "WHERE tipoDocumento='".$_POST["TypeDocument"]."' ";

        }else{
            
            $sql = "SELECT id, idMaquina, idFrecuencia, fecha, horaInicio, horaTermino, tiempoMuerto, comentarios, nomenclatura, folio ";
            $sql.= "FROM mttomaestro ";
            $sql.= "WHERE idMaquina=".$_POST["IdMachine"]." and tipoDocumento='".$_POST["TypeDocument"]."' ";

        }

        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $orders = array();
            while($row = $result->fetch_assoc()) {
                $order = array(
                    "id" =>  $row["id"],
                    "idMachine" =>  $row["idMaquina"],                    
                    "idFrecuency" =>  $row["idFrecuencia"],
                    "date" =>  $row["fecha"],
                    "startTime" =>  $row["horaInicio"],
                    "endTime" =>  $row["horaTermino"],                   
                    "timeOut" =>  $row["tiempoMuerto"],
                    "comment" =>  $row["comentarios"],
                    "nomenclature" =>  $row["nomenclatura"],
                    "folio" =>  $row["folio"]
                );
                array_push($orders , $order);
            }
            sendResponse(200,$orders , 'Document Details');
        } else {
            sendResponse(404,[],"Unregistered document");
        }
        $conn->close();
    }