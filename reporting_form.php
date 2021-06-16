<!DOCTYPE html>
<html>
<head>

	<title>Daily Journal | Infovue</title>  
	<?php include 'core/inc/header.php'?> 

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
   <?php include 'core/inc/nav.php'?>
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daily Journal Form
                            </h2>
                        </div>
                        <div class="body">
                            <form>
                                

                                <div class="time col-lg-6">
                                    <label for="email">Email Address:</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="email_id" id="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">Date of Reporting:</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="date" id="email" class="form-control" placeholder="Enter">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="time col-lg-6">
                                    <label for="email_address">Starting Time:</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="time" id="" rows="1" cols="10" style="width: 100%;" placeholder="Starting Time"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">Ending Time:</label>
                                    <div class="">
                                        <div class="form-line">
                                            <input type="time" id="" rows="1" cols="10" style="width: 100%;" placeholder="Starting Time"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">Any Meetings you attended today?</label>
                                    <div class="">
                                        <div class="form-line">
                                            <textarea name="" id="" rows="3" cols="100" style="width: 100%;" placeholder="We organize meetings for understanding each other and to clarify if any doubt is there."></textarea>
                                        </div>
                                    </div>
                                </div>



                                <div class="time col-lg-6">
                                    <label for="email_address">Today's Work Description:</label>
                                    <div class="">
                                        <div class="form-line">
                                            <textarea name="" id="" rows="3" cols="100" style="width: 100%;" placeholder="Work done today (Justification to the Hours mentioned above)."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">New Learning, Challenges & Suggestions:</label>
                                    <div class="">
                                        <div class="form-line">
                                            <textarea name="" id="" rows="3" cols="100" style="width: 100%;" placeholder="You are here to learn - by taking up challenges - small and new. If you haven't learnt anything today, it's a day not well spent."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="time col-lg-6">
                                    <label for="email_address">To Do for the next day:</label>
                                    <div class="">
                                        <div class="form-line">
                                            <textarea name="" id="" rows="3" cols="100" style="width: 100%;" placeholder="To Do List for tomorrow (next working day). This should be based on ratification by your coord. Try to pack it with punches."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <center><button type="button" class="btn btn-success  m-t-15 waves-effect">SUBMIT</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include 'core/inc/footer.php'?>
</body>
</html>