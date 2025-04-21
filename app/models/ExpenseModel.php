<?php



class ExpenseModel extends Model{

	public function __construct(){
		$this->table = 'Expenses';
		parent::__construct();
	} 

	public function insertExpenses($data){
		return $this->insert($data);
	}

} 