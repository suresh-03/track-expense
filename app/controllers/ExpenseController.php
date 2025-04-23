<?php

require_once 'CategoryController.php';
require_once 'PaymentMethodController.php';

class ExpenseController extends Controller{

	public function __construct(){
		$this->model = $this->getModel('ExpenseModel');
	}

	public function handleExpenseRequest(){

		if(!empty($_SESSION)){
		
		$input = $this->verifyAndGetInput();

		switch($input['action']){

			case 'addExpense':
				$this->handleAddExpenseRequest($input);
				break;
		}
		}
		else{
			$this->sendJsonResponse(['error' => 'UnAuthorized Access']);
		}	
	}

	public function addExpense(){
		if(!empty($_SESSION)){
			$data['title'] = 'Add Expense';
			$this->view('expense/add.expense',$data);
		}
		else{
			$this->sendJsonResponse(['error' => 'UnAuthorized Access']);
		}
	}

	private function handleAddExpenseRequest($method){
		$response = [];

		$userId = $_SESSION['USER_ID'];
		$category = $method['category'];
		$paymentMethod = $method['paymentMethod'];

		$categoryController = new CategoryController;
		$paymentMethodController = new PaymentMethodController;

		if(!$categoryController->insertCategory(['USER_ID' => $userId,'NAME' => $category, 'TYPE' => 'expense'])){
			// $response['status'] = 'error';
			// $response['message'] = 'category is not added';
			// $this->sendJsonResponse($response);
		}
		if(!$paymentMethodController->insertPaymentMethod(['USER_ID' => $userId,'NAME' => $paymentMethod])){
			// $response['status'] = 'error';
			// $response['message'] = 'payment method is not added';
			// $this->sendJsonResponse($response);
		}

		$categoryId = $categoryController->getCategoryId($userId);
		$paymentMethodId = $paymentMethodController->getPaymentMethodId($userId);

		$amount = $method['amount'];
		$description = $method['description'];
		$expenseDate = $method['expenseDate'];

	

		$columns = ['USER_ID' => $userId,'CATEGORY_ID' => $categoryId['ID'], 'PAYMENT_METHOD_ID' => $paymentMethodId['ID'], 'AMOUNT' => $amount, 'DESCRIPTION' => $description, 'EXPENSE_DATE' => $expenseDate];

		if($this->model->insertExpenses($columns)){
			$response['status'] = 'success';
			$response['message'] = 'expense added successfully';
		}
		else{
			$response['status'] = 'error';
			$response['message'] = 'expense not added';
		}

		$this->sendJsonResponse($response);
	}
}