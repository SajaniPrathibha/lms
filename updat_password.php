<?php 
$error="";
$uid="";
$pwd="";
$encry_pwd="";
$role="";
$dir="";
$npw="";
$cnpw="";
require_once("Connection/Connection.php");
session_start(); 
$email_id=$_REQUEST['email_id'];

?>
<?php 
// if(isset($_SESSION["userId"]))  
// {  
//    if($_SESSION['user_role']=="admin"){
//        header("location:Admin/index.php"); 
//    }else if($_SESSION['user_role']=="staff"){
//        header("location:Staff/index.php"); 
//    }
      
// } 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userQuary="SELECT * from users where email='$email_id'";
    $idResult= mysqli_query($conn,$userQuary);
    $user_Raw=mysqli_fetch_array($idResult);
    if($user_Raw){
        
        $uid=$user_Raw['userId'];
        $role=$user_Raw['user_role'];

    $npw = $_POST['newPassword'];
    $cnpw = $_POST['confermPassword'];

    if($npw == $cnpw){
        $encry_pwd = md5($npw);
        $quary="UPDATE users SET password='$encry_pwd'  where userId ='$uid'";
        if (mysqli_query($conn, $quary)) {

            Header("Location: Login.php");

          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }

    }else{
        $error="Please Enter Same password in new and confirm password field";
        //echo "\n Please Enter Same password in new and confirm password fields";
    }
}

// UPDATE users SET password=$npw  where userId =$uid;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Form</title>
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
                        <h1 class="">Change passsword</h1>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" id="change_password"  method="post"  action="" >

                                <div class="row" >
                                    <div class="col-md-8 col-12">
                                        <img src="assets/images/change.svg" style="height: 400px;">

                                    </div>

                                    <div class="col-md-4 col-12">
                                        <center><img src="assets/images/avatar.svg" width="100px" height="100px"  ></center>


                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">new password</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control" placeholder="new password"
                                                    id="first-name-icon" name="newPassword" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fas fa-lock"></i>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">conferm password</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control" placeholder="conferm password"
                                                    id="first-name-icon" name="confermPassword" required>
                                                <div class="form-control-icon">
                                                    <i class="fa fas fa-lock"></i>
                                                </div>

                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary me-1 mb-1">login</button>
                                        <button type="reset" class="btn btn-secondary me-1 mb-1">Reset</button>
                                        <small style="color: red;"><?php echo $error;?></small>
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