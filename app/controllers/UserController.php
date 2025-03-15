<?php

require "../core/Controller.php";
require "../models/UserModel.php";

class UserController extends Controller{
    
    protected $model;

    function __construct(){
        $this->model = new UserModel();
    }

    
}