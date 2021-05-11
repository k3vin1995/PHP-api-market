<?php 

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/*===================================================================
=            Cuando no se hace ninguna peticion a la API            =
===================================================================*/

if (count($routesArray) == 0) {
	$json = array(
		'status' => 404,
		"results" => "Not Found"
	);
	echo json_encode($json, http_response_code($json["status"]));
	return;

} else {
		/*=============================================
		Peticiones GET
		=============================================*/
		if (count($routesArray) == 1 && 
			isset($_SERVER["REQUEST_METHOD"]) &&
			 $_SERVER["REQUEST_METHOD"] == "GET") {

		/*=============================================
		Peticiones GET Con Filtro
		=============================================*/

		if (isset($_GET["linkTo"]) && isset($_GET["equalTo"]) && 
			!isset($_GET["rel"]) && !isset($_GET["type"])) {

		/*=============================================
		Preguntamos di viene variable de orden
		=============================================*/
			if (isset($_GET["orderBy"]) && isset($_GET["orderMode"])) {
			
			$orderBy = $_GET["orderBy"];
			$orderMode = $_GET["orderMode"];
		}else{
			$orderBy = null;
			$orderMode = null;
		}
			$response = new GetController();
			$response -> getFilterData(explode("?", $routesArray[1])[0], $_GET["linkTo"],$_GET["equalTo"], $orderBy, $orderMode);

		

		/*=============================================
		Peticiones GET entre tablas relacionadas sin Filtro
		=============================================*/

		} else if (isset($_GET["rel"]) && isset($_GET["type"]) && explode("?", $routesArray[1])[0] == "relations" &&
					!isset($_GET["linkTo"]) && !isset($_GET["equalTo"])) {
		/*=============================================
		Preguntamos di viene variable de orden
		=============================================*/
			if (isset($_GET["orderBy"]) && isset($_GET["orderMode"])) {
			
			$orderBy = $_GET["orderBy"];
			$orderMode = $_GET["orderMode"];
		}else{
			$orderBy = null;
			$orderMode = null;
		}

			# code...
			$response = new GetController();
			$response -> getRelData($_GET["rel"],$_GET["type"], $orderBy, $orderMode);
		

		


		/*=============================================
		Peticiones GET entre tablas relacionadas CON Filtro
		=============================================*/
		} else if (isset($_GET["rel"]) && isset($_GET["type"]) && explode("?", $routesArray[1])[0] == "relations" && 
					isset($_GET["linkTo"]) && isset($_GET["equalTo"])) {

		/*=============================================
		Preguntamos di viene variable de orden
		=============================================*/
		if (isset($_GET["orderBy"]) && isset($_GET["orderMode"])) {
			
			$orderBy = $_GET["orderBy"];
			$orderMode = $_GET["orderMode"];
		}else{
			$orderBy = null;
			$orderMode = null;
		}
			# code...
			$response = new GetController();
			$response -> getRelFilterData($_GET["rel"],$_GET["type"], $_GET["linkTo"],$_GET["equalTo"], $orderBy, $orderMode);

		




		/*=============================================
		Peticiones GET para el Buscador
		=============================================*/

		}else if(isset($_GET["linkTo"]) && isset($_GET["search"])) {

		/*=============================================
		Preguntamos di viene variable de orden
		=============================================*/
		if (isset($_GET["orderBy"]) && isset($_GET["orderMode"])) {
			
			$orderBy = $_GET["orderBy"];
			$orderMode = $_GET["orderMode"];
		}else{
			$orderBy = null;
			$orderMode = null;
		}


			$response = new GetController();
			$response -> getSearchData(explode("?", $routesArray[1])[0], $_GET["linkTo"],$_GET["search"], $orderBy, $orderMode);
		



		/*=============================================
		Peticiones GET sin Filtro
		=============================================*/
		} else{

		/*=============================================
		Preguntamos di viene variable de orden
		=============================================*/
		if (isset($_GET["orderBy"]) && isset($_GET["orderMode"])) {
			
			$orderBy = $_GET["orderBy"];
			$orderMode = $_GET["orderMode"];
		}else{
			$orderBy = null;
			$orderMode = null;
		}

			$response = new GetController();
			$response -> getData(explode("?", $routesArray[1])[0], $orderBy, $orderMode);
		}			
		

	}
	
		/*=============================================
		Peticiones POST
		=============================================*/
		if(count($routesArray) == 1 &&
	   isset($_SERVER["REQUEST_METHOD"]) &&
	   $_SERVER["REQUEST_METHOD"] == "POST"){
				$json = array(
					'status' => 200,
					'results'=> "POST"
				);
	echo json_encode($json, http_response_code($json["status"]));
	return;
		}

		/*=============================================
		Peticiones PUT
		=============================================*/
		if(count($routesArray) == 1 &&
	   isset($_SERVER["REQUEST_METHOD"]) &&
	   $_SERVER["REQUEST_METHOD"] == "PUT"){
				$json = array(
					'status' => 200,
					'results'=> "PUT"
				);
	echo json_encode($json, http_response_code($json["status"]));
	return;
		}

		/*=============================================
		Peticiones Delete
		=============================================*/
		if(count($routesArray) == 1 &&
	   isset($_SERVER["REQUEST_METHOD"]) &&
	   $_SERVER["REQUEST_METHOD"] == "DELETE"){
				$json = array(
					'status' => 200,
					'results'=> "DELETE"
				);
	echo json_encode($json, http_response_code($json["status"]));
	return;
		}
	
}



 ?>