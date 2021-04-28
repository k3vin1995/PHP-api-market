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
			
			$response = new GetController();
			$response -> getData($routesArray[1]);
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