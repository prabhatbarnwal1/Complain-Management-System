<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
    <style>
        .toggle-label {
            padding: 5px;
            width: 100px;
        }

        .Processing {
            border: 1px solid yellow;
            background-color: yellow;
            border-radius: 10px;
        }

        .Pending {
            border: 1px solid red;
            background-color: red;
            padding: 4px;
            border-radius: 10px;
        }

        .Completed {
            border: 1px solid rgb(0, 255, 72);
            background-color: rgb(0, 255, 72);
            border-radius: 10px;
        }

        table,
        th,
        td {
            border: 1px solid green;
            border-collapse: collapse;
            padding: 5px;
        }

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .logo-image{
            color:#fefefe;
            background-color: #fefefe;
        }
        .dark{
            color:white;
        }
        a{
            text-decoration: none;
            color:#000;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Student Dashboard Panel</title>
</head>

<body>
    <?php
    // Include database connection
    include("../connection.php");

    // if (session_status() == PHP_SESSION_NONE) {
    session_start();
    // }
    if (!isset($_SESSION['name']) || $_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query to check login credentials
        $sql = "SELECT * FROM users WHERE Email = '$email' AND Password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            $name = $row['First_Name']; // Assuming 'First_Name' is the column containing the user's name

            // Start session and store user data

            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;

            //exit();

            // Redirect to student.php
            //header("Location: ../dashboard/student.php");
        } else {
            // Invalid credentials
            echo "Invalid email or password.";
            exit();
        }
    }
    ?>
    <nav>

        <div class="logo-name">
            <div class="logo-image">
                <img src="../assets/logo1.png" alt="">
            </div>
            <span class="logo_name">ComplainSystem</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Student</span>
                    </a></li>
                <li><a href="../complainForm.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Complain</span>
                    </a></li>



            </ul>

            <ul class="logout-mode">
                <li><a href="../logInAndSignUp/logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <div class="dash-content">

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Hi...<?php echo $_SESSION['name']; ?></span>
                </div>
                <table style="width:100%;">
                    <thead>
                        <th>Room No</th>
                        <th>Complaint Type</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM complaints where email= '$_SESSION[email]'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $s = $row['Status'];
                        echo "<tr>";
                        echo "<td>" . $row["Room_No"] . "</td>";
                        echo "<td>" . $row["Complaint_Type"] . "</td>";
                        echo "<td>" . $row["Description"] . "</td>";
                        echo "<td><a class='myBtn' href='student.php?id=" . $row['id'] . "&status=" . $row['Status'] . "' >Click Here</a></td>";
                        echo "<td ><button class='$s toggle-label'>" . $row['Status'] . "</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>

            </div>
        </div>
        <div id="wmyModal" class="wmodal">

            <!-- Modal content -->
            <div class="wmodal-content">
                
                <?php
                // Validate and sanitize the input

                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                if($id!=0){
                    $sql = "SELECT Image FROM complaints WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $imagePath = $row['Image'];
                
                echo '<br><img src="../' . $imagePath . '" alt="" height="400px" width="1000px">';
                mysqli_close($conn);
                }
                
                ?>

            </div>

        </div>
    </section>

    <script>
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementsByClassName('myBtn');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        
        
        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script src="script.js"></script>
</body>

</html>