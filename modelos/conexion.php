<?php


class Conexion{

	public function conectar(){
		//$link = new PDO("mysql:host=localhost;dbname=mantdbTest",
		//				"Ulises","Ulises@870911");
		$link = new PDO("mysql:host=localhost;dbname=manttest",
						"root","");
		$link -> exec("set names utf8");
		return $link;

	}
}