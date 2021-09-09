<?php
include ("db.php");
session_start();
$user= $_SESSION['username']; 
$id=$_GET['id']; 
$query="DELETE FROM $user WHERE id='$id'";
$data=mysqli_query($connect, $query);
if($data)
{
    echo 'Successfully delete';
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/notessite/home.php">
    <?php
}
else{
    echo 'un Successfully delete';
}

?>