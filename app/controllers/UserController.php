<?php


class UserController extends Controller{

	public function __construct(){
		$this->model = $this->getModel('UserModel');
	}

	public function getAllUsers($params = []){
		if($this->isApiRequest()){
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
	else{
		$data['title'] = 'Users';
		$this->view('user/show',$data);
	}
	}



}
