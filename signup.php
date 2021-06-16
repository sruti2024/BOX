<?php
// Include config file
require_once "core/inc/cnf.php";
$to = "";
$subject = "Welcome to Infovue";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Infovue Team <care@infovue.in>' . "\r\n";
$headers .= 'Bcc: sky@infovue.in' . "\r\n";


// Define variables and initialize with empty values
$email_id = $password = $confirm_password = "";
$email_id_err = $password_err = $confirm_password_err = $phone_err = "";
$u_stats = "";
$f_name = "";
$l_name = "";
$grp = "";
$phone="";
$city="";
$pin="";
$state="";
$timestamp="";
$country="";
$zone="";
$vol_type="";
$mob_verification="";
$country="";
$u_id = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["email_id"]))){
        $email_id_err = "Please enter a Email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT email_id FROM user_tbl WHERE email_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email_id);
            
            // Set parameters
            $param_email_id = trim($_POST["email_id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_id_err = "This Email ID is already taken.";
                } else{
                    $email_id = trim($_POST["email_id"]);
                    $u_stats = trim($_POST["u_stats"]);
                    $f_name = trim($_POST["f_name"]);
                    $l_name = trim($_POST["l_name"]);
                    $grp = trim($_POST["grp"]);
                    $phone=trim($_POST["phone"]);
                    $city=trim($_POST["city"]);
                    $pin=trim($_POST["pin"]);
                    $state=trim($_POST["state"]);
                    $country=trim($_POST["country"]);
                    $zone=trim($_POST["state"]);
                    $timestamp=trim($_POST["timestamp"]);
                    $vol_type=trim($_POST["vol_type"]);
                    $mob_verification=trim($_POST["mob_verification"]);
                    $country=trim($_POST["country"]);
                    $u_id = trim($_POST["u_id"]);                    
                    
                    
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    if(empty($_POST["phone"])){
        $phone_err = "Please enter a Phone No.";
        
    } else{
        // Prepare a select statement
        $sql = "SELECT phone FROM user_tbl WHERE phone = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phone);
            
            // Set parameters
            $param_phone = trim($_POST["phone"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                        $phone_err = "This Phone No. is already taken.";
                    
                } else{
                    
                    $email_id = trim($_POST["email_id"]);
                    $u_stats = trim($_POST["u_stats"]);
                    $f_name = trim($_POST["f_name"]);
                    $l_name = trim($_POST["l_name"]);
                    $grp = trim($_POST["grp"]);
                    $phone=trim($_POST["phone"]);
                    $city=trim($_POST["city"]);
                    $pin=trim($_POST["pin"]);
                    $state=trim($_POST["state"]);
                    $country=trim($_POST["country"]);
                    $zone=trim($_POST["state"]);
                    $time=trim($_POST["time"]);
                    $vol_type=trim($_POST["vol_type"]);
                    $mob_verification=trim($_POST["mob_verification"]);
                    $country=trim($_POST["country"]);
                    $u_id = trim($_POST["u_id"]);                    
				
					
					
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_id_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user_tbl (u_stats, grp, f_name, l_name, email_id, country, state, city, pin, phone, password, timestamp, mob_verification, vol_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssss", $param_u_stats, $param_grp,  $param_f_name, $param_l_name, $param_email_id, $param_country, $param_state, $param_city, $param_pin, $param_phone,  $param_password,  $param_timestamp, $param_mob_verification, $param_vol_type);
            
            // Set parameters
            $param_u_stats = $u_stats;
            $param_f_name = $f_name;
            $param_l_name = $l_name;
            $param_phone = $phone;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_grp = $grp;
            $param_state = $state;
            $param_country = $country;
            $param_zone = $zone;
            $param_city = $city;
            $param_timestamp = $timestamp;
            $param_pin = $pin;
            $param_vol_type = $vol_type;
            $param_mob_verification = $mob_verification;
            $param_country = $country;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                
                

$to = "$email_id";
$message = "
<html>
<head>
<title>Signup Mail : Welcome To Infovue</title>
</head>
<body>
<p style='text-align: left;'>Hi $f_name,<br />Warm Greetings from Infovue.Thank You for signing up.</p>
<p style='text-align: left;'>Regards</p>
<p style='text-align: left;'>Team Infovue</p>
<p style='text-align: left;'><img src='https://box.ivdata.in/data/img/logo_fin.png' alt='' width='95' height='37' /></p>
<p style='text-align: left;'><a href='http://www.infovue.in'>www.infovue.in<br /></a>+91 62913 90280</p>
</body>
</html>
";
                mail($to,$subject,$message,$headers);
                header("location: index.php?ref=reg_success");
            
                
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
     else{
        
            
        
    }
    // Close connection
    mysqli_close($link);
}


function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuvwxyz";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>

<!DOCTYPE html>
<html>
    <?php include 'core/inc/functions.php'?>
    <?php include 'core/inc/variables.php'?>
<head>
    <title>Signup | Box</title>
    <?php include 'core/inc/header.php'?>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="https://assets.ivdata.in/v2box/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Bootstrap Select Css -->
        <link href="https://assets.ivdata.in/v2box/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="https://assets.ivdata.in/v2box/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="https://assets.ivdata.in/v2box/plugins/animate-css/animate.css" rel="stylesheet" />
     <!-- font -->

    <!-- Custom Css -->
    <link href="https://assets.ivdata.in/v2box/css/style.css" rel="stylesheet">


<style>
*{
    color: rgb(83, 82, 82);
}
body{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-auto-columns: 1fr;
    background-color: white;
    grid-template-areas: "left right";
}

.signup-image{
    height: 60vh;
    margin-bottom: 2em;
    grid-area: right;
    position: fixed;
    right: 10%;
    top: 20%;
}

.left-pan{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    grid-area: left;
}

@media only screen and (max-width:1000px)
{
    body{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-auto-columns: auto;
        grid-template-areas: "left left""right right";
    }
    .right-pan{
        display: none;
    }
}


.logo{
    margin-top: 20px;
}
.card{
    width: 40vw;
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);         
}
@media only screen and (max-width:1000px)
{
    .card{
        width:90vw;
        align-self: center;
        justify-self: center;
        margin: 5px;
}
}

input{
    padding: 1em;
}
.material-icons{
    margin-right: 3px;
    margin-left: 10px;
    color: rgb(105, 105, 105);
    font-size: 1.2em;
}
.btn:not(.btn-link):not(.btn-circle){
        padding: 10px 20px;
}

#sign_up{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-areas: "msg msg""error error""fname lname""email email""country state""district district""city pin""contact contact""pass repass""im im""tos tos""signup signup""login login";
}



@media only screen and (max-width:700px)
{
    #sign_up{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-areas: "msg msg""error error""fname lname""email email""country country""state state""district district""city city""pin pin""contact contact""pass pass""repass repass""im im""tos tos""signup signup""login login";
}
}

.msg{
    grid-area: msg;
    font-size: 1.3em;
    text-align: center;
    margin-bottom:15px;
}
.fname{
    grid-area: fname;
}
.lname{
    grid-area: lname;
}
.email{
    grid-area: email;
}
.country{
    grid-area: country;
}
.state{
    grid-area: state;
}
.city{
    grid-area: city;
}
.pin{
    grid-area: pin;
}
.contact{
    grid-area: contact;
}
.pass{
    grid-area: pass;
}
.repass{
    grid-area: repass;
}
.im{
    grid-area: im;
}
.tos{
    grid-area: tos;
}
.signup{
    grid-area: signup;
}
.login{
    grid-area: login;
}
.error{
    grid-area:error;
    margin-bottom : 15px;
}
.right-pan{
    justify-content: center;
    justify-self: center;
    align-self: center;
}

.btn:not(.btn-link):not(.btn-circle) {
    border-bottom: 1px solid #e7e7e7;
}
.error .material-icons{
    color:red;
    padding:0;
    margin:0px 4px 0px 0px;
    
}

</style>
</head>


    <body>

        <div class="signup-box left-pan">

            <!-- logo -->

            <div class="">
                <img class="logo"src="https://labs.infovue.in/v2box/core/img/logo-infovue2.png" style="width: 18em; margin-bottom: 1em;" alt="">
            </div>

            <!-- login form start -->
            <div class="card">
                <div class="body">
                    
                    <form id="sign_up" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                    
                        <!-- header -->
                        <div class="form-group msg">
                            <label for="terms"><h1><h4>New Here? Sign Up</h4></h1></label>
                        </div>
                    <!-- header end -->
                    
                    <div class="error">
                                            <?php 
                           if($email_id_err !="" || $phone_err !="" || $password_err != "" || $confirm_password_err != "")
                           echo '   <p class="message-mg-rt" style="color:orangered; font-size:13px">
                                    <i class="material-icons">sentiment_very_dissatisfied</i>
                                    Oh snap!'.$email_id_err.' '.$phone_err.' '.$password_err.' '.$confirm_password_err.'!!!
                                        
                                    </p>
                                    '?>
                    </div>



                    
                    

                    <!-- user id -->
                        <input type="text"  name="u_id" id="u_id" value ="10001" maxlength= "7" required hidden/>

                    <!-- user status - pnv by default -->
                        <input type="text"  name="u_stats" id="u_stats" value="pnv" required hidden />

                    <!-- first name -->
                        <div class="input-group fname">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" autofocus class="form-control" name="f_name" id="f_name" placeholder="First Name" onkeypress="return (event.charCode > 64 && 
                                event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" value="<?php echo $_POST["f_name"]?>"required >
                            </div>
                        </div>
                    

                    <!-- last name     -->
                        <div class="input-group lname">
                            <span class="input-group-addon">
                                <i></i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="l_name" id="l_name" placeholder="Last Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" pattern="[a-zA-Z]+" value="<?php echo $_POST["l_name"]?>" required>
                            </div>
                        </div>

                    <!-- email    -->
                        <div class="input-group email"> 
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line <?php echo (!empty($email_id_err)) ? 'has-error' : ''; ?>">
                                <input type="email" class="form-control" name="email_id" id="email_id" placeholder="Email Address" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 47 && event.charCode < 58 ) || event.charCode==46 || event.charCode==64" pattern="[a-zA-Z0-9@.]+" value="<?php echo $_POST["email_id"]?>" required >
                            </div>
                        </div>

                    <!-- country -->
                        <div class="input-group country">
                            <span class="input-group-addon">
                                <i class="material-icons">public</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="country" id="country" placeholder="country" required>
                            </div>
                        </div>
                        
                    <!--state-->
                    
                    <div class="input-group state">
                            <span class="input-group-addon">
                                <i class="material-icons">map</i>
                            </span>
                            <div class="form-line" name="state" required>
                                <select class="form-control">
                                    <option value="" selected>State</option>
                                    <option value="Andaman and Nicobar">Andaman and Nicobar</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Daman & Diu">Daman & Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Ladakh">Ladakh</option>
                                    <option value="Lakshwadeep">Lakshwadeep</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Orissa">Orissa</option>
                                    <option value="Pondicherry">Pondicherry</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                            </div>
                        </div>
                    

                    <!-- city -->
                        <div class="input-group city">
                            <span class="input-group-addon">
                                <i class="material-icons">location_city</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="city" id="city" placeholder="City" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" pattern="[a-zA-Z]+" value="<?php echo $_POST["city"]?>" required>
                            </div>
                        </div>
                    

                    <!-- pin -->
                        <div class="input-group pin">
                            <span class="input-group-addon">
                                <i class="material-icons">place</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106)|| (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" placeholder="Pincode" name="pin" id="pin" class="form-control" maxlength="6" value="<?php echo $_POST["pin"]?>" required>
                            </div>
                        </div>

                    
                    <!-- phone -->
                        
                        <div class="input-group contact">
                            <span class="input-group-addon">
                                <i class="material-icons">phone</i>
                            </span>
                            <div class="form-line <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                                <input type="tel" class="form-control" placeholder="Contact Number" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" name="phone" id="phone"  maxlength="10" minlength="10" pattern="[0-9]+" value="<?php echo $_POST["phone"]?>" required>
                            </div>
                        </div>

                    <!-- password     -->

                        <div class="input-group pass <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" id="password" minlength="8" placeholder="Password" required>
                            </div>
                        </div>


                    <!-- confirm password     -->
                        <div class="input-group repass">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <input id="repass" type="password" class="form-control" name="confirm_password" id="confirm_password" minlength="8" placeholder="Confirm Password" required>
                            </div>
                        </div>


                     <!-- I'm    -->
                        <div class="input-group im">
                            <span class="input-group-addon">
                                <i class="material-icons">accessibility</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control" name="vol_type" required>
                                    <option value="" default>I'm</option>
                                    <option value="student">Studying in College / University</option>
                                    <option value="sales_field">Working in the Sales Field</option>
                                    <option value="business">Interested in Starting a Business</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                        </div>
                    


                    <!-- timestamp -->
                    <input name="timestamp" type="text" id="timestamp" value="<?php date_default_timezone_set("Asia/Calcutta"); echo date("Y/m/d") . "&nbsp;" . date("h:i:sa"); ?>" required hidden>

                    <!-- otp generation -->
                    <input name="mob_verification" type="text" id="mob_verification" value="<?php $rand_otp = mt_rand(100000, 999999); echo $rand_otp; ?>" required hidden>

                    <!-- group -->
                    <input name="grp" type="text" id="grp" value="GRP11" required hidden>
                        
                        
                        <div class="form-group tos">
                            <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                            <label for="terms">I read and agree to the <a href="https://labs.infovue.in/v2box/tos.php">terms of sevices</a>.</label>
                        </div>
    
                        <div class=" form-group signup  align-center">
                            <button class="btn btn-block btn-lg bg-pink waves-effect signup" type="submit">SIGN UP</button>
                        </div>
    
                        <div class="m-t-25 m-b--5 align-center login">
                            <a href="http://labs.infovue.in/v2box/index.html">You already have a Account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="right-pan">
            <img class="signup-image" src="https://labs.infovue.in/v2box/core/img/signup.svg" height="80vh"alt="">
        </div>



        <?php include 'core/inc/footer.php'?>
            <!-- Jquery Core Js -->
    <script src="https://assets.ivdata.in/v2box/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="https://assets.ivdata.in/v2box/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="https://assets.ivdata.in/v2box/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="https://assets.ivdata.in/v2box/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="https://assets.ivdata.in/v2box/js/admin.js"></script>
    <script src="https://assets.ivdata.in/v2box/js/pages/examples/sign-up.js"></script>
</body>

</html>