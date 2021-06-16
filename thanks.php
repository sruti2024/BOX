<?php
// Include config file
require_once "core/inc/cnf.php";

// Initialize the session
require_once "core/inc/sessions.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["box"]) || $_SESSION["box"] !== true){
    header("location: index.php");
    exit;
}

	if(!isset($_SESSION["box"]) || $_SESSION["mob_status"] !== done){
    header("location: verify.php");
    exit;
}

function close_window() {
  close();
}

header( "refresh:3;url=dash.php" );


?>


<!doctype html>
<html class="no-js" lang="en">
<?php include 'core/inc/functions.php'?>
<?php include 'core/inc/variables.php'?>
<title>Thanks | BOX </title>
<head>
    <?php include 'core/inc/header.php'?>
    
</head>

    <!-- Header top area start-->
   
      
        <!-- Static Table Start -->
            <div class="static-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline10-list shadow-reset mg-t-30">
                                <div class="sparkline10-graph">
								<br><br><br>
									   <center><h2>Thank You for your Submission</h2>
<h3>Redirecting You to Dashboard....</h3></center><br><br><br>
                                </div>
                            </div>
                        </div>
					</div>
                        
                </div>
            </div>
            <!-- Static Table End -->
        
</div>                  
        
           
    
<?php include 'core/inc/footer.php'?>
</body>

</html>