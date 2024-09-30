<?php 
require_once('../config.php'); 

// Sanitize and validate input
function sanitize_input($input) {
    // Strip HTML tags and encode special characters
    $input = strip_tags($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    
    // Disallow the word "script" to block any malicious input
    if (preg_match('/script/i', $input)) {
        die('Invalid input');
    }
    return $input;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password (assuming the password is hashed in the database)
        if (password_verify($password, $user['password'])) {
            // User authenticated successfully
            echo 'Login successful';
        } else {
            // Invalid password
            echo 'Invalid credentials';
        }
    } else {
        // No user found with the given username
        echo 'Invalid credentials';
    }
    $stmt->close();
}
?>
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
  <h1 class="text-center text-white px-4 py-5" id="page-title"><b><?php echo htmlspecialchars($_settings->info('name')) ?></b></h1>
  <div class="login-box" style="height: 100%">
    <div class="card card-danger my-2">
      <div class="card-body">
        <p class="login-box-msg">Please enter your credentials</p>
        <form id="login-frm" action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" autofocus placeholder="Username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
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
              <a href="forgot/forgot-password.php" style="display: inline-block; margin-top: 5px;">Forgot password?</a>
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

  <!-- Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>

  <script>
    $(document).ready(function(){
      end_loader();
    });

    // Toggle password visibility
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

    // Disable inspect element
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.onkeydown = function(e) {
      if (e.keyCode == 123 || e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0) || 
          e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0) || 
          e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        return false;
      }
    };

    // Prevent the word "script" in the username field
    document.getElementById('login-frm').addEventListener('submit', function(e) {
      const username = document.querySelector('input[name="username"]').value.toLowerCase();
      if (username.includes('script')) {
        alert('Invalid input in username');
        e.preventDefault(); // Stop the form from submitting
      }
    });
  </script>
</body>
</html>
