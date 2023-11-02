<?php
    //8. Registered users should log out
    session_start();
    unset($_SESSION["username"]);
    session_destroy();
?>
<link rel="stylesheet" href="style.css">
<h2> You are now logged out </h2>
    <p>Click here to return to the homepage. <a href="index.php">Return!</a></p>
    <p>Would you like to log in? <a href="login.php">Log in!</a></p>