<?php


class CategoryModel extends Model{

	public function __construct(){
		$this->table = 'Categories';
		parent::__construct();
	}

	public function insertCategory($data){
		$category = $this->categoryExists($data['USER_ID'],$data['NAME'],$data['TYPE']);
		if(is_array($category) && count($category) > 0){
			return false;
		}
		return $this->insert($data);
	}

	public function getCategoryId($userId){
		$sql = 'SELECT ID FROM '.$this->table.' WHERE USER_ID = :USER_ID';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['USER_ID' => $userId]);
		return $stmt->fetch();
	}

	public function categoryExists($userId,$name,$type){
		$sql = 'SELECT * FROM '.$this->table.' WHERE USER_ID = :USER_ID AND NAME = :NAME AND TYPE = :TYPE';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['USER_ID' => $userId,'NAME' => $name,'TYPE' => $type]);
		return $stmt->fetch();
	}
}