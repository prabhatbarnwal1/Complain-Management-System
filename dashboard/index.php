<?php
include("../connection.php");

$sql="SELECT count(*) FROM complaints";
$total=mysqli_query($conn,$sql);
$sql="Select count(*) from complaints where Status='Pending'";
$pending=mysqli_query($conn,$sql);
$sql="Select count(*) from complaints where Status='Completed'";
$solved=mysqli_query($conn,$sql);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>

.toggle-label{
    padding: 5px;
    width: 100px;
}
        .Processing{
    border: 1px solid yellow;
    background-color: yellow;
    border-radius: 10px;
    }
    .Pending{
        border: 1px solid red;
        background-color: red;
        padding: 4px;
        border-radius: 10px;
    }
    .Completed{
        border: 1px solid rgb(0, 255, 72);
        background-color: rgb(0, 255, 72);
        border-radius: 10px;
    }
    .dark{
        color:white;
    }
    .logo-image{
        
    }
    table,th,td{
        border: 1px solid green;
        border-collapse: collapse;
        padding: 5px;
    }
    </style>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Dashboard Panel</title>
</head>
<body>
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
                    <span class="link-name">Admin</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Content</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
                
                
            </ul>
            
            <ul class="logout-mode">
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
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-comments"></i>
                        <span class="text">Total Complaints</span>
                        <span class="number"><?php echo mysqli_fetch_row($total)[0]; ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Solved Complaints</span>
                        <span class="number"><?php echo mysqli_fetch_row($solved)[0]; ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-comments"></i>
                        <span class="text">Pending Complaints</span>
                        <span class="number"><?php echo mysqli_fetch_row($pending)[0]; ?></span>
                    </div>
                </div>
            </div>
            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Complaints</span>
                </div>
                <table>
                    <thead>
                        <th>Room No</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Complaint Type</th>
                        <th>Priority</th>
                        <th>Description</th>
                        <th>Status</th>
                    </thead>
                    <?php
                        $conn=mysqli_connect('localhost','root','','hostel_redressal');
                        $sql="SELECT * FROM complaints";
                        $result=mysqli_query($conn,$sql);
                        
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                echo "<td>".$row["Room_No"]."</td>";
                                echo "<td>".$row["Email"]."</td>";
                                echo "<td>".$row["Phone_No"]."</td>";
                                echo "<td>".$row["Complaint_Type"]."</td>";
                                echo "<td>".$row["Priority"]."</td>";
                                echo "<td>".$row["Description"]."</td>";
                                echo "<td><a href='active.php?id=".$row['id']."&status=".$row['Status']."'><button class='toggle-label ".$row['Status']."'>".$row['Status']."</button></a></td>";
                                echo "</tr>";
                        }

                    ?>
                </table>
            </div>
        </div>
    </section>
    <script src="script.js">
    </script>
</body>
</html>