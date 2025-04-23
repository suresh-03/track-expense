<?php


class AuthController extends Controller{

	public function __construct(){
		$this->model = $this->getModel('UserModel');
	}

	public function handleAuthRequest(){
		
		$input = $this->verifyAndGetInput();
		switch ($input['action']) {
			case 'signup':
				$this->handleSignupRequest($input);
				break;
			
			case 'signin':
				$this->handleSigninRequest($input);
				break;

			case 'signout':
				$this->handleSignoutRequest();
				break;
		}
	}

	private function handleSignupRequest($method){
		$username = $method['username'];
		$email = $method['email'];
		$password = $method['password'];

		$response = [];

		$user = $this->model->userExists('EMAIL',$email);
		// error_log(print_r($user,true));

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
		$email = $method['email'];
		$password = $method['password'];

		$response = [];

		$user = $this->model->userExists('EMAIL',$email);

		if(!is_array($user)){
			$response['status'] = 'error';
			$response['message'] = 'user not exists';
		}
		else{
			if(password_verify($password, $user['PASSWORD'])){
				$response['status'] = 'success';
				$response['message'] = 'user signed in successfully';
				$_SESSION['USER_ID'] = $user['ID'];
				$_SESSION['USER_EMAIL'] = $user['EMAIL'];
				$response['redirect'] = ROOT.'public/home';
			}
			else{
				$response['status'] = 'error';
				$response['message'] = 'invalid password';
			}
		}

		$this->sendJsonResponse($response);
	}

	public function signup(){
		$data['title'] = 'Signup';
		$this->view('auth/signup',$data);
	}

	public function signin(){
		$data['title'] = 'Signin';
		$this->view('auth/signin',$data);
	}

	private function handleSignoutRequest(){
		session_unset();
		session_destroy();
		$response['status'] = 'success';
		$response['redirect'] = ROOT.'public/home';
		$this->sendJsonResponse($response);
	}

}