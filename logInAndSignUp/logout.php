<?php
// Start session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a different page or perform any other action after terminating the session
header("Location: login.html");
exit();
?>
