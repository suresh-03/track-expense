
<?php

require "../../index.php";
require BASE_PATH . "/config/config.php";

class Model {
    protected $table;

    function __construct(){

    }

    protected function connectDB(){
        
        $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if(mysqli_connect_errno()){
            echo "database not connected".mysqli_connect_errno();
            exit();
        }
        echo "database connected";
        return $conn;
    }
}