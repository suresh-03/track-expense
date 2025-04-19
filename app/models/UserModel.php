
<?php


class UserModel extends Model{


	public function __construct(){
		$this->table = 'User';
		parent::__construct();
	}

	public function getAllUsers(){
		return $this->getAll();
	}

	public function userExists($idKey,$idValue){
		return $this->getById($idKey,$idValue);
	}

	public function insertUsers($data){
		return $this->insert($data);
	}
}