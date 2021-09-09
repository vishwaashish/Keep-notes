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
<title>Home</title>
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
.border-0 {
    border: 0!important;
}



@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>
<body class="">

<?php include("nav.php") ?>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
<div class="navbar justify-content-between text-center">
  <a class="display-3 text-white">KEEP NOTES</a>
          <form action="" method="post" class="form-inline">
               <?php  
                              /*  Only search option*/
              $query=mysqli_query($connect, "SELECT * FROM `register` ORDER BY id DESC");
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
  <header class=" text-left d-inline" id="home">
    
          
  </header>
     <?php
          $resStr = strtoupper($user); 
          $one= 1;
          
          echo "<p class=\"text-center h3 text-white-50\">Welcome <span class=\"text-success font-weight-bolder\">$resStr$one</span> </p>";

     ?><br>
  <div class="container">
    <div class="row">
        <div class="col "></div>
        <div class="col-md-8 ">
            <form method="post" id="insert_form"> 
             
                <div class="input-group-lg ">
                <input type="text" name="title" id="title" placeholder="TITLE" class="  form-control w3-black border-1" />  
                </div>   
                <div class="input-group-lg border-0 ">
                <textarea name="description" id="description" placeholder="DESCRIPTION" class="form-control w3-black border-1" style="height: 170px;"></textarea>  
                </div> <br />  
    
                <input type="hidden" name="employee_id" id="employee_id" />  
                <div class="text-center">
                <input type="submit" name="insert" id="insert" value="Insert"  class="btn btn-info form-control px-3" />
                </div>
            </form> 

        </div>
        <div class="col "></div>
    </div>
  </div>
    <br>
           
                
                     <div id="employee_table">  
                          <table class="table h4 text-white">  
                               <tr class="thead-dark">   
                                    <th scope="col" width="30%">Title</th>
                                    <th scope="col" >Description</th>   
                                    <th width="5%">Edit</th>  
                                    <th width="5%">View</th> 
                                    <th width="5%">Delete</th>  
                               </tr>  
                               <?php  
                               while($row = mysqli_fetch_array($result))  
                               {  
                               ?>  
                                <tr>  
                                    <td><?php echo $row["title"]; ?></td>  
                                    <td><?php echo $row['description']; ?></td>
                                    
                                    
                                    <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data " /></td>  
                                    <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td> 
                                    <td><?php echo " <p class=\"text-center\"><a href='delete.php?id=$row[id]' <i  class='fa fa-trash ' style=\"font-size:20px\"></a></p>"?></td>  
                                </tr>  
                               <?php  
                               }  
                               ?>  
                          </table>  
                     </div>  
  </div>  
  
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog ">  
           <div class="modal-content">  
                <div class="modal-header bg-dark">  
                 <h4 class="modal-title">View</h4>  
                </div>  
                <div class="modal-body bg-dark" id="employee_detail">  
                </div>  
                <div class="modal-footer bg-dark">  
                     <button type="button" class="btn btn-default bg-dark text-white" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  





  
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


 
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"update.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#title').val(data.title);  
                     $('#description').val(data.description);  
                     $('#employee_id').val(data.id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#title').val() == "")  
           {  
                alert("title is required");  
           }  
           else if($('#description').val() == '')  
           {  
                alert("description is required");  
           }  
           else  
           {  
                $.ajax({  
                     url:"insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#employee_table').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var employee_id = $(this).attr("id");  
           if(employee_id != '')  
           {  
                $.ajax({  
                     url:"select.php",  
                     method:"POST",  
                     data:{employee_id:employee_id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  
 </script>
 
 