<?php



class App{

	private const BLOCKED_API = [
		PUBLIC_URL.'auth/handleAuthRequest',
		PUBLIC_URL.'expense/handleExpenseRequest'
	];

	public function __construct(){

	}

	public function useRouter(){
		Router::route();
	}

	public function blockDirectAccessOfAPIs(){
		$currentURI = $_SERVER['REQUEST_URI'];
		if(in_array($currentURI, self::BLOCKED_API)){
			header('Content-Type: application/json');
			$response['status'] = 'error';
			$response['error'] = 'Endpoint is not accessible';
			echo json_encode($response);
			exit;
		}
	}
}