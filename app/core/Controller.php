<?php



class Controller{

	protected $model;

	protected function view($viewName,$data = []){

		if(!empty($data)){
			extract($data);
		}

		$viewPath = APP_ROOT.'app/views/'.$viewName.'.view.php';

		if(file_exists($viewPath)){
			require_once $viewPath;
		}
		else{
			http_response_code(404);
			$data['title'] = '404 - Page Not Found';
			$data['view'] = $viewPath;
			require_once '../app/views/error/error.view.php';
		}
	}

	protected function sendJsonResponse($data){
		header('Content-Type:application/json');
		echo json_encode($data);
		exit();
	}

	protected function getModel($modelName){
		$modelPath = APP_ROOT.'app/models/'.$modelName.'.php';
		if(file_exists($modelPath)){
			require_once $modelPath;
			return new $modelName();
		}
		else{
			die($modelPath." not found");
		}
	}

	protected function useCustomHeaders(){	
		header("Access-Control-Allow-Origin: *");  // Allow all origins (or restrict to specific origins)
		header("Access-Control-Allow-Headers: Authorization, Content-Type");  // Allow specific headers
		header("Content-Type: application/json");
	}

	protected function verifyAndGetInput(){
		$this->useCustomHeaders();

		$headers = getallheaders();

		error_log(print_r(getallheaders(),true));

		if(!array_key_exists('Authorization',$headers) || $headers['Authorization'] !== 'Bearer '.API_KEY){
			$response['status'] = 'error';
			$response['message'] = 'UnAuthorized Access';
			$this->sendJsonResponse($response);
		}

		$input = json_decode(file_get_contents("php://input"), true);

		error_log(print_r($input,true));
		return $input;
	}

}