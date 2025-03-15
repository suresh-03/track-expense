<?php

require "../../index.php";

class Router{

    public static function route(){
        require BASE_PATH."/config/routes.php";

        $request = trim($_SERVER["REQUEST_URI"]);

        if(array_key_exists($request,ROUTES)){
            $controller = ROUTES[$request][0];
            $method = ROUTES[$request][1];

            if(file_exists(BASE_PATH."/app/controllers/".$controller.".php")){
                require BASE_PATH."/app/controllers/".$controller.".php";
                $class = new $controller();

                if(method_exists($class,$method)){
                    $class->$method();
                    exit();
                }
            }

        }

        http_response_code(404);
    }
}