<?php


class CategoryController extends Controller{

	public function __construct(){
		$this->model = $this->getModel('CategoryModel');
	}

	public function insertCategory($data){
		return $this->model->insertCategory($data);
	}

	public function getCategoryId($userId){
		return $this->model->getCategoryId($userId);
	}

	public function getCategory($categoryIdKey,$categoryIdValue){
		return $this->model->getCategory($categoryIdKey,$categoryIdValue);
	}
}