<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> 
<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="stylesheet" href="<?php echo app()->request->baseUrl; ?>/css/normalize.css">
	
	<!-- Use the .htaccess and remove these lines to avoid edge case issues. More info: h5bp.com/b/378 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo h($this->metaTitle); ?></title>
	<meta name="description" content="<?php echo h($this->metaDescription); ?>">
	<meta name="keywords" content="<?php echo h($this->metaKeywords); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">


	<link rel="stylesheet" href="<?php echo app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo app()->request->baseUrl; ?>/css/styles.css"/>

	<script src="<?php echo app()->request->baseUrl; ?>/app/js/libs/utils/modernizr-2.6.2.js"></script>

	<link rel="shortcut icon" href="<?php echo app()->request->baseUrl; ?>/images/favicon.ico">
</head>

<body>
<div class="container">
	<?php echo $content?>
</div>

</body>
</html>