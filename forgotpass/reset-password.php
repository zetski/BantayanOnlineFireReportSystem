<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
    body {
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size: cover;
      background-repeat: no-repeat;
      backdrop-filter: contrast(1);
    }
    #page-title {
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
      background: #8080801c;
    }
  </style>
  <h1 class="text-center text-white px-4 py-5" id="page-title"><b><?php echo $_settings->info('name') ?></b></h1>
  <div class="login-box">
    <div class="card card-danger my-2">
      <div class="card-body">
        <p class="login-box-msg">Enter a new password</p>
        <form id="reset-password-frm" action="reset-password-process.php" method="post">
          <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="New Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
            </div>
          </div>
        </form>
        <p class="mb-1 mt-3">
          <a href="login.php">Back to Login</a>
        </p>
      </div>
    </div>
  </div>
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function(){
      end_loader();
    });
  </script>
</body>
</html>
