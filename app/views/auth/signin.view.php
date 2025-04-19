<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=APP_NAME?> - <?=$data['title']?></title>
	<script src="<?=ROOT?>public/assets/js/auth/signin.js"></script>
</head>
<body>
	<?php if(empty($_SESSION)): ?>
	<div id="error-msg"></div>
	<form id="signin-form">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" required>
		<br>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" required>
		<br>
		<button type="submit">Signin</button>
	</form>
	<script type="text/javascript">
		handleSignin('<?=ROOT?>public/api/auth/handleApiRequest');
	</script>
	<?php endif; ?>
</body>
</html>