<?php

require "../core/Model.php";

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
                $result = $resource->fetch_all();
            }
        }
        else{
            echo "Data not fetch from the database";
        }

        return $result;
    }
}