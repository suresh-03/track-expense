<?php


class Router{

	public static function route(){
		$url = $_GET['url'] ?? 'home/index';
		$url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

	
		$controllerName = $url[0] == 'api' ? ucfirst($url[1])."Controller" : ucfirst($url[0])."Controller";
		$methodName = $url[0] == 'api' ? $url[2] ?? 'index' : $url[1] ?? 'index';
		$params = $url[0] == 'api' ? array_slice($url, 3) : array_slice($url, 2);
		

		$controllerPath = APP_ROOT."app/controllers/".$controllerName.".php";

		if(file_exists($controllerPath)){
			require_once $controllerPath;
			$controller = new $controllerName();

			if(method_exists($controller, $methodName)){
				call_user_func_array([$controller,$methodName], array_merge($params,[$_GET]));
			}
			else{
				http_response_code(404);
				$data['controller'] = $controllerName;
				$data['method'] = $methodName;
				$data['title'] = '404 - Page Not Found';
				require_once '../app/views/error/error.view.php';
			}
		}
		else{
			http_response_code(404);
			$data['controller'] = $controllerPath;
			$data['title'] = '404 - Page Not Found';
			require_once '../app/views/error/error.view.php';
		}
	}
}