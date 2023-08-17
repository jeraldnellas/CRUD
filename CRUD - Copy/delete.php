<?php
include_once "db/db_con.php";
session_start();
$id =   $_SESSION['user_id'];
if(!isset($id)){
    header('location: login.php');
    exit(); // Always exit after a redirect
}

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $delete = "DELETE FROM `data entry` WHERE id = '$id'";
    $result = mysqli_query($con, $delete);
    header('location:index.php');
    
}
mysqli_close($con);

if($query_run){
    echo "Deleted Successfully";
    exit(0);
}else{
    echo "Not Deleted";
    exit(0);
}
?>