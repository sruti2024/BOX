<?php
// Include config file
require_once 'core/inc/cnf.php';

// Initialize the session
require_once 'core/inc/sessions.php';

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION['box']) || $_SESSION['box'] !== true) {
    header('location: index.php');
    exit();
}
if (!isset($_SESSION['box']) || $_SESSION['mob_status'] !== done) {
    header('location: verify.php');
    exit();
}
$username = 'adoreuij_boxv2';
$password = 'JQYL40MGZ0G6';
$database = 'adoreuij_boxv2';
$mysqli = new mysqli('localhost', $username, $password, $database);
$link = mysqli_connect(
    'localhost',
    'adoreuij_boxv2',
    'JQYL40MGZ0G6',
    'adoreuij_boxv2'
);
require_once 'core/inc/cnf.php';
// Define variables and initialize with empty values
$new_password = $confirm_password = '';
$new_password_err = $confirm_password_err = '';

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate new password
    if (empty(trim($_POST['new_password']))) {
        $new_password_err = 'Please enter the new password.';
    } elseif (strlen(trim($_POST['new_password'])) < 6) {
        $new_password_err = '<i class="material-icons">sentiment_very_dissatisfied</i><br>' . 'Password must have atleast 6 characters' ;
    } else {
        $new_password = trim($_POST['new_password']);
    }

    // Validate confirm password
    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = 'Please confirm the password.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if (empty($new_password_err) && $new_password != $confirm_password) {
            $confirm_password_err = '<i class="material-icons">sentiment_very_dissatisfied</i><br>' . 'Password did not match.';
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = 'UPDATE user_tbl SET password = ? WHERE u_id = ?';

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'ss', $param_password, $param_u_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_u_id = $_SESSION['u_id'];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header('location: index.php');
                exit();
            } else {
                echo 'Oops! Something went wrong. Please try again later.';
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<?php include 'core/inc/functions.php'; ?>
<?php include 'core/inc/variables.php'; ?>
  <head>
    <title>Reset Password | Box</title>
<?php include 'core/inc/header.php'; ?>
  <style>
      label {
        font-weight: 700;
      }
      .bootstrap-select {
        border: none;
        border: 1px solid red;
      }
      textarea {
        border: 1.5px solid #ddd;
        border-radius: 5px;
      }
      .form-line {
        margin: 15px auto;
        margin: 30px 0;
      }
      .btn{
        margin: 1.5em;
        width: 150px;
      }
      input {
        padding: 5px auto;
        width: fit-content;
      }

      .form-group{
        
      }

      label {
        color: rgb(34, 34, 34);
        color: black;
      }
    </style>
  </head>
  <body class="theme-blue">

    <?php include 'core/inc/loader.php' ?>
    <?php include 'core/inc/nav.php' ?>

    <section class="content">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>Reset Password</h2>
              </div>
              <div
                class="cotnainer-reset"
                style="display: grid; justify-content: center;">
                <div
                  class="body"
                  style="
                    width: 30em;" >
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <center><span class="help-block" style="color:orangered;">
                          <?php echo $confirm_password_err; ?></span>
                      <span class="help-block" style="color:orangered;">
                          <?php echo  $new_password_err; ?>
                          </span></center>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <input
                        type="password" 
                        name="new_password"
                        class="form-control"
                        value="<?php echo $new_password; ?>" required>
                    
                        <label class="form-label" style="color: rgb(32, 32, 32);">New Password</label>

                        


                      </div>
                    </div>

                    <div class="form-group form-float">
                        	
                      <div class="form-line">
                        <input
                          type="password" 
                          name="confirm_password"
                          class="form-control"
                          required
                        />
                        <label class="form-label" style="color: rgb(32, 32, 32);">Retype Password</label>
                        
                      </div>
                    </div>

                    <br />
                      <center>                    
                        <button type="submit" class="btn bg-red  waves-effect" >
                        RESET
                      </button>
                    </center>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
      </div>
    </section>

    <?php include 'core/inc/footer.php'?>
    
  </body>
</html>
