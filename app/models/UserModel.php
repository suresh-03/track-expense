
<?php


class UserModel extends Model{


	public function __construct(){
		$this->table = 'User';
		parent::__construct();
	}

	public function getAllUsers(){
		return $this->getAll();
	}
}