<?php
session_start();
require_once('connectdb.php');

if(isset($_POST['submitted'])){
    require_once('connectdb.php');

    $email=$_POST["email"];

    $username=isset($_POST['username'])?$_POST['username']:false;
    //11. Hash password
    $password=isset($_POST['password'])?password_hash($_POST['password'],PASSWORD_DEFAULT):false;

    //12. Form validation - make sure username and password not empty
   if(empty($username) || empty($password) || empty($email)){
        echo "<p class='error'> Can not leave blank! </p>";
        exit;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<p class='error'> Incorrect email! </p>";
        exit;
    }

    try {
        $stat=$db->prepare("Insert into users values(default,?,?,?)");
        $stat->execute(array($username, $password, $email));

        $uid=$db->lastInsertId();
        echo("You have now been registered. Your ID is: $uid");

        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = 'authorised';
        
        header('Location: registered-user.php');
        exit;
        
    } catch (PDOexception $exc) {
        echo("Sorry, a database error has occured <br>");
        echo("Error details: <em>". $exc->getMessage()."</em>");
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="reg-user">
        <h2>Registration form</h2>

        <!--4. Register to become registered user-->
            <form method="post" action="register.php" >
                <p> Username: </p>
                <input type="text" name="username"
                placeholder="Username*"/> 

                <br>
                <p> Password: </p>
                <input type="password" name="password"
                placeholder="Password*"/>

                <br>
               <p> Email: </p>
                <input type="email" name="email"
                placeholder="Email*"/>

                <br><br>

                <input type="submit" value="Register"/>
                <input type="hidden" name="submitted" value="true"/>

            </form> 

        <p> Already a user? <a href="login.php"> Log in! </a> </p>
  
</body>
</html>