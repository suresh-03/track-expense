<?php


class PaymentMethodModel extends Model{

	public function __construct(){
		$this->table = 'PaymentMethods';
		parent::__construct();
	}

	public function insertPaymentMethod($data){
		$paymentMethod = $this->paymentMethodExists($data['USER_ID'],$data['NAME']);
		if(is_array($paymentMethod) && count($paymentMethod) > 0){
			return false;
		}
		return $this->insert($data);
	}

	public function getPaymentMethodId($userId){
		$sql = 'SELECT ID FROM '.$this->table.' WHERE USER_ID = :USER_ID';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['USER_ID' => $userId]);
		return $stmt->fetch();
	}

	public function paymentMethodExists($userId,$name){
		$sql = 'SELECT * FROM '.$this->table.' WHERE USER_ID = :USER_ID AND NAME = :NAME';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['USER_ID' => $userId,'NAME' => $name]);
		return $stmt->fetch();
	}

	public function getPaymentMethod($paymentMethodIdKey,$paymentMethodIdValue){
		return $this->getById($paymentMethodIdKey,$paymentMethodIdValue);
	}
}