<?php



class Controller{

	protected $model;

	protected function view($viewName,$data = []){

		if(!empty($data)){
			extract($data);
		}

		$viewPath = APP_ROOT.'/app/views/'.$viewName.'.view.php';

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

}