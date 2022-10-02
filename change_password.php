
<?php 


$otp="";
$email="";
require_once("Connection/Connection.php");
session_start(); 

///////// send email function

if (isset($_POST['emailSend'])) {
    $randOtp=rand(10,10000);
    $email=$_POST["email"];
    
    $quary = "SELECT * FROM users WHERE email='$email'";
    $result=mysqli_query($conn, $quary);
    $user_row = mysqli_fetch_array($result);
    if($user_row){

        /////////////////////////////////////////////
//      email send
        
        $msg = "dear madam/sir,\n OTP - $randOtp";

        $msg = wordwrap($msg,70);
        $header = 'From: sms.prathibha@gmail.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type: text/html; charset=utf-8';
       

        if(mail("$email","LMS Forget Password OTP",$msg,$header)){
            echo 'email sent';
        }else{
            echo 'error email';
        }
        
        //////////////////////////////////////////

        /////////////////////////////////////////
//      save to db        

        $emailCheckQuary = "SELECT * FROM otp WHERE email_id='$email'";
        $emailCheckResult=mysqli_query($conn, $emailCheckQuary);
        $email_row = mysqli_fetch_array($emailCheckResult);
        if($email_row){
            $otpQuary="UPDATE otp SET otp=$randOtp where email_id='$email'";
            if (mysqli_query($conn, $otpQuary)) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . mysqli_error($conn);
              }
        }
        else{
            $otpQuary="INSERT INTO otp ( email_id, otp) VALUES('$email',$randOtp) ";
            if (mysqli_query($conn, $otpQuary)) {
                echo "Record inserted successfully";
              } else {
                echo "Error inserting record: " . mysqli_error($conn);
              }
        }
        ///////////////////////////////////////
    }

}

/////// check otp and redirect change password

if(isset($_POST['otpBtn'])){
    $otp=$_POST["otp"];
    
    $otpQuary= "SELECT * from otp where otp= $otp";
    $otpResult= mysqli_query($conn,$otpQuary);
    $otp_Raw=mysqli_fetch_array($otpResult);
    if($otp_Raw){
        Header("Location: updat_password.php?email_id=".$otp_Raw['email_id']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>password change</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <script defer src="assets/js/login.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/app.css">
    <style type="text/css">
        .notif:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body style="background-color: #f7faff;">
        
    
    <div class="row" style="height: 120px;"></div>
    <div class=" container">
        <section id="multiple-column-form">
            <div class="row match-height">


                <div class="col-lg-12">
                <div class="card ">
                    <div class="card-header" >
                        <h1 class="">foget password</h1>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <form id="login" method="post"  action="">

                                <div class="row" >
                                    <div class="col-md-8 col-12">
                                        <img src="assets/images/bgt.svg" style="height: 400px;">

                                    </div>

                                    <div class="col-md-4 col-12">
                                        <center><img src="assets/images/avatar.svg" width="100px" height="100px"  ></center><br/><br/>
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">email</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="email"
                                                    id="first-name-icon" name="email" require>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="emailSend" class="btn btn-primary me-1 mb-1">send</button>
                                        <button type="submit" class="btn btn-secondary me-1 mb-1">Reset</button>

                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">OTP</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="OTP"
                                                    id="first-name-icon" name="otp" require>
                                                <div class="form-control-icon">
                                                    <i class="fa fas fa-lock"></i>
                                                </div>

                                            </div>
                                        </div>
                                        
                                        <button type="submit" name="otpBtn" class="btn btn-primary me-1 mb-1">confirm</button>
                                        

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </div>
</body>


</html>