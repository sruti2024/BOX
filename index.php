<?php
// Include config file
require_once "core/inc/cnf.php";
$string = $_SERVER['QUERY_STRING'];
$string_check = substr($string,0,3);
$string_checker = "url";
if($string_check == $string_checker){
    $ref_url = substr($string,4,500);
}
else {
    $ref_url = '/dash.php';
}


$str_len = strlen($ref_url);
$fixed_len = 0;
if($str_len == $fixed_len){
    $page = "dash.php";
}
else{
    $page = "https://labs.infovue.in/v2box".$ref_url."";
    
}
ini_set('session.gc_maxlifetime', 86400);
session_set_cookie_params(86400);
# Enable session garbage collection with a .01% chance of
# running on each session_start()
ini_set('session.gc_probability', 0);
ini_set('session.gc_divisor', 100);
# Start the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["box"]) && $_SESSION["box"] === true){
    header("location: ".$page."");
    exit;
}
 
// Define variables and initialize with empty values
$email_id = $password = "";
$email_id_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email_id is empty
    if(empty(trim($_POST["email_id"]))){
        $email_id_err = "Please enter email_id.";
    } else{
        $email_id = trim($_POST["email_id"]);
        $ref_url = trim($_POST["url"]);
    
        }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_id_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT u_id, email_id, password, grp, u_stats, zone, l_name, f_name, mob_status, phone, mob_verification, country, basic_status, pic_status,id_status FROM user_tbl WHERE email_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email_id);
            
            // Set parameters
            $param_email_id = $email_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email_id exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $u_id, $email_id, $hashed_password, $grp, $u_stats, $zone, $l_name, $f_name, $mob_status, $phone, $mob_verification, $country, $basic_status, $pic_status, $id_status);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            ini_set('session.gc_maxlifetime', 86400);
                            ini_set('session.gc_probability', 0);
                            ini_set('session.gc_divisor', 100);
                            // each client should remember their session id for EXACTLY 21 hour
                            session_set_cookie_params(86400);
                            session_start();
                            // Store data in session variables
                            $_SESSION["box"] = true;
                            $_SESSION["u_id"] = $u_id;
                            $_SESSION["email_id"] = $email_id;    
							$_SESSION["grp"] = $grp;
							$_SESSION["u_stats"] = $u_stats;
							$_SESSION["zone"] = $zone;							
							$_SESSION["l_name"] = $l_name;	
							$_SESSION["f_name"] = $f_name;	
							$_SESSION["mob_status"] = $mob_status;	
							$_SESSION["phone"] = $phone;
						    $_SESSION["country"] = $country;
						    $_SESSION["basic_status"]= $basic_status;
						    $_SESSION["pic_status"]= $pic_status;
							$_SESSION["id_status"]= $id_status;
							$page = "https://labs.infovue.in/v2box".$ref_url."";
							
                            // Redirect user to welcome page
                            header("location: ".$page."");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid";
                        }
                    }
                } else{
                    // Display an error message if email_id doesn't exist
                    $email_id_err = "No account found with that email_id.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login | Infovue Box</title>
    <!-- Favicon-->
    <link rel="icon" href="http://assets.ivdata.in/v2box/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="http://assets.ivdata.in/v2box/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="http://assets.ivdata.in/v2box/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="http://assets.ivdata.in/v2box/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="http://assets.ivdata.in/v2box/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<style>
    html{
    background: hsla(217, 100%, 50%, 1);
    background: linear-gradient(90deg, hsla(217, 100%, 50%, 1) 0%, hsla(186, 100%, 69%, 1) 100%);
    background: -moz-linear-gradient(90deg, hsla(217, 100%, 50%, 1) 0%, hsla(186, 100%, 69%, 1) 100%);
    background: -webkit-linear-gradient(90deg, hsla(217, 100%, 50%, 1) 0%, hsla(186, 100%, 69%, 1) 100%);   
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#0061FF", endColorstr="#60EFFF", GradientType=1 );
    height: 100vh;
}
.container{
    border-radius: 20px;
    height: 95vh;
    width:97vw;
    display: grid;
    grid-template-columns: 1fr 45%;
    grid-template-rows: 1fr;
    grid-template-areas: "left right";
    background-color: white;
}
.right-pan{
    grid-area: right;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.left-pan{
    grid-area: left;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.card{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    width: 420px;
    height:390px;
}
.card .body{
    width:410px;
    height:auto;
    padding-bottom:0px;
    padding-top:0px;
}
.left-pan img{
    height: 70%;
}
.msg{
    margin-bottom: 1em;
}

@media only screen and (max-width:800px){
    html{
        height: 100%;
        background: none;
    }
    .container{
        border-radius: 20px;
        height: auto;
        width:auto;
        display: grid;
        grid-auto-rows: 1fr auto;
        grid-template-columns: 1fr 1fr;
        grid-template-areas: "right right""left left";
        align-items: center;
        margin: 10px;

    }
    .right-pan{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin: 5px;
        grid-area: right;
    }
    .left-pan{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        grid-area: left;
    }
    
    .card{
        width: 350px;
        height:auto;
    }
    .card .body{
        width:340px;
        height:auto;
        padding-bottom:10px;
        padding-top:15px;
    }
    .left-pan img{
        height: 70%;
    }
    .msg{
        margin-bottom: 1em;
    }
    .signup-forgot{
    font-size:13px
    margin:0px;
}
}
.success .material-icons{
    color:#2d9632;
    margin-right:5px;
}
.success{
    color: #2d9632;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

</style>
<body class="container" style="margin-top:15px">
    <?php include 'core/inc/loader.php'?>

    <div class="right left-pan">
        <img class="signup-image" src="https://labs.infovue.in/v2box/core/img/login-img.svg" alt="">
    </div>

    <div class="login-box  left right-pan" >


       <div class="card">
            <div class="body">

                <?php echo $_SESSION["cc"]?>

                <form id="sign_in" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <center><img src="https://labs.infovue.in/v2box/core/img/logo-infovue2.png" style="width: 13em; margin-bottom: 1em;" alt=""></center>
                    <!-- <center><div class="msg"><h4>Login</h4></div></center> -->
                    <span style="color:orangered; font-size:12px" class="help-block"><?php echo $email_id_err; ?></span>
                    
                    <span style="color:orangered; font-size:12px" class="help-block">
                        <?php echo $password_err; ?>
                    </span>
                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">mail</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email_id" placeholder="Username" required autofocus value="<?php echo $email_id; ?>">
                        </div>
                    </div>
                    <div class="input-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                        <input type="submit" class="btn btn-block bg-pink waves-effect" value="Login">                         
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20 signup-forgot">
                        <div class="col-xs-6">
                            <a href="http://labs.infovue.in/v2box/signup.php" style="font-size=12px">New User? Sign Up!</a>
                        </div>
                        <div class="col-xs-6 align-right" style="font-size=10px">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                    <?php 
					if( $_GET["ref"] == reg_success)
					echo '<div class="success" style="color:#2d9632">
					    <i class="material-icons">sentiment_very_satisfied</i> Well done! You are Signed Up. Login into DashBoard.
					</div>'
					?>

                </form>
            </div>
        </div>
    </div>
    <!-- Jquery Core Js -->
    <script src="http://assets.ivdata.in/v2box/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="http://assets.ivdata.in/v2box/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="http://assets.ivdata.in/v2box/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="http://assets.ivdata.in/v2box/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="http://assets.ivdata.in/v2box/js/admin.js"></script>
    <script src="http://assets.ivdata.in/v2box/js/pages/examples/sign-in.js"></script>
</body>

</html>