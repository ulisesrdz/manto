<?php
// function for creating 
function doEncrypt($plain_text){
	//return hash('sha256' , $plain_text);
	return crypt($plain_text,'$2a$07$usesomesillystringforsalt$');
}