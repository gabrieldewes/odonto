<!DOCTYPE html>
<html lang="pt-br">
<head>
	<base href="<?=base_url()?>"/>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Tabajara Odonto">
	<meta name="keywords" content="paz,amor,boca,dentes,saúde">
	<meta name="author" content="CRUDZERA GROUP">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabajara Odonto</title>

	<link rel="icon" href="<?=base_url()?>static/images/icons/favicon.ico">
	<!-- Disable tap highlight on IE -->
	<meta name="msapplication-tap-highlight" content="no">
	<!-- Web Application Manifest -->
	<link rel="manifest" href="<?=base_url()?>manifest.json">
	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="application-name" content="Tabajara Odonto">
	<link rel="icon" sizes="192x192" href="<?=base_url()?>static/images/touch/chrome-touch-icon-192x192.png">
	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Tabajara Odonto">
	<link rel="apple-touch-icon" href="<?=base_url()?>static/images/touch/apple-touch-icon.png">
	<!-- Tile icon for Win8 (144x144 + tile color) -->
	<meta name="msapplication-TileImage" content="<?=base_url()?>static/images/touch/ms-touch-icon-144x144-precomposed.png">
	<meta name="msapplication-TileColor" content="#e44d26">
	<!-- Color the status bar on mobile devices -->
	<meta name="theme-color" content="#e44d26">

	<link rel="stylesheet" href="<?=base_url()?>static/styles/normalize.min.css">
	<link rel="stylesheet" href="<?=base_url()?>static/styles/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="<?=base_url()?>static/scripts/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<?php
		if (isset($extraStyles)):
			foreach ($extraStyles as $key => $style):
				echo '<link rel="stylesheet" href="', base_url(), 'static/', $style, '">', PHP_EOL;
			endforeach;
		endif;
	?>
</head>
<body>
	<?php require_once "navbar.php" ?>
	<div id="contents">
		<?= $contents ?>
	</div>
	<?php require_once "footer.php" ?>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script src="<?=base_url()?>static/scripts/main.js"></script>
	<?php
		if (isset($extraScripts)):
			foreach ($extraScripts as $key => $script):
				echo '<script src="', base_url(), 'static/', $script,'"></script>', PHP_EOL;
			endforeach;
		endif;
	?>
</body>
</html>
