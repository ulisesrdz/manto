<?php
include_once('../../common/include.php');
include_once('../../common/encipher.php');


$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

    
    $conn=getConnection();
    
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{

            //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_ONLY);
            
            $countTast = count($_POST['task']);
            $countSign = count($_POST['sign']);
            $task = $_POST['task'];
            $sign = $_POST['sign'];
            if($_POST["idFrecuency"]!="0"){
                
                $sql = "SELECT identificador FROM periodo WHERE id=".$_POST["idFrecuency"]; 
            
                $result = mysqli_query($conn,$sql);            
                  
                $row = $row = $result->fetch_assoc();

                $ident = $row["identificador"];      

                $nomen = $_POST["nomenclature"]."-".$ident;
                
            }
            else{
                 $nomen = $_POST["nomenclature"];
            }
            $sql="INSERT INTO mttomaestro (idMaquina, idFrecuencia, tipoDocumento,horaInicio,horaTermino,tiempoMuerto,comentarios,nomenclatura,folio) ";
            $sql .= "VALUES (".$_POST["idMachine"].",".$_POST["idFrecuency"].", '".$_POST["typeDocument"]."', '".$_POST["startTime"]."', '".$_POST["endTime"]."' , '".$_POST["timeOut"]."', '".$_POST["commentary"]."', '".$nomen."', '".$_POST["documentId"]."');";

            $result = mysqli_query($conn,$sql);

            $idInserted = mysqli_insert_id($conn);
            //var_dump($nomen);

                       
                        
            for ($j = 0; $j < $countTast; ++$j) {
                //var_dump($parts[$j]->idPart);
                $sql="INSERT INTO mttodetalle (idMttoMaestro, tarea, action, comentario, problema, causa, solucion) ";
                $sql .= "VALUES (".$idInserted.",'".$task[$j]->task."', '".$task[$j]->action."' , '".$task[$j]->comment."', '".$task[$j]->issue."', '".$task[$j]->cause."', '".$task[$j]->solution."');";

                $result = mysqli_query($conn,$sql);
            }

            

            for ($i=0; $i < $countSign; $i++) { 
               
                $sql="INSERT INTO mttofirmas (idMttoMaestro, tipoUsuario, nombre, firma ) ";
                $sql .= "VALUES (".$idInserted.",'".$sign[$i]->typeUser."', '".$sign[$i]->name."' , '".$sign[$i]->signUser."');";

                $result = mysqli_query($conn,$sql);
            }

            if ($result) {
                sendResponse(200, $result , 'Successful.');
                //mysqli_commit($conn);
            } else {
                sendResponse(404, [] ,'Not Registered.');
                //mysqli_rollback($conn);
            }
           
        }
        
        //mysqli_close($conn);
        $conn->close();
    