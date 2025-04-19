<?php


class AuthController extends Controller{

	public function __construct(){
		$this->model = $this->getModel('UserModel');
	}

	public function handleApiRequest(){
		
		$action = $_POST['action'] ?? $_GET['action'];
		$method = $_POST ?? $_GET;


		switch ($action) {
			case 'signup':
				$this->handleSignupRequest($method);
				break;
			
			case 'signin':
				$this->handleSigninRequest($method);
				break;

			case 'signout':
				break;
		}
	}

	private function handleSignupRequest($method){
		$username = $method['username'];
		$email = $method['email'];
		$password = $method['password'];

		$response = [];

		$user = $this->model->userExists('EMAIL',$email);
		error_log(print_r($user,true));

		if(is_array($user) && count($user) > 0){
			$response['status'] = 'error';
			$response['message'] = $email." is already exists!";
		}
		else{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		if($this->model->insertUsers(['USERNAME' => $username,'EMAIL' => $email,'PASSWORD' => $hashedPassword])){
			$response['status'] = 'success';
			$response['message'] = $email.' registered successfully!';
			$response['redirect'] = ROOT.'public/auth/signin';
		}
		else{
			$response['status'] = 'error';
			$response['message'] = 'internal server error';
		}
		}

		$this->sendJsonResponse($response);

	}

	private function handleSigninRequest($method){

	}

	public function signup(){
		$data['title'] = 'Signup';
		$this->view('auth/signup',$data);
	}

	public function signin(){
		$data['title'] = 'Signin';
		$this->view('auth/signin',$data);
	}

}