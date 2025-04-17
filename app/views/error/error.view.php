<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $data['title']?></title>
	<style type="text/css">
		
		.error-page{
			display: flex;
			height: 100vh;
			width: 100vw;
			justify-content: center;
			align-items: center;
		}

	</style>
</head>
<body>
	<div class='error-page'>
	<?php if(isset($data['method']) && isset($data['controller'])):?>
	<h1><?php echo $data['method']?> not found in <?php echo $data['controller']?></h1>
	<?php elseif(isset($data['controller'])): ?>
	<h1><?php echo $data['controller']?> not found</h1>
	<?php elseif(isset($data['view'])):?>
	<h1><?php echo $data['view']?> not found</h1>
	<?php endif;?>
	</div>
</body>
</html>