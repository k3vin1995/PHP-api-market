<?php 

require_once "connection.php";

class GetModel{

	/*=================================================
	=            peticiones GET sin filtro
	=================================================*/
	
	
	static public function getData($table){

		$stmt = Connection::connect()->prepare("SELECT * FROM $table");

		$stmt -> execute(); 

		return $stmt -> fetchAll(PDO::FETCH_CLASS);
	}



}