<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=APP_NAME?> - <?=$data['title']?></title>
	<script src="<?=ROOT?>public/assets/js/expense/edit-expense.js"></script>
</head>
<body>
	<div id="error-msg"></div>
	<form id="edit-expense-form" method="post">
		<label for="category">Expense Category</label><br>
		<select name="category" id="category" required>
			<option value="choose..." disabled selected>--select--</option>
		</select>
		<br>
		<label for="payment-method">Payment Method</label><br>
		<select name="paymentMethod" id="payment-method" required>
			<option value="choose..." disabled selected>--select--</option>
		</select>
		<br>
		<label for="amount">Amount</label><br>
		<input type="text" name="amount" id="amount" value="<?=$data['expense']['AMOUNT']?>" required>
		<br>
		<label for="description">Description</label><br>
		<textarea id="description" name="description" rows="10" cols="40"required><?=$data['expense']['DESCRIPTION']?></textarea>
		<br>
		<label for="expense-date">Expense Date</label><br>
		<input type="date" name="expenseDate" value="<?=$data['expense']['EXPENSE_DATE']?>" id="expense-date" required>
		<br>
		<button type="submit">Submit</button>
	</form>

	<script type="text/javascript">
		
		handleEditExpense('<?=ROOT?>public/api/expense/handleExpenseRequest', '<?=API_KEY?>');
		populateCategoryOptions('<?=$data["category"]["NAME"]?>');
		populatePaymentOptions('<?=$data["paymentMethod"]["NAME"]?>');
	
	</script>
</body>
</html>