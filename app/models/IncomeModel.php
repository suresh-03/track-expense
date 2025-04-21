<?php

class IncomeModel extends Model{

	public function __construct(){
		$this->table = 'Incomes';
		parent::__construct();
	}
}