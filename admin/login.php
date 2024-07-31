<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
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
        <p class="login-box-msg">Please enter your credentials</p>
        <form id="login-frm" action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" autofocus placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-eye" id="toggle-password" style="cursor: pointer;"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <!-- <a href="forgot-password.php" style="display: inline-block; margin-top: 5px;">Forgot password?</a> -->
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
        <p class="mb-1 mt-3">
          <a href="<?php echo base_url ?>">Go to Website</a>
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

    $('#toggle-password').on('click', function() {
      let passwordField = $('#password');
      let passwordFieldType = passwordField.attr('type');
      if (passwordFieldType == 'password') {
        passwordField.attr('type', 'text');
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });
  </script>
</body>
</html>
