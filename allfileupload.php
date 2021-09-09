<?php
require("auth.php");
include("db.php");
$user= $_SESSION['username'];
$name1= 1;
$username1=  "$user$name1";

$statusMsg = '';
if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){ 
  $title = $_POST['title'];
  $description = $_POST['description'];
  $targetFilePath = 'uploads/'.time().$_FILES['file']['name'];
  $fileName = basename($_FILES["file"]["name"]);

  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    // Allow certain file formats
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $connect->query("INSERT into `$user$name1` (title,description,file_name, uploaded_on) VALUES ('$title','$description','".$targetFilePath."', NOW())");
            if($insert){
                $statusMsg = "<span class=\"text-success\">The file ".$title. " has been uploaded successfully.</span>".header("Refresh:0").""; 
            }else{
                $statusMsg = "<span class=\"text-danger\">File upload failed, please try again.</span>";
            } 
        }else{
            $statusMsg = "<span class=\"text-danger\">Sorry, there was an error uploading your file.</span>";
        }
   
}else{
    $statusMsg = "<span class=\"text-primary\">Please select a file to upload.";
}
 

 if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `$username1` WHERE CONCAT( `title`, `description`) LIKE '%".$valueToSearch."%' ORDER BY id DESC";
    $query1 = "SELECT * FROM `$username1` WHERE CONCAT( `title`, `description`) LIKE '%".$valueToSearch."%' ORDER BY id DESC";
    $result = mysqli_query($connect, $query);
    $result1 = mysqli_query($connect, $query1);
}
 else {
    $query = "SELECT * FROM `$username1` ORDER BY id DESC";
    $query1 = "SELECT * FROM `$username1` ORDER BY id DESC";
    $result = mysqli_query($connect, $query);
    $result1 = mysqli_query($connect, $query1);
}
 ?> 
 

<!DOCTYPE html>
<html>
<title>Files</title>
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
<?php include("nav.php"); ?>
<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
<div class="navbar justify-content-between">
  <a class="display-3 text-white">KEEP NOTES</a>
          <form action="" method="post" class="form-inline">
               <?php  
               $user= $_SESSION['username'];
               $name= 1;
                              /*  Only search option*/
              $query=mysqli_query($connect, "SELECT * FROM `$username1` ORDER BY id DESC");
              echo "<div class=\"d-inline\"><input class=\"form-control d-inline mr-sm-2 \" type=\"text\" name=\"valueToSearch\" placeholder=\"Value To Search\" list='dtlist' aria-label=\"Search\" ></div>";
              echo "<datalist id='dtlist'>";
              while($row=mysqli_fetch_array($query))
              {
                  echo "<option>$row[title]</option>";  
              } 
              while($row=mysqli_fetch_array($query))
              {
              echo "<option>$row[description]</option>"; 
              } 
              echo"</datalist>";  
              echo "<button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\" name=\"search\" value=\"Search\" >";
              echo "<i class=\"fa fa-search\">";echo "</i>";
              echo "</button>";                          
              mysqli_close($connect);
              ?>
          </form>
</div>

     <?php
          $resStr = strtoupper($user); 
          echo "<p class=\"text-center h3 text-white-50\">Welcome <span class=\"text-success font-weight-bolder\">$resStr</span> </p>";

     ?><br>
  <div class="container">
    <div class="row">
        <div class=" "></div>
        <div class="col-md-12 ">
                <article class="card-body">
                  <form action="" method="post" enctype="multipart/form-data" class=" py-3 form-inline">
                       
                    <div class="form-group p-3 ">
                      <input type="text" class="form-control bg-transparent text-white" name="title" placeholder="TITLE" required>
                    </div> <!-- form-group end.// -->
                    
                    <div class=" form-group p-3">
                      <input type="text" class="form-control bg-transparent text-white" name="description" placeholder="TAGS Separated by ' ,  '" required >
                    </div> <!-- form-group end.// -->

                    <div class="text-center">
                      <input type="file" class=" text-white" name="file" capture="camera" required>
                    </div> 

                    <div class="form-group text-center">
                        <button type="submit" name="submit" class="btn btn-primary "> Upload  </button>
                    </div> <!-- form-group// -->   
                    
                  </form>
                  <div class=" form-group text-center">
                      <label><?php  echo $statusMsg;?></label>   
                      
                    </div> <!-- form-group end.// -->
                </article> <!-- card-body end .// -->

        </div>
        <div class=""></div>
    </div>
  </div>
    <br>

    <table class="table">
  <thead>
    <tr>
      <th scope="col" class="text-white h4">Picture</th>
      <th scope="col" class="text-white h4">Files</th>
    </tr>
  </thead>
  <tbody >
    <tr >
      <td>
        <?php
        if(mysqli_num_rows($result) > 1) {
                  while($row1 = mysqli_fetch_array($result)){
                  $img = $row1['file_name'];
                  
                  $image = $row1['file_name'];
                  $title = $row1["title"];
                  $title = ucwords($title);
                  $description = $row1["description"];
                  $description = ucwords($description);
                  $time = $row1["uploaded_on"];
                  $filesize =  filesize($image);
                  $filesize = round( $filesize / 1024 , 2);
        ?>
                      
                      <div class="media my-3 text-white">
                          <?php if (  stristr($image,'.jpg') || stristr($image,'.jpeg') || stristr($image,'.png') == TRUE){?>
                            <img width="100px"  src="<?php echo $image; ?>"  class="align-self-center mr-3" alt="...">
                         
                            <div class="">
                                <h4 class="mt-0"><a href='<?php echo $image;?>'><?php echo $title;?></a></h4>
                                <h6 class="text-info"><?php echo "<span class=\"text-white\">Tags:</span> "; $key=substr( $description, 0, 50 ); if(strlen($description) > 60){ echo " $key..";  }else { echo "$key";} ?></h6>
                                <div class="  align-items-center">
                                    <h6>File Size:
                                    <?php echo "<span class=\"text-info\"> $filesize </span> KB"  ;?></h6>
                                </div>
                                <div class="h6 ">
                                    Create Date:<span class="text-info">
                                    <?php echo  date('d-M-Y', strtotime($time));  ?></span>
                                </div>
                                <a class='wpdm-download-link btn btn-primary' href='<?php echo $image;?>' target="_blank">Download</a>
                                <?php echo "<a class='wpdm-download-link btn btn-primary' href='delete_file.php?id=$row1[id]'>Delete</a>"?>
                            </div>
                            <?php } ?>
                      </div>

          <?php }}else{ echo "<h4 class=\"text-white\">Please Insert Pictures</h4>";}?>
      </td>
      <td>
        <?php
        if(mysqli_num_rows($result1)> 0) {
          while($row = mysqli_fetch_array($result1)){
          $img1 = $row['file_name'];
           
          $image1 = $row['file_name'];
          $title1 = $row["title"];
          $title1 = ucwords($title1);
          $description1 = $row["description"];
          $description1 = ucwords($description1);
          $time1 = $row["uploaded_on"];
          $filesiz1 =  filesize($image1);
          $filesize1 = round( $filesiz1 / 1024 , 2);
          
        ?>
                      <div class="media my-3 text-white" >
                     
                        <?php if (  stristr($image1,'.pdf') || stristr($image1,'.doc') || stristr($image1,'.docx') == TRUE){?>
                          <?php if ( strpos($img1, '.pdf') == TRUE){?>
                            <img width="100px"  src="img/pdf.png"  class="align-self-center mr-3" alt="...">
                          <?php } elseif( strpos($img1, '.doc') || strpos($img1, '.docx') == TRUE){ ?>
                            <img width="100px"  src="img/doc.png"  class="align-self-center mr-3" alt="...">
                          <?php }  ?>
                            
                            <div class="">
                                <h4 class="mt-0"><a href='<?php echo $image1;?>'><?php echo $title1;?></a></h4>
                                <h6 class="text-info"><?php echo "<span class=\"text-white\">Tags:</span> "; $key=substr( $description1, 0, 50 ); if(strlen($description1) > 60){ echo " $key..";  }else { echo "$key";} ?></h6>
                                <div class="  align-items-center">
                                    <h6>File Size:
                                    <?php echo "<span class=\"text-info\"> $filesize1 </span> KB"  ;?></h6>
                                </div>
                                <div class="h6 ">
                                    Create Date:<span class="text-info">
                                    <?php echo  date('d-M-Y', strtotime($time1));  ?></span>
                                </div>
                                <a class='wpdm-download-link btn btn-primary' href='<?php echo $image1;?>' target="_blank">Download</a>
                                <?php echo "<a class='wpdm-download-link btn btn-primary' href='delete_file.php?id=$row[id]'>Delete</a>"?>
                            </div>
                        <?php } ?>
                      </div> 
          <?php }}else{ echo "<h4 class=\"text-white\">Please Insert Files</h4>";}?>
      </td>
   
    </tr>

  </tbody>
</table>

           
  

  
 



  
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


 