  
   
<?php  
 include ("auth.php");
 include ("db.php");
 
 $user= $_SESSION['username'];

 if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `$user` WHERE CONCAT( `title`, `description`) LIKE '%".$valueToSearch."%' ORDER BY id DESC";
    $result = mysqli_query($connect, $query);
}
 else {
    $query = "SELECT * FROM `$user` ORDER BY id DESC";
    $result = mysqli_query($connect, $query);
}
 ?> 
 

<!DOCTYPE html>
<html>
<title>Contact</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<!-- Webpage Icon -->
<link rel="shortcut icon" type="image/x-icon" href="img/logo.PNG" /> 
<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
body {
    background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url(img/Contact3.jpg);
    background-size: cover;
}
.w3-row-padding img {margin-bottom: 12px}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 120px;background: #222;}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 120px}
/* Remove margins from "page content" on small screens */
.borderless table {
    border-top-style: none;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
}

.bigger_input {
  transition-property: height;
  transition-duration: 1s;
  transition-timing-function: linear;
  transition-delay: 0.5s;
}
.bigger_input:hover{
     height:50px;
}



@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>
<body class="">

<?php include("nav.php") ?>

  <!-- Contact Section -->
    <div class="w3-padding-large text-white" id="main">
     <header class="  w3-text-grey" id="contact">
     <h2 class="w3-text-light-grey">Contact Me</h2>
     <hr style="width:200px" class="w3-opacity">
     </header>
     <div class="w3-section text-white">
      <p><i class="fa fa-map-marker fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> Mumbai, India</p>
      <p><i class="fa fa-phone fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> Phone: 91 8424847449</p>
      <p><i class="fa fa-envelope fa-fw w3-text-white w3-xxlarge w3-margin-right"> </i> Email: technotaughts@gmail.com</p>
     </div><br>
    <p>Lets get in touch. Send me a message:</p>
    <form action="" method="POST">
      <p><input class="w3-input w3-padding-16 text-dark" type="message" placeholder="Message" name="message" required></p>
      <p>
        <button class="w3-button w3-light-grey w3-padding-large" type="submit">
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </p>
    </form>
  <!-- End Contact Section -->
    </div>
<?php

include('db.php');
error_reporting(0);
$query="SELECT * FROM users";
$sql=mysqli_query($connect,$query);
$row=mysqli_fetch_array($sql);
$fullname=$row['fullname'];
$email= $row['email'];
$message = $_POST['message'];
$trn_date = date("y-m-d H:i:s");
if( !empty($message))
{
$sql1="INSERT INTO contact(fullname,email,message,trn_date) VALUES ('$fullname','$email','$message','$trn_date')";
$data=mysqli_query($connect,$sql1);
echo "<script type='text/javascript'> onload = function(){alert('Message send.');}</script>";
?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/notessite1/contact.php">
<?php
}
?>   
    <!-- Footer -->
    <div class="w3-padding-large text-center fixed-bottom">
  <footer class="w3-content w3-text-grey w3-xlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
    <p class="w3-medium">Powered by <a href="#" target="_blank" class="w3-hover-text-green">technotaught</a></p>
  <!-- End footer -->
  </footer>
  

<!-- END PAGE CONTENT -->

</body>
</html>