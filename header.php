<?php require_once('functions/main.php'); ?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="<?php echo DESC; ?>">
        <meta name="author" content="<?php echo AUTHOR; ?>">
	    <title><?php echo TITLE_HEAD; ?></title>
	    <link rel="shortcut icon" href="<?php echo SERVER; ?>assets/brand/2_crop.png" type="image/x-icon">
	    <!-- Bulma Version 0.7.4-->
	    <link rel="stylesheet" href="<?php echo SERVER; ?>assets/css/style.css" />
	    <link type="text/css" href="<?php echo SERVER; ?>assets/bulma-pageloader/dist/css/bulma-pageloader.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo SERVER; ?>assets/bulma-pageloader/src/sass/index.sass" rel="stylesheet">
        <!-- JS -->
        <script src="<?php echo SERVER; ?>assets/js/menu.js"></script>
	</head>
	<body>
		<div class="pageloader"><span class="title"></span></div>
		<?php #echo $Navegation->HeroMenu();