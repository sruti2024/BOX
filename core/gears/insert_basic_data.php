<?php
$data_id = htmlspecialchars($_GET["data_id"]); 
$u_id = htmlspecialchars($_GET["u_id"]); 
$internship_reason = htmlspecialchars($_GET["internship_reason"]);
$occupation = htmlspecialchars($_GET["occupation"]);
$skills=htmlspecialchars($_GET["skills"]);
$dob = htmlspecialchars($_GET["dob"]); 
$address = htmlspecialchars($_GET["timestamp"]);
$qualification = htmlspecialchars($_GET["qalification"]);
$associate_reason = htmlspecialchars($_GET["associate_reason"]);
$organization = htmlspecialchars($_GET["organization"]);
$id_link = htmlspecialchars($_GET["id_link"]);
$suitable_time = htmlspecialchars($_GET["suitable_time"]);
$cv_link = htmlspecialchars($_GET["cv_link"]);
$photo_link = htmlspecialchars($_GET["photo_link"]);
$tos_accept = htmlspecialchars($_GET["tos_accept"]);
$data_status = htmlspecialchars($_GET["data_status"]);
$data_timestamp = htmlspecialchars($_GET["data_timestamp"]);
$approval_status = htmlspecialchars($_GET["approval_status"]);
$approval_timestamp = htmlspecialchars($_GET["approval_timestamp"]);
$preferred_location = htmlspecialchars($_GET["preferred_location"]);
$preferred_time = htmlspecialchars($_GET["preferred_time"]);
$ph_no = htmlspecialchars($_GET["ph_no"]);
$ref_id = htmlspecialchars($_GET["ref_id"]);
$hobbies = htmlspecialchars($_GET["hobbies"]);
$class_data = htmlspecialchars($_GET["class_data"]);
$type = htmlspecialchars($_GET["type"]);
$ref_name = htmlspecialchars($_GET["ref_name"]);
$available_time = htmlspecialchars($_GET["available_time"]);
$duration_internship = htmlspecialchars($_GET["duration_internship"]);


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "adoreuij_boxv2", "JQYL40MGZ0G6", "adoreuij_boxv2"); 
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$data_id  = mysqli_real_escape_string($link, $_REQUEST['data_id']);
$u_id  = mysqli_real_escape_string($link, $_REQUEST['u_id']);
$internship_reason = mysqli_real_escape_string($link, $_REQUEST['internship_reason']);
$occupation = mysqli_real_escape_string($link, $_REQUEST['occupation']);
$skills = mysqli_real_escape_string($link, $_REQUEST['skills']);
$dob = mysqli_real_escape_string($link, $_REQUEST['dob']);
$address = mysqli_real_escape_string($link, $_REQUEST['address']);
$qualification = mysqli_real_escape_string($link, $_REQUEST['qualification']);
$associate_reason = mysqli_real_escape_string($link, $_REQUEST['associate_reason']);
$organization = mysqli_real_escape_string($link, $_REQUEST['organization']);
$id_link = mysqli_real_escape_string($link, $_REQUEST['id_link']);
$suitable_time = mysqli_real_escape_string($link, $_REQUEST['suitable_time']);
$cv_link = mysqli_real_escape_string($link, $_REQUEST['cv_link']);
$photo_link = mysqli_real_escape_string($link, $_REQUEST['photo_link']);
$tos_accept = mysqli_real_escape_string($link, $_REQUEST['tos_accept']);
$data_status = mysqli_real_escape_string($link, $_REQUEST['data_status']);
$data_timestamp = mysqli_real_escape_string($link, $_REQUEST['data_timestamp']);
$approval_status = mysqli_real_escape_string($link, $_REQUEST['approval_status']);
$approval_timestamp = mysqli_real_escape_string($link, $_REQUEST['approval_timestamp']);
$preferred_location = mysqli_real_escape_string($link, $_REQUEST['preferred_location']);
$preferred_time = mysqli_real_escape_string($link, $_REQUEST['preferred_time']);
$ph_no = mysqli_real_escape_string($link, $_REQUEST['ph_no']);
$ref_id = mysqli_real_escape_string($link, $_REQUEST['ref_id']);
$hobbies = mysqli_real_escape_string($link, $_REQUEST['hobbies']);
$class_data = mysqli_real_escape_string($link, $_REQUEST['class_data']);
$type = mysqli_real_escape_string($link, $_REQUEST['type']);
$ref_name = mysqli_real_escape_string($link, $_REQUEST['ref_name']);
$available_time = mysqli_real_escape_string($link, $_REQUEST['available_time']);
$duration_internship = mysqli_real_escape_string($link, $_REQUEST['duration_internship']);

$username = "adoreuij_boxv2"; 
$password = "JQYL40MGZ0G6"; 
$database = "adoreuij_boxv2"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$sql50="SELECT COUNT(*) AS COUNT FROM basicdata_tbl where u_id='$u_id'";
$sql51="SELECT data_status,photo_status FROM basicdata_tbl where u_id='$u_id'";
if ($result = $mysqli->query($sql50)) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                $field50name = $row["COUNT"];
                                                                }
                                                                 $result->free();
                                                                }

$sql51="SELECT data_status,photo_status FROM basicdata_tbl where u_id='$u_id'";
if ($result = $mysqli->query($sql51)) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                $field51name = $row["data_status"];
                                                                $field52name = $row["photo_status"];
                                                                }
                                                                 $result->free();
                                                                }
if($field51name==part_filled_id)
{
    $_SESSION["id_status"] = 'done';
}
if($field52name==photo_filled)
{
    $_SESSION["pic_status"] = 'done';
}
if($field50name == 0)
{// Attempt insert query execution
$sql = "INSERT INTO basicdata_tbl (`data_id`, `u_id`, `dob`, `address`, `qualification`, `associate_reason`, `organization`, `id_link`, `suitable_time`, `cv_link`, `photo_link`, `tos_accept`, `data_status`, `data_timestamp`, `approval_status`, `approval_timestamp`, `preferred_location`, `preferred_time`, `ph_no`, `ref_id`, `class_data`, `hobbies`,`internship_reason`, `occupation`, `available_time`, `duration_internship`, `work`, `skills`,`ref_name`, type) VALUES ('$data_id', '$u_id', '$dob', '$address', '$qualification', '$associate_reason', '$organization', 'id.jpg', '$suitable_time', '$cv_link', 'user.png', '$tos_accept', '$data_status', '$data_timestamp', '$approval_status', '$approval_timestamp', '$preferred_location', '$preferred_time', '$ph_no', '$ref_id', '$class_data', '$hobbies','$internship_reason','$occupation','$available_time','$duration_internship', '$work', '$skills', '$ref_name', '$type')";
}
else{
$sql= "UPDATE basicdata_tbl SET data_status='$field51name',`photo_status`='$field52name' WHERE u_id='$u_id'";
}
$sql2="UPDATE `user_tbl` SET basic_status='done'  WHERE u_id='$u_id'";
if(mysqli_query($link, $sql)){
    if(mysqli_query($link, $sql2)){
    $_SESSION["basic_status"] = 'done';
    header("location: /v2box/thanks.php");
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>