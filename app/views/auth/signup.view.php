<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=APP_NAME?> - <?=$data['title']?></title>
	<script src="<?=ROOT?>public/assets/js/auth/signup.js"></script>
</head>
<body>

	<div id="error-msg"></div>
	<form id="signup-form">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" required>
		<br>
		<label for="email">Email</label>
		<input type="email" name="email" id="email" required>
		<br>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" required>
		<br>
		<button type="submit">Signup</button>
	</form>


	<script type="text/javascript">
		handleSignup('<?=ROOT?>public/api/auth/handleApiRequest');
	</script>
</body>
</html>