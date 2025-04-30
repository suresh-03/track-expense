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

			case 'index':
				$this->handleShowExpenseRequest();
				break;

			case 'deleteExpense':
				$this->handleDeleteExpenseRequest($input);
				break;

			case 'editExpense':
				$this->handleEditExpenseRequest($input);
				break;
		}
		}
		else{
			$this->sendJsonResponse(['status' => 'error','message' => 'User not signed in. Please signin to access this feature']);
		}	
	}

	public function addExpense(){
		if(!empty($_SESSION)){
			$data['title'] = 'Add Expense';
			$this->view('expense/add.expense',$data);
		}
		else{
			$this->sendJsonResponse(['status' => 'error','message' => 'UnAuthorized Access']);
		}
	}

	private function handleAddExpenseRequest($method){
		$response = [];

		$userId = $_SESSION['USER_ID'];
		$category = $method['category'];
		$paymentMethod = $method['paymentMethod'];
		$amount = $method['amount'];
		$description = $method['description'];
		$expenseDate = $method['expenseDate'];

		$categoryController = new CategoryController;
		$paymentMethodController = new PaymentMethodController;

		$categoryController->insertCategory(['USER_ID' => $userId,'NAME' => $category, 'TYPE' => 'expense']);
		$paymentMethodController->insertPaymentMethod(['USER_ID' => $userId,'NAME' => $paymentMethod]);

		$categoryId = $categoryController->getCategoryId($userId);
		$paymentMethodId = $paymentMethodController->getPaymentMethodId($userId);


		$columns = ['USER_ID' => $userId,'CATEGORY_ID' => $categoryId['ID'], 'PAYMENT_METHOD_ID' => $paymentMethodId['ID'], 'AMOUNT' => $amount, 'DESCRIPTION' => $description, 'EXPENSE_DATE' => $expenseDate];


		if($this->model->insertExpenses($columns)){
			$response['status'] = 'success';
			$response['message'] = 'expense added successfully';
		}
		else{
			$response['status'] = 'error';
			$response['message'] = 'expense already exists';
		}

		$this->sendJsonResponse($response);
	}

	public function index(){
		if(!empty($_SESSION)){
			$data['title'] = 'Expenses';
			$this->view('expense/show.expense',$data);
		}
		else{
			$this->sendJsonResponse(['status' => 'error','message' => 'UnAuthorized Access']);
		}
	}

	private function handleShowExpenseRequest(){
		$response = [];

		$result = $this->model->getExpenses($_SESSION['USER_ID']);

		if(is_array($result) && count($result) > 0){
			$response['status'] = 'success';
			$response['result'] = $result;
			$this->sendJsonResponse($response);
		}
		else{
			$response['status'] = 'error';
			$response['message'] = 'unable to fetch expenses';
			$this->sendJsonResponse($response);
		}
	}

	private function handleDeleteExpenseRequest($input){

		$response = [];

		$expenseId = $input['expenseId'];

		if($this->model->deleteExpense($expenseId)){
			$response['status'] = 'success';
			$response['message'] = 'expense deleted successfully';
			$response['redirectUrl'] = ROOT.'public/expense/index';
			$this->sendJsonResponse($response);
		}
		else{
			$response['status'] = 'error';
			$response['message'] = 'unable to delete expense';
			$this->sendJsonResponse($response);
		}

	}

	public function editExpense($params){
		if(!empty($_SESSION)){
			$data['title'] = 'Edit Expense';
			$data['expenseId'] = $params;
			$data['expense'] = $this->model->getExpenseById('ID',$data['expenseId']);
			$categoryController = new CategoryController;
			$paymentMethodController = new PaymentMethodController;
			$data['category'] = $categoryController->getCategory('ID',$data['expense']['CATEGORY_ID']);
			$data['paymentMethod'] = $paymentMethodController->getPaymentMethod('ID',$data['expense']['PAYMENT_METHOD_ID']);
			$this->view('expense/edit.expense',$data);
		}
		else{
			$this->sendJsonResponse(['status' => 'error','message' => 'UnAuthorized Access']);
		}
	}

	private function handleEditExpenseRequest($input){
		$response = [];

		$expenseId = $input['expenseId'];


	}

	
}