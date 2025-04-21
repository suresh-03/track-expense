<?php


class PaymentMethodController extends Controller{

	public function __construct(){
		$this->model = $this->getModel('PaymentMethodModel');
	}

	public function insertPaymentMethod($data){
		return $this->model->insertPaymentMethod($data);
	}

	public function getPaymentMethodId($userId){
		return $this->model->getPaymentMethodId($userId);
	}
}