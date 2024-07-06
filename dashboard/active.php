<?php

include("../connection.php");

$id = $_GET['id'];
$status = $_GET['status'];
if($status == 'Pending'){
    
    $update = "UPDATE complaints SET Status='Processing' WHERE id='$id'";
    mysqli_query($conn,$update);
    header('location:./index.php');

}else{
    
    $update = "UPDATE complaints SET Status='Completed' where id ='$id' ";
    mysqli_query($conn,$update);
    header('location:./index.php');
}




?>