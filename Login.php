<?php 
$error="";
$uid="";
$pwd="";
$encry_pwd="";
$role="";
$dir="";
require_once("Connection/Connection.php");
session_start(); 
?>
<?php

 if(isset($_SESSION["userId"]))  
 {  
    if($_SESSION['user_role']=="admin"){
        header("location:Admin/index.php"); 
    }else if($_SESSION['user_role']=="staff"){
        header("location:Staff/index.php"); 
    }
       
 } 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uid = $_POST['userId'];
    $pwd = $_POST['password'];
    $encry_pwd = md5($pwd); 

    $quary = "SELECT * FROM users WHERE userId='$uid' AND password= '$encry_pwd'";
    $result=mysqli_query($conn, $quary);
    $user_row = mysqli_fetch_array($result);
    if($user_row){

        $role=$user_row['user_role'];

        $_SESSION['userId'] = $uid;
        $_SESSION['user_role'] = $role;

        
        if ($role =="admin") {
            $dir="admin";
            header("Location: $dir/index.php");
            $error="";
        } else if($role == "staff"){
            $dir="staff";
            header("Location: $dir/employee.php");
            $error="";
        }else{
            $error="Enter valid user id";
        }
    }else{
        $error=" Check your password or user id";
    }
    
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
                        <h1 class="">Sign in</h1>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <form id="login" method="post"  action="">

                                <div class="row" >
                                    <div class="col-md-8 col-12">
                                        <img src="assets/images/bg.svg" style="height: 400px;">

                                    </div>
                                    
                                        <div class="col-md-4 col-12">
                                            <center><img src="assets/images/avatar.svg" width="100px" height="100px"  ></center><br/><br/>
                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">user id</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Id"
                                                        id="first-name-icon" name="userId" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group has-icon-left">
                                                <label for="first-name-icon">password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" placeholder="password"
                                                        id="first-name-icon"  name="password" required>
                                                    <div class="form-control-icon">
                                                        <i class="fa fas fa-lock"></i>
                                                    </div>

                                                </div>
                                            </div>
                                            <a href="change_password.html">Forgot Password?</a><br/><br/>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">login</button>
                                            <button type="submit" class="btn btn-secondary me-1 mb-1">Reset</button>
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