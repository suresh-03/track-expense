<?php

require "../core/Model.php";
require "../utils/Validator.php";

class UserModel extends Model{

    function __construct($table = "User"){
        $this->table = $table;
    }

    public function getAll(){
        $conn = $this->connectDB();
        $result = null;

        if($conn){
            $sql = "SELECT * FROM ".$this->table." ORDER BY USER_ID ASC";
            $resource = $conn->query($sql);

            if($resource){
                $result = $resource->fetch_all(MYSQLI_ASSOC);
            }

            $conn->close();
        }
        else{
            echo "Data not fetch from the database";
        }

        return $result;
    }

    public function getById($user_id){
        $conn = $this->connectDB();
        $result = null;

        if($conn){
            $sql = "SELECT * FROM ".$this->table." WHERE USER_ID = ".$user_id;
            $resource = $conn->query($sql);

            if($resource){
                $result = $resource->fetch_all(MYSQLI_ASSOC);
            }
            $conn->close();
        }
        else{
            echo "Data not fetch from the database";
        }

        return $result ? $result[0] : array();
    }

    public function insert($username,$email,$password,$mobile){
        if(!Validator::isAllValid($username,$email,$password,$mobile)){
            exit();
        }
        $conn = $this->connectDB();

    }
}
