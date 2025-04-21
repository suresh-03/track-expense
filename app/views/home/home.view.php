<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=APP_NAME?> - <?=$data['title']?></title>
	<script src="<?=ROOT?>public/assets/js/auth/signout.js"></script>
</head>
<body>
	<?php if(!empty($_SESSION)): ?>
	<form id="signout-form"><button type="submit">Signout</button></form>
	<br>
	<a href="<?=ROOT?>public/expense/addExpense">Add Expense</a>
	<script type="text/javascript">
		handleSignout('<?=ROOT?>public/auth/handleApiRequest');
	</script>
	<?php endif; ?>
</body>
</html>