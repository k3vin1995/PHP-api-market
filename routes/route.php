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

		/*=============================================
		Preguntamos di viene variable de LIMITE
		=============================================*/

		if (isset($_GET["startAt"]) && isset($_GET["endAt"])) {
			
			$startAt = $_GET["startAt"];
			$endAt = $_GET["endAt"];
		}else{
			$startAt = null;
			$endAt = null;
		}
		
		$response = new GetController();
		$response -> getFilterData(explode("?", $routesArray[1])[0], $_GET["linkTo"],$_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);

		

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

		/*=============================================
		Preguntamos di viene variable de LIMITE
		=============================================*/

		if (isset($_GET["startAt"]) && isset($_GET["endAt"])) {
			
			$startAt = $_GET["startAt"];
			$endAt = $_GET["endAt"];
		}else{
			$startAt = null;
			$endAt = null;
		}


		$response = new GetController();
		$response -> getRelData($_GET["rel"],$_GET["type"], $orderBy, $orderMode, $startAt, $endAt);
		

		


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

		/*=============================================
		Preguntamos di viene variable de LIMITE
		=============================================*/

		if (isset($_GET["startAt"]) && isset($_GET["endAt"])) {
			
			$startAt = $_GET["startAt"];
			$endAt = $_GET["endAt"];
		}else{
			$startAt = null;
			$endAt = null;
		}


		$response = new GetController();
		$response -> getRelFilterData($_GET["rel"],$_GET["type"], $_GET["linkTo"],$_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);

		




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

		/*=============================================
		Preguntamos di viene variable de LIMITE
		=============================================*/

		if (isset($_GET["startAt"]) && isset($_GET["endAt"])) {
			
			$startAt = $_GET["startAt"];
			$endAt = $_GET["endAt"];
		}else{
			$startAt = null;
			$endAt = null;
		}


		$response = new GetController();
		$response -> getSearchData(explode("?", $routesArray[1])[0], $_GET["linkTo"],$_GET["search"], $orderBy, $orderMode, $startAt, $endAt);
		



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


		/*=============================================
		Preguntamos di viene variable de LIMITE
		=============================================*/

		if (isset($_GET["startAt"]) && isset($_GET["endAt"])) {
			
			$startAt = $_GET["startAt"];
			$endAt = $_GET["endAt"];
		}else{
			$startAt = null;
			$endAt = null;
		}

		$response = new GetController();
		$response -> getData(explode("?", $routesArray[1])[0], $orderBy, $orderMode, $startAt, $endAt);
	}			


}

		/*=============================================
		Peticiones POST
		=============================================*/
		if(count($routesArray) == 1 &&
			isset($_SERVER["REQUEST_METHOD"]) &&
			$_SERVER["REQUEST_METHOD"] == "POST"){


		/*=============================================
		traemos el listado de columnas de la tabla a cambiar
		=============================================*/

		$columns = array();
		

		$database = RoutesController::database();

		$response = PostController::getColumnsData(explode("?", $routesArray[1])[0], $database);

		foreach ($response as $key => $value) {
			array_push($columns, $value->item);
		}

		/*=============================================
		Quitamos el primer y ultimo indice
		=============================================*/
		array_shift($columns);
		array_pop($columns);
		/*=============================================
		REcibimos los valores POST
		=============================================*/
		if (isset($_POST)) {
		/*=============================================
		validamos que las variabkes post coinsidan con los nombres de las comulnas
		=============================================*/
		$count = 0;
		

		foreach ($columns as $key => $value) {
			
			if (array_keys($_POST)[$key] == $value) {

				$count++;
				

			}else{

				$json = array(
				 	'status' => 400,
				 	'results' => "Error: Fields in the form do not match the database"
				);

				echo json_encode($json, http_response_code($json["status"]));

				return;

			}
		} 

		/*=============================================
		validamos que las variables POST coinsidan con la cantidad de columnas de la BD
		=============================================*/

		if ($count == count($columns)) {

		/*=============================================
		Solicitamos respouesta del controlador para crear datos de cualquier tabla
		=============================================*/
			$response = new PostController();
			$response -> postData(explode("?", $routesArray[1])[0], $_POST);
			# code...
		}


	}

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