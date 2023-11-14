<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Regenerate session ID and destroy the session
session_regenerate_id(true);
session_destroy();

// Redirect to the login page
header("Location: index.php");
exit();
?>