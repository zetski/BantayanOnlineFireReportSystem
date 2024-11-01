<?php 
require_once('../config.php'); 

// Sanitize and validate input
function sanitize_input($input) {
    $input = strip_tags($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    
    // Disallow dangerous symbols and the word "script"
    $disallowed_symbols = ['<', '>', '/', '"', "'"];
    foreach ($disallowed_symbols as $symbol) {
        if (strpos($input, $symbol) !== false) {
            return '';
        }
    }

    if (preg_match('/script/i', $input)) {
        return '';
    }

    return $input;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);

    if (empty($username) || empty($password)) {
        echo 'Invalid input';
        exit;
    }

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $user = $result->fetch_assoc();
    
    $dummy_hash = password_hash("invalid_password", PASSWORD_DEFAULT);
    $password_hash = $user ? $user['password'] : $dummy_hash;

    if (password_verify($password, $password_hash)) {
        if ($user) {
            // User authenticated successfully
            session_start();
            $_SESSION['user_id'] = $user['id'];  // Store user ID in session
            $_SESSION['username'] = $user['username'];  // Store username in session
            $_SESSION['district'] = $user['district'];  // Store user's district in session

            // Log the district to verify it's set
        error_log("User logged in with district: " . $_SESSION['district']);
            
            echo 'Login successful';

            // Optionally, redirect to the dashboard
            // header("Location: dashboard.php");
            exit;
        } else {
            echo 'Invalid credentials';
        }
    } else {
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
        background-size: cover; /* Ensure the image covers the entire background */
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Prevent repeating the image */
        backdrop-filter: contrast(1);
        height: 100vh; /* Ensure body takes full viewport height */
        margin: 0; /* Remove default margin */
    }
    #page-title {
        text-shadow: 6px 4px 7px black;
        font-size: 3.5em;
        color: #fff4f4 !important;
    }
    .login-box {
        margin: auto; /* Center the login box */
        max-width: 400px; /* Set a max width for the login box */
        width: 90%; /* Allow it to be responsive */
    }

    /* Media queries for responsive design */
    @media (max-width: 768px) {
        #page-title {
            font-size: 2.5em; /* Reduce title size on smaller screens */
        }
        .login-box {
            width: 95%; /* Make the login box wider on smaller screens */
        }
    }
    @media (max-width: 480px) {
        #page-title {
            font-size: 2em; /* Further reduce title size on very small screens */
        }
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

    // Automatically remove disallowed characters as they are typed
document.querySelector('input[name="username"]').addEventListener('input', function(e) {
    // Replace disallowed characters in username field
    e.target.value = e.target.value.replace(/[<>\/]/g, '');
});

document.querySelector('input[name="password"]').addEventListener('input', function(e) {
    // Replace disallowed characters in password field
    e.target.value = e.target.value.replace(/[<>\/]/g, '');
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

// Disable inspect element and right-click
// document.addEventListener('contextmenu', event => event.preventDefault());
// document.onkeydown = function(e) {
//     if (e.keyCode == 123 || e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0) || 
//         e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0) || 
//         e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
//         return false;
//     }
// };
  </script>
</body>
</html>
