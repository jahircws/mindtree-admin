<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $pageTitle; ?></title>
	<link rel="shortcut icon" href="<?php echo site_url(); ?>assets/images/mindtreeinc.png" type="image/x-icon">
	<link rel="icon" href="<?php echo site_url(); ?>assets/images/mindtreeinc.png" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css" media="print">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/style.css">
	<script src="<?php echo site_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
	<script src="<?php echo site_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo site_url(); ?>assets/js/jquery.validate.min.js"></script>
	<script> var baseURL = '<?php echo site_url(); ?>'; </script>
</head>
<body class="boxed-version">
	<noscript>Your browser does not support JavaScript</noscript>

	<?php include 'includes/header.php'; ?>
	<?php include $pageName.'.php'; ?>
	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?php echo site_url(); ?>assets/js/countdown.js"></script>
	<script src="<?php echo site_url(); ?>assets/js/script.js"></script>
</body>
</html>