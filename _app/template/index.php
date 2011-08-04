<!DOCTYPE html>
<html>

<head>
<title><?php echo $title . " &mdash; " . $siteTitle; ?></title>
<link rel="stylesheet" href="_app/template/style.css" type="text/css">
</head>

<body>
<div class="container">
	
	<div class="header">
		<h1><a href="/"><?php echo $siteTitle; ?></a></h1>
	</div>
	
	<div class="navigation">
		<?php echo $navigation; ?>
	</div>
	
	<div class="content">
		<?php echo $content; ?>
	</div>
	
</body>
</html>