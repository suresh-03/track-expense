<?php


class UserController extends Controller{

	public function __construct($modelName){
		$this->model = $this->getModel($modelName);
	}

	public function getAllUsers($params = []){
		$result = $this->model->getAllUsers();
		if($result){
			$result['params'] = $params;
			$result['status'] = 'sucess';
			$this->sendJsonResponse($result);
		}
		else{
			$this->sendJsonResponse(['status' => 'error','message' => 'unable to fetch data']);
		}
	}

	public function showUsers(){
		$data['title'] = 'Users';
		$this->view('user/show',$data);
	}
}
