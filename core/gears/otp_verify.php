<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["box"]) || $_SESSION["box"] !== true){
    header("location: index.php");
    exit;
}

$u_id = $_SESSION["u_id"];

$otp = htmlspecialchars($_GET["otp"]); 

$otp_new = mt_rand(100000, 999999);


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "adoreuij_boxv2", "JQYL40MGZ0G6", "adoreuij_boxv2"); 

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Escape user inputs for security
$otp  = mysqli_real_escape_string($link, $_REQUEST['otp']);

$sql3 = "SELECT `mob_verification` FROM `user_tbl` WHERE `u_id` = '$u_id'";
$result = mysqli_query($link, $sql3);
if(mysqli_query($link, $sql3)){
if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               $mob_verification =  $row["mob_verification"];
             }
         } 
}

if($otp == $mob_verification){
    
// Attempt insert query execution
$sql = "UPDATE `user_tbl` SET `mob_status` = 'done', `u_stats` = 'progressive' WHERE `u_id` = '$u_id'";
if(mysqli_query($link, $sql)){
    $_SESSION["mob_status"] = 'done';
    header("location: ../../dash.php");
    
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

}

else {
    $sql2 = "UPDATE `user_tbl` SET `mob_verification` = '$otp_new' WHERE `u_id` = '$u_id'";
    if(mysqli_query($link, $sql2)){
    $_SESSION["mob_status"] = 'void';
    header("location: ../../verify.php?verification=false");
    
}
    
}
// Close connection
mysqli_close($link);

?>