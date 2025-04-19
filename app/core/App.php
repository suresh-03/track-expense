<?php



class App{

	public function __construct(){

	}

	public function useRouter(){
		Router::route();
	}

	public function useSession(){
		Session::handleSession();
	}
}