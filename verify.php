<?php
// Include config file
require_once "core/inc/cnf.php";
// Initialize the session
# Session lifetime of 3 hours
ini_set('session.gc_maxlifetime', 86400);
session_set_cookie_params(86400);
# Enable session garbage collection with a .01% chance of
# running on each session_start()
ini_set('session.gc_probability', 0);
ini_set('session.gc_divisor', 100);
# Start the session
session_start();
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link_session = $link; 
// Check connection
if($link_session === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$u_id  = $_SESSION["u_id"];
$f_name  = $_SESSION["f_name"];
$l_name  = $_SESSION["l_name"];
date_default_timezone_set("Asia/Calcutta");
$date_session = date("d/m/Y");
$time_session = date("h:i:sa");
$page_name = basename($_SERVER['PHP_SELF']);
// Attempt insert query execution
$sql_session = "INSERT INTO sessions_tbl (`u_id`, `f_name`, `l_name`, `time`, `date`, `page`) VALUES ('$u_id', '$f_name', '$l_name', '$time_session', '$date_session' , '$page_name')";
if(mysqli_query($link_session, $sql_session)){
   "";
} else{
    "";
}
// Close connection
mysqli_close($link_session);
$ref_url = $_SERVER['REQUEST_URI'];
$phone = $_SESSION["phone"];
$link = mysqli_connect("localhost", "adoreuij_boxv2", "JQYL40MGZ0G6", "adoreuij_boxv2");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Escape user inputs for security
$u_id = $_SESSION["u_id"];
$sql3 = "SELECT `mob_verification` FROM `user_tbl` WHERE `u_id` = '$u_id'";
$result = mysqli_query($link, $sql3);
if(mysqli_query($link, $sql3)){
if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               $mob_verify =  $row["mob_verification"];
             }
         } 
}
$to = "";
$subject = "Mobile Verification Code || Infovue";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Infovue <care@infovue.in>' . "\r\n";
$headers .= 'Bcc: sky@infovue.in' . "\r\n";
$email_id=$_SESSION["email_id"];
$to = "$email_id";
$message = "
<html>
<head>
<title>Mobile Verification Code</title>
</head>
<body>
<p style='text-align: left;'>Hi $f_name,<br />Warm Greetings from Infovue.Thank You for signing up.</p>
<p style='text-align: left;'><br />Your Verification Code is: $mob_verify </p>
<p style='text-align: left;'>Regards</p>
<p style='text-align: left;'>Team Infovue</p>
</body>
</html>
<html>
<head>
<title>Signup Mail : Welcome To Infovue</title>
</head>
<body>
</body>
</html>
";
mail($to,$subject,$message,$headers);
// Account details
	$apiKey = urlencode('fX3Ht8k51/k-Jp301nq415xrruTKOCEKgUGXzynpuW');
	// Message details
	$numbers = array($phone);
	$sender = urlencode('GARIND');
	$message = rawurlencode('Your Verification code for Infovue is '.$mob_verify.'. This Code is valid for 30 minutes.');
	$numbers = implode(',', $numbers);
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
?>

<!DOCTYPE html>
<html>
<?php include 'core/inc/functions.php'?>
<?php include 'core/inc/variables.php'?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Verification | Box</title>
    <!-- Favicon-->
    <link rel="icon" href="http://assets.ivdata.in/v2box/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap Core Css -->
    <link href="http://assets.ivdata.in/v2box/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="http://assets.ivdata.in/v2box/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="http://assets.ivdata.in/v2box/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="http://assets.ivdata.in/v2box/css/style.css" rel="stylesheet">
<script>
$(document).ready(function(){
	// File upload via Ajax
	$("#sign_in").on('submit', function(e){
		e.preventDefault();
		$.ajax({
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						var percentComplete = Math.round((evt.loaded / evt.total) * 100);
						$(".progress-bar").width(percentComplete + '%');
						$(".progress-bar").html(percentComplete+'%');
					}
			   }, false);
			   return xhr;
			},
			type: 'POST',
			url: 'core/gears/otp_verify.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){
				$(".progress-bar").width('0%');
				$('#uploadStatus').html('<img src="https://owl.nethuts.in/labs/images/loading.gif"/>');
			},
			error:function(){
				$('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
			},
			success: function(response){
				if(response == 'ok'){
					$('#uploadForm')[0].reset();
				    $("#submit").prop('disabled', true); // disable button
					$('#uploadStatus').html('<span style="color:#28A74B;">File has uploaded successfully!</span>'+ response);
					$('#formbox').html('');
				}else if(response == 'err'){
					$('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>'+ response);
				}
			}
		});
	});
});
</script>
<style>
    html{

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
    overflow-y: hidden; 
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
    width: 400px;
    height: 350px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.card input{
    padding: 5px;
    width: auto;
    height: auto;
    font-size: 20px;
    text-align: center;
    letter-spacing: 10px;
    margin-top: 30px;
    font-weight: 700;
}
.left-pan img{
    height: 80vh;
}
.msg{
    margin-bottom: 1em;
}
.btn{
    width: 100px;
}


@media only screen and (max-width:800px){
    html{
        height: 100%;
        background: none;
    }
    .container{
        border-radius: 20px;
        height: auto;
        overflow-y: visible;
        width:auto;
        display: grid;
        grid-auto-rows: auto auto;
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
        width: 320px;
        height: 320px;
    }
    .card input{
        padding: auto;
    }
    .left-pan img{
        height: 250px;
    }
}
</style>
</head>
<body class="container" style="margin-top:10px;  ">

    <div class="right left-pan">
        <img class="signup-image" src="https://labs.infovue.in/v2box/core/img/email.png"  alt="">
    </div>

    <div class="login-box  left right-pan" >


       <div class="card">
            <div class="body">
                <div id="formbox">
                <form id="sign_in" >
                    <center><img src="https://labs.infovue.in/v2box/core/img/logo-infovue2.png" style="width: 13em; margin-bottom: 1em;" alt=""></center>
                    <div>
                        <center><h5>OTP is sent to your mail and mobile number</h5></center>
                        
                    </div>
                    <!-- <center><div class="msg"><h4>Login</h4></div></center> -->

                    <div class="input-group" class="otp-input">
                            <input id="otp" name="otp" type="tel" placeholder="******" required minlength='6' maxlength="6" autofocus>
                    </div>

                    <input name="u_id" type="u_id" autofocus="" value ="<?php echo ''.$_SESSION["u_id"].'' ?>" maxlength= "7" required hidden>
                                
                    <input name="time" type="text" id="time" value="<?php date_default_timezone_set("Asia/Calcutta"); echo date("Y/m/d") . "&nbsp;" . date("h:i:sa"); ?>" required hidden>

                    <div class="row">

                           <center> <input type="submit" name="submit" id="submit" value="Verify"/></center>
                  
                    </div>
                </form>
</div>
 <!-- Display upload status -->
<div id="uploadStatus"></div>
</div>
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
    <?php include 'core/inc/footer.php'?>
</body>

</html>