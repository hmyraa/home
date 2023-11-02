<?php
session_start();
require_once('connectdb.php');

    if(isset($_POST['submitted'])){
        if(!isset($_POST['username'], $_POST['password'])){
            exit('Please fill both the username and password.');
        }

        require_once("connectdb.php");
        try{
            $stat = $db->prepare('SELECT password FROM users WHERE username = ?');
			$stat->execute(array($_POST['username']));
            echo $uid = $_SESSION['uid'];

            if($stat->rowCount()>0){
                $row=$stat->fetch();
                if(password_verify($_POST['password'], $row['password'])){
                    session_start();

                    $_SESSION['authenticated'] = true;

                    //5. Registered users can log-in
                    $_SESSION["username"]=$_POST['username'];
                    $_SESSION['user_role'] = 'authorised';
                    
                    header("Location:registered-user.php");
                    exit();
                } else{
                    echo "<p>Password is incorrect</p>";
                }
            } else {
                echo "<p>Username not found</p>";
            }
        }
        catch(PDOException $exc) {
			echo("Failed to connect to the database.<br>");
			echo($exc->getMessage());
			exit;
		}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log in!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header></header>

    <form method="post" action="login.php">
        <input type="text" name="username"
        placeholder="Username"/>

        <input type="password" name="password"
        placeholder="Password"/>

        <input type="submit" value="Log in"/>
        <input type="hidden" name="submitted" value="true"/>
     </form>

     <p> Not yet a user? <a href="register.php"> Register!</a> </p>
     <p>Go back to the homepage <a href="index.php">Back</a>  </p>
</body>
    <footer></footer>
</html>