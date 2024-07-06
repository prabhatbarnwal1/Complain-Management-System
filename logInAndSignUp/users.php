<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

include("../connection.php");

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$desn = $_POST['designation'];
$pass = $_POST['password'];
$sql = "INSERT INTO `users` (`Sl`, `First_Name`, `Last_Name`, `Designation`, `Email`, `Password`) VALUES (NULL, '$fname', '$lname', '$desn', '$email', '$pass')";
$result = mysqli_query($conn, $sql);
if ($result) {

    echo "<script>alert('Registered Successfully.')</script>";
    echo "<script>window.location.href='login.html';</script>";
    exit();
}

?>
</body>
</html>