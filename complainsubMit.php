<?php
// Establish connection to your database
$servername = "localhost"; // Change this to your servername
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "hostel_redressal"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);



// Check connection
if ($conn->connect_error) {
    echo "My work is done so early.";
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $room = $_POST['room'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $complain_type = $_POST['complain_type'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];
    echo $description;
    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    // SQL to insert data into the database
    $sql = "INSERT INTO complaints (room_no, email, phone_no, complaint_type, priority, description, image,Status)
            VALUES ('$room', '$email', '$phone', '$complain_type', '$priority', '$description', '$target_file','Pending')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: ../Complain_Management_System-main/dashboard/student.php"); // Assuming your login page is login.html
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    $conn->close();
}
?>
