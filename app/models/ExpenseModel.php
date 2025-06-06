<?php



class ExpenseModel extends Model{

	public function __construct(){
		$this->table = 'Expenses';
		parent::__construct();
	} 

	public function insertExpenses($data){
		$result = $this->expenseExists($data);
		if(is_array($result) && count($data) > 0){
			return false;
		}
		return $this->insert($data);
	}

	public function getExpenses($userId){
		$sql = "SELECT e.ID AS EXPENSE_ID,c.ID AS CATEGORY_ID,p.ID AS PAYMENT_METHOD_ID,c.NAME AS CATEGORY,c.TYPE,p.NAME AS PAYMENT_METHOD,e.AMOUNT,e.DESCRIPTION,e.EXPENSE_DATE FROM ".$this->table." AS e JOIN Categories AS c ON c.ID = e.CATEGORY_ID JOIN PaymentMethods AS p ON p.ID = e.PAYMENT_METHOD_ID WHERE e.USER_ID = :USER_ID";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['USER_ID' => $userId]);
		return $stmt->fetchAll();
	}

	public function getExpenseById($expenseIdKey,$expenseIdValue){
		return $this->getById($expenseIdKey,$expenseIdValue);
	}

	public function deleteExpense($expenseId){
		$sql = "DELETE FROM ".$this->table." WHERE ID = :ID";
		$stmt = $this->conn->prepare($sql);
		return $stmt->execute(["ID" => $expenseId]);
	}


	private function expenseExists($data){
		$sql = "SELECT * FROM ".$this->table." WHERE USER_ID = :USER_ID && CATEGORY_ID = :CATEGORY_ID && PAYMENT_METHOD_ID = :PAYMENT_METHOD_ID && AMOUNT = :AMOUNT && DESCRIPTION = :DESCRIPTION && EXPENSE_DATE = :EXPENSE_DATE";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute($data);
		return $stmt->fetch();
	}

} 