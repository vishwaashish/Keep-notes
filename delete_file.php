<?php
include ("db.php");
session_start();
$user= $_SESSION['username']; 
$name1= 1;
$username1=  "$user$name1";
$id=$_GET['id']; 
$query="DELETE FROM $username1 WHERE id='$id'";
$data=mysqli_query($connect, $query);
if($data)
{
    echo 'Successfully delete';
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/notessite1/allfileupload.php">
    <?php
}
else{
    echo 'un Successfully delete';
}

?>