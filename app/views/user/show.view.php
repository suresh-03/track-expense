<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$data['title']?></title>
</head>
<body>
	<div id="user-info"></div>

	<div id="error"></div>

	<script src="<?=ROOT?>public/assets/js/main.js"></script>
	<script type="text/javascript">
		fetchData('<?=ROOT?>public/user/getAllUsers');
	</script>
</body>
</html>