<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=APP_NAME?> - <?=$data['title']?></title>
	<script src="<?=ROOT?>public/assets/js/expense/add-expense.js"></script>
</head>
<body>
	<div id="error-msg"></div>
	<form id="add-expense-form" method="post">
		<label for="category">Expense Category</label><br>
		<select name="category" id="category" required>
			<option value="food">Food</option>
			<option value="transportation">Transportation</option>
			<option value="medical">Medical</option>
			<option value="education">Education</option>
		</select>
		<br>
		<label for="payment-method">Payment Method</label><br>
		<select name="paymentMethod" id="payment-method" required>
			<option value="cash">Cash</option>
			<option value="upi">UPI</option>
			<option value="credit card">Credit Card</option>
			<option value="debit card">Debit Card</option>
		</select>
		<br>
		<label for="amount">Amount</label><br>
		<input type="text" name="amount" id="amount" required>
		<br>
		<label for="description">Description</label><br>
		<textarea id="description" name="description" rows="10" cols="40" required></textarea>
		<br>
		<label for="expense-date">Expense Date</label><br>
		<input type="date" name="expenseDate" id="expense-date" required>
		<br>
		<button type="submit">Submit</button>
	</form>

	<script type="text/javascript">
		handleAddExpense('<?=ROOT?>public/api/expense/handleExpenseRequest','<?=API_KEY?>');
	</script>
</body>
</html>