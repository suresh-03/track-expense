<?php

require "../../index.php";

class Controller{
    function __construct(){

    }

    protected function load_view($name = '',$arg = array()){
        $path = BASE_PATH."/app/views/{$name}";
        $data = array();

        foreach($arg as $key => $value){
            $data[$key] = $value;
        }

        ob_start();
        // include all the code in the specified file
        include($path);
        $contents = ob_get_contents();
        ob_end_clean();

        echo $contents;
    }
}