<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');
$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        
        $sql = "SELECT p.descripcion,mm.fecha ,mm.horaInicio ,mm.horaTermino ,mm.tiempoMuerto ,mm.comentarios ,mm.nomenclatura ,mm.folio, ";
        $sql .= "md.tarea,md.action,md.comentario,md.problema,md.causa,md.solucion,mf.tipoUsuario,mf.nombre, mf.firma ";
        $sql .= "FROM mttomaestro mm ";
        $sql .= "JOIN mttoDetalle md ON mm.id=md.idMttoMaestro ";
        $sql .= "JOIN mttoFirmas mf ON mm.id=mf.idMttoMaestro ";
        $sql .= "JOIN periodo p ON mm.idFrecuencia=p.id ";
        $sql .= "where nomenclatura = '".$_POST['nomenclature']."'";
        
        
        
        //var_dump($sql);

        $result = mysqli_query($conn,$sql);
        
        if ($result->num_rows > 0) {
            $orders = array();
            while($row = $result->fetch_assoc()) {
                $order = array(
                    "description" =>  $row["descripcion"],
                    "date" =>  $row["fecha"],                    
                    "startTime" =>  $row["horaInicio"],
                    "endTime" =>  $row["horaTermino"],
                    "timeOut" =>  $row["tiempoMuerto"],
                    "comments" =>  $row["comentarios"],                   
                    "nomenclature" =>  $row["nomenclatura"],
                    "folio" =>  $row["folio"],
                    "task" =>  $row["tarea"],
                    "comment" =>  $row["comentario"],
                    "issue" =>  $row["problema"],
                    "cause" =>  $row["causa"],
                    "solution" =>  $row["solucion"],
                    "typeUser" =>  $row["tipoUsuario"],
                    "name" =>  $row["nombre"],
                    "sign" =>  $row["firma"]
                );
                array_push($orders , $order);
            }
            sendResponse(200,$orders , 'Document Details');
        } else {
            sendResponse(404,[],"Unregistered document");
        }
        $conn->close();
    }