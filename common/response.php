<?php
/**
 * function for sendning response to uesr
 */
function sendResponse($resp_code,$data,$message){
    $codificado = json_encode(array('code'=>$resp_code,'message'=>$message,'data'=>$data));

    if ($codificado === false) {
    	echo "Ocurrió un error al codificar: " . obtenerErrorDeJSON();
	} else {
	    echo $codificado;
	}
}

function obtenerErrorDeJSON()
{
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return "No ha ocurrido ningún error";
        case JSON_ERROR_DEPTH:
            return "Se ha excedido la profundidad máxima de la pila.";
        case JSON_ERROR_STATE_MISMATCH:
            return "Error por desbordamiento de buffer o los modos no coinciden";
        case JSON_ERROR_CTRL_CHAR:
            return "Error del carácter de control, posiblemente se ha codificado de forma incorrecta.";
        case JSON_ERROR_SYNTAX:
            return "Error de sintaxis.";
        case JSON_ERROR_UTF8:
            return "Caracteres UTF-8 mal formados, posiblemente codificados incorrectamente.";
        case JSON_ERROR_RECURSION:
            return "El objeto o array pasado a json_encode() incluye referencias recursivas y no se puede codificar.";
        case JSON_ERROR_INF_OR_NAN:
            return "El valor pasado a json_encode() incluye NAN (Not A Number) o INF (infinito)";
        case JSON_ERROR_UNSUPPORTED_TYPE:
            return "Se proporcionó un valor de un tipo no admitido para json_encode(), tal como un resource.";
        default:
            return "Error desconocido";
    }
}