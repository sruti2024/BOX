<?php
// Include config file
require_once 'core/inc/cnf.php';

// Initialize the session
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
if ($link_session === false) {
    die('ERROR: Could not connect. ' . mysqli_connect_error());
}

$u_id = $_SESSION['u_id'];
$f_name = $_SESSION['f_name'];
$l_name = $_SESSION['l_name'];
date_default_timezone_set('Asia/Calcutta');
$date_session = date('d/m/Y');
$time_session = date('h:i:sa');
$page_name = basename($_SERVER['PHP_SELF']);

// Attempt insert query execution
$sql_session = "INSERT INTO sessions_tbl (`u_id`, `f_name`, `l_name`, `time`, `date`, `page`) VALUES ('$u_id', '$f_name', '$l_name', '$time_session', '$date_session' , '$page_name')";
if (mysqli_query($link_session, $sql_session)) {
    '';
} else {
    '';
}

// Close connection
mysqli_close($link_session);
$ref_url = $_SERVER['REQUEST_URI'];
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION['box']) || $_SESSION['box'] !== true) {
    header('location: index.php?url=' . $ref_url . '');
    exit();
}
?>

<!DOCTYPE html>
<html>
<?php include 'core/inc/functions.php'; ?>
<?php include 'core/inc/variables.php'; ?>
<head>

	<title>Basic Details | Profile | Box</title>  
	<?php include 'core/inc/header.php'; ?> 

    <style>
        label{
            font-weight: 700;
        }
        .bootstrap-select {
            border:none;
            border: 1px solid red;
        }
        textarea{
            border: 1.5px solid #ddd;
            border-radius: 5px;
            resize:none;
        }
        .form-line{
            margin: 15px auto;
        }
        input{
            padding: 5px auto;
        }

    </style>

</head>
<body class="theme-blue">
   <?php include 'core/inc/nav.php'; ?>
   
   
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Basic Details Form
                            </h2>
                        </div>
                        <div class="body">
                            <form role="form" action="core/gears/insert_basic_data.php" method="post">
                                

                            <input type="text" placeholder="User ID" id="u_id" name="u_id" value="<?php echo htmlspecialchars(
                                $_SESSION['u_id']
                            ); ?>" required readonly hidden>

                                <div class="time col-lg-6">
                                    <label for="email">Date of Birth</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="date" id="email" class="form-control" id="dob" name="dob" required >
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">Alternative Phone No.</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="text" id="ph_no" name="ph_no" class="form-control" placeholder="Alternate Phone No."  required >
                                        </div>
                                    </div>
                                </div>
                                
                                    
                                <div class="time col-lg-6">
                                    <label for="email_address">Skills / Talents</label>
                                    <div class="">
                                        <div class="form-line">
                                            <textarea id="skills" name="skills" rows="3" cols="40" style="width: 100%;over-flow:flow"placeholder="Your Skills or Talents" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">Current Address</label>
                                    <div class="">
                                        <div class="form-line">
                                            <textarea id="address" name="address" rows="3" cols="40" style="width: 100%;"placeholder="Current Address" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                    
                                 <div class="time col-lg-6">
                                    <label for="email_address">Hobbies</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="text" id="hobies" name="hobbies" class="form-control" placeholder="Your Hobbies" required>
                                        </div>
                                    </div>
                                </div>



                                <div class="time col-lg-6">
                                    <label for="email_address">Qualificaton / Educational Details</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="text" id="qualification" name="qualification" required class="form-control" placeholder="Highest Exam Passed">
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">Current / Last Organisation name</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="text" id="organization" name="organization" required class="form-control" placeholder="Enter">
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">Occupation</label>
                                    <div class="">
                                        <div class="form-line">
                                                <select class="form-control show-tick" id="occupation" name="occupation">
                                                                                    <option value="">Please select</option>
                                                                                    <option data-tokens="Student">Student</option>
                                                                                    <option data-tokens="Employed">Employed</option>
                                                                                    <option data-tokens="Self-employed">Self-employed</option>
                                                                                    <option data-tokens="Retired">Retired</option>
                                                                                    <option data-tokens="Gap Year">Gap Year</option>
                                                                                    <option data-tokens="Others">Others</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>




                                <div class="domain col-lg-6" >
                                    <label for="email_address">Prefered internship domain</label>
                                    <div class="select">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="associate_reason" name="associate_reason" multiple required>
                                                <option data-tokens="Web Development">Web Development</option>
																					<option data-tokens="Data Management & Data Prediction">Data Management & Data Prediction</option>
																					<option data-tokens="Business Development">Business Development</option>
																					<option data-tokens="Digital Marketing">Digital Marketing</option>
																					<option data-tokens="Social Activities Management">Social Activities Management</option>  
																					<option data-tokens="Market Research">Market Research</option> 
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">Time available for internship</label>
                                    <div class="">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="available_time" name="available_time" required tab-index="-1">
                                                <option value="35-45 Hours a week">35-45 hrs a week</option>
                                                <option value="25-35 Hours a Week">25-35 hrs a Week</option>
                                                <option value="15-25 Hours a week">15-25 hrs a week</option> 
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="duration col-lg-6">
                                    <label for="email_address">Duration of internship</label>
                                    <div class="">
                                        <div class="form-line">
                                    
                                    <select class="form-control show-tick" id="duration_internship" name="duration_internship" required tab-index="-1">
                                    <option value="6 Months or Above">6 Months or Above</option>
                                    <option value="4 - 6 Months">4 - 6 Months</option>
                                    <option value="3 - 4 Months">3 - 4 Months</option>
                                    <option value="Others">Others</option>
                                    </select>     
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="type col-lg-6">
                                    <label for="email_address">Type of internship</label>
                                    <div class="">
                                        <div class="form-line">
                                            
                                <select class="form-control show-tick" id="type" name="type" required tab-index="-1">
                                 
                                    <option value="Unpaid">Unpaid Internship</option>
                                   
                                    
                                </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="ref-person col-lg-6">
                                    <label for="email_address">Name of the person you are in contact with Adore / Infovue</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="text" id="ref_name" name="ref_name" class="form-control" placeholder="Person's name">
                                        </div>
                                    </div>
                                </div>

                                <div class="ref-id col-lg-6">
                                    
                                <label for="email_address">Reference ID</label>
                                <div class="">
                                    <div class="form-line">
                                        <input type="text" id="ref_id" name="ref_id" class="form-control" placeholder="Name, Phone">
                                    </div>
                                </div>
                                </div>

                                <div class="reason col-lg-12">
                                    <label for="email_address">Why do you want to do this internship?</label>
                                    <div class="">
                                        <div class="form-line">
                                            <textarea name="internship_reason" id="internship_reason" rows="3" cols="40" style="width: 100%;"placeholder="Why do you want to do this internship?(Give Detailed Answer)"></textarea>
                                        </div>
                                    </div>
                                </div>
                                


                                <br>


                                <input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-red" checked />
                                <label for="md_checkbox_21">I hereby declare that all details given are correct.</label>								
                                <input name="data_timestamp" type="text" id="data_timestamp" value="" required readonly hidden>	
                                <center><button type="submit" class="btn btn-success  m-t-15 waves-effect">SUBMIT</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include 'core/inc/footer.php'; ?>
</body>
</html>