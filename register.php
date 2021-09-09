
<?php
include ("db.php");
if (isset($_POST["fullname"]))
{
$name = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phoneno'];
$sql_u = "SELECT * FROM users WHERE username='$username'";
$sql_e = "SELECT * FROM users WHERE email='$email'";
$res_u = mysqli_query($connect, $sql_u);
$res_e = mysqli_query($connect, $sql_e);

if (mysqli_num_rows($res_u) > 0) {
    $name_error = "Sorry... username already taken"; 		
}else if(mysqli_num_rows($res_e) > 0){
    $email_error = "Sorry... email already taken"; 	 	
}else{
$query="INSERT INTO users (fullname,gender,email,username,password,phoneno) VALUES ('$name','$gender','$email','$username','$password','$phone')";
$query1="CREATE TABLE `$username` (`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, `title` varchar(100) NOT NULL,`description` varchar(1000) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1; ";
mysqli_query($connect,$query);
mysqli_query($connect,$query1);
$sucess_error = "Success";
}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <!-- Title Page-->
    <title> Register</title>

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
    font-size: 1.1em;
    color: red;
    }
    .success_error{
        color: green;
    font-size: 20px;
    font-style: italic;
    font-weight: bolder;
    }
    
    .register_bottom{
        margin-bottom:25%;
    }
    @media (max-width: 767px) {
  
        
    .register_bottom{
        margin-bottom:0%;
 
}
    
    
    </style>


</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    
                    <form action="register.php" autocomplete="on" method="POST" >
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Fullname" name="fullname" required>
                            
                        </div>
                        <div class="input-group">
                            <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
                                <input class="input--style-3" type="email" placeholder="Email" name="email" value="<?php if (isset($email)){ echo $email; } ?>" autocomplete="off" required>
                                <?php if (isset($email_error)): ?>
      	                        <span><?php echo $email_error; ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="input-group">
                            <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
                                <input class="input--style-3" type="text" placeholder="Username" name="username" value="<?php if (isset($username)){ echo $username; }?>" autocomplete="off" required>
                                <?php if (isset($name_error)): ?>
	  	                        <span> <?php echo $name_error; ?></span>
	                            <?php endif ?>
                            </div>                
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="gender">
                                    <option disabled="disabled" selected="selected">Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-3" type="tel" pattern="[0-9]{10}" placeholder="Phone" name="phoneno">
                        </div>
                        <div class="success_error">
                            <?php if (isset($sucess_error)): ?>
      	                        <span  align="center" style="color:green; font-size:20px"><?php if(isset($_POST['submit'])){ echo $sucess_error;} ?><br></span>
                            <?php endif ?>
                    </div>
                        
                        <div class="p-t-10" align="center">
                            <button class="btn btn--pill btn--green" type="submit">Submit</button>
                            
                        </div>
                    </form>
                    
                    <br>
                        <p class="not_reg" align="center">Already registered!  <a href='login.php'>Login Here</a></p>
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

</body>

</html>

<!-- end document-->
