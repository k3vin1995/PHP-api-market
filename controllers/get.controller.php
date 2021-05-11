<?php 

/**
 * 
 */
class GetController{
	/*=============================================
	=            Peticiones GET            =
	=============================================*/
	
	
	public function getData($table, $orderBy, $orderMode){

		$response = GetModel::getData($table, $orderBy, $orderMode);

		$return = new GetController();
		$return ->fncResponse($response, "getData");

	}


	/*=============================================
	=         Peticiones GET  Con filtro       =
	=============================================*/

	public function getFilterData($table, $linkTo, $equalTo, $orderBy, $orderMode){

		$response = GetModel::getFilterData($table, $linkTo, $equalTo, $orderBy, $orderMode);

		$return = new GetController();
		$return ->fncResponse($response, "getFilterData");
	}

	/*=============================================
	Peticiones GET  tablas relacionadas SIN filtro  
	=============================================*/

	public function getRelData($rel, $type, $orderBy, $orderMode){

		$response = GetModel::getRelData($rel, $type, $orderBy, $orderMode);


		$return = new GetController();
		$return ->fncResponse($response, "getRelData");

	}

	/*=============================================
	Peticiones GET  tablas relacionadas CON filtro  
	=============================================*/

	public function getRelFilterData($rel, $type, $linkTo, $equalTo, $orderBy, $orderMode){

		$response = GetModel::getRelFilterData($rel, $type, $linkTo, $equalTo, $orderBy, $orderMode);


		$return = new GetController();
		$return ->fncResponse($response, "getRelFilterData");

	}


	/*=============================================
	=         Peticiones GET  para el buscador       =
	=============================================*/

	public function getSearchData($table, $linkTo, $search, $orderBy, $orderMode){

		$response = GetModel::getSearchData($table, $linkTo, $search, $orderBy, $orderMode);

		$return = new GetController();
		$return ->fncResponse($response, "getSearchData");
	}
	

	/*=============================================
	=        Respuestas del controlador      =
	=============================================*/


	public function fncResponse($response, $method){

		if (!empty($response)) {
			$json = array(
				'status' => 200,
				'total' => count($response),
				'result'=> $response
			);
			}else {

				$json = array(
					'status' => 404,
					'result'=> "NOT FOUND",
					'method' => $method
				);
			}


			echo json_encode($json, http_response_code($json["status"]));
			return;
	}




	}