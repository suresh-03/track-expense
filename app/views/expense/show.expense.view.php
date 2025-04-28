<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=APP_NAME?> - <?=$data['title']?></title>
	<script src="<?=ROOT?>public/assets/js/expense/show-expense.js"></script>
</head>
<body>
	<div id="error-msg"></div>
	<div id="expense-container">
		<table id="expense-table">
			<th>SI.No</th>
			<th>Category</th>
			<th>Type</th>
			<th>Payment Method</th>
			<th>Amount</th>
			<th>Description</th>
			<th>Expense Date</th>
		</table>
	</div>
	<script type="text/javascript">
		window.onload = () => {
			handleShowExpense('<?=ROOT?>public/api/expense/handleExpenseRequest','<?=API_KEY?>');
		}
	</script>
</body>
</html>