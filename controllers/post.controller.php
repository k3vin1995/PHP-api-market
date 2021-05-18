<?php 

class PostController {

	/*=============================================
		Peticion par tomar los nombres de las columnas
		=============================================*/

		public function getColumnsData($table, $dataBase){

			$response = PostModel::getColumnsData($table, $dataBase);
			return $response;
		}


	/*=============================================
		Peticion POST para crear Datos
		=============================================*/

		public function postData($table, $data){

			$response = PostModel::postData($table, $data);

			$return = new PostController();
			$return ->fncResponse($response, "postData", null);

		}


		/*=============================================
		Respuesta del controlador
		=============================================*/

		public function fncResponse($response, $method){

			if (!empty($response)) {
				$json = array(
					'status' => 200,
					'result'=> "Proceso correctamente"
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

