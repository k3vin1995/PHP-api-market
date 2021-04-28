<?php 

/**
 * 
 */
class GetController
{
	/*=============================================
	=            Peticiones GET            =
	=============================================*/
	
	
	public function getData($table){

		$response = GetModel::getData($table);

		if (!empty($response)) {
			$json = array(
				'status' => 200,
				'total' => count($response),
				'result'=> $response
			);
			}else {

				$json = array(
					'status' => 404,
					'result'=> "NOT FOUND"
				);
			}


			echo json_encode($json, http_response_code($json["status"]));
			return;
		# code...
		}


	}