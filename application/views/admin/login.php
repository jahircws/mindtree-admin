<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $pageTitle; ?></title>
  <link rel="stylesheet" href="<?= base_url(); ?>admin-assets/css/app.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>admin-assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="<?= base_url(); ?>admin-assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url(); ?>admin-assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url(); ?>admin-assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-png' href='<?= base_url(); ?>assets/images/mindtreeinc.png' />
  <script src="<?= base_url(); ?>admin-assets/js/app.min.js"></script>
  <script src="<?php echo site_url(); ?>assets/js/jquery.validate.min.js"></script>
  <script> var baseURL = '<?php echo site_url(); ?>'; </script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Admin Login</h4>
              </div>
              <div class="card-body">
                <form id="frmLogin">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus>
                  </div>
                  <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_login" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base_url(); ?>admin-assets/js/login.js"></script>
  <script src="<?= base_url(); ?>admin-assets/js/scripts.js"></script>
  <script src="<?= base_url(); ?>admin-assets/js/custom.js"></script>
</body>

</html>