
<?php


require('db.php');
session_start();

error_reporting(0);
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($connect,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($connect,$password);
 
 //Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='$password' ";
 $result = mysqli_query($connect,$query) or die(mysql_error());
 $rows = mysqli_num_rows($result);
        if($rows==1){
     $_SESSION['username'] = $username;
     $_SESSION['email'] = $email;
     
            // Redirect user to index.php
     header("Location: index.php");
         }else{
    $name_error1 = "Username or Password is incorrect";  
 }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" connecttent="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <!-- Title Page-->
    <title>Login</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <style>
    .form_error span {
    width: 80%;
    height: 40px;
    margin: 3px 0;
    font-size: 14px;
    color: red;
    }
    .register_top{
        margin-top:40%;
    }
    .register_bottom{
        margin-bottom:40%;
    }
    @media (max-width: 767px) {
  
        .register_top{
        margin-top:0%;
    }
    .register_bottom{
        margin-bottom:0%;
 
}
.form_error {
    width: 80%;
    height: 40px;
    margin: 3px 0;
    font-size: 1.1em;
    color: red;
    }
.error_space{
    margin-top:25px;
}

    .not_reg{
        color:white;

    }
    </style>


</head>
<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                <div class="register_top">
                </div>
                    <h2 class="title">Login</h2>
                    
                    <form action="" method="POST">
                        
                        <div class="input-group">
                           
                            <input class="input--style-3" type="text" placeholder="Username" name="username" required>
                                               
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password" required>
                        </div>
                        <div>
                            <div class="form_error" <?php if (isset($name_error1)): ?> <?php endif ?> >
	  	                        <span> <?php echo $name_error1; ?></span>
                            </div>
                        </div><br>
                        <div class="p-t-10" align="center">
                            <button class="btn btn--pill btn--green" value="Login" type="submit">Login</button>
                        </div>
                        
                    </form>
                    <br>
                    
                    <br>
                        <p class="not_reg" align="center">Not registered!  <a href='register.php'>Register Here</a></p>
                    <div class="register_bottom"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
