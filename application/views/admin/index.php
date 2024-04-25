<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $pageTitle; ?></title>
  <link rel="stylesheet" href="<?=base_url(); ?>admin-assets/css/app.min.css">
  <link rel="stylesheet" href="<?=base_url(); ?>admin-assets/bundles/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="<?=base_url(); ?>admin-assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url(); ?>admin-assets/css/components.css">
  <link rel='shortcut icon' type='image/x-png' href='<?=base_url(); ?>assets/images/mindtreeinc.png' />
  <script src="<?=base_url(); ?>admin-assets/js/app.min.js"></script>
  <script src="<?php echo site_url(); ?>assets/js/jquery.validate.min.js"></script>
  <script> var baseURL = '<?php echo site_url(); ?>'; </script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php include 'includes/top.php'; ?>
      <?php include 'includes/sidebar.php'; ?>
      
      <?php include $pageName.'.php'; ?>
      
      <?php include 'includes/footer.php'; ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.min.js"></script>
  
  <script src="<?=base_url(); ?>admin-assets/bundles/apexcharts/apexcharts.min.js"></script>
  <script src="<?=base_url(); ?>admin-assets/js/page/index.js"></script>
  <script src="<?=base_url(); ?>admin-assets/bundles/izitoast/js/iziToast.min.js"></script>
  <script src="<?=base_url(); ?>admin-assets/js/scripts.js"></script>
  <script src="<?=base_url(); ?>admin-assets/js/custom.js"></script>
</body>

</html>