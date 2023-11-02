<?php
session_start();
require_once('connectdb.php');

//10. Security measure - Authorisation 
if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true){
    if(!isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'authorised'){
        header('Location: login.php');
        exit;
    }
}

 if (isset($_POST['submit'])) {

    $uid = $_POST['uid'];
    $title = $_POST['title'];
    $startdate = $_POST['start_date'];
    $enddate = $_POST['end_date'];
    $description = $_POST['description'];
    $phase = $_POST['phase'];

    $query = "INSERT INTO projects (title, start_date, end_date, description, phase, uid) 
    VALUES ('$title', '$startdate', '$enddate', '$description', '$phase', $uid)";

    if($db->query($query)){
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data";
    }
    header("Location:registered-user.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add a new project!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <p> You will need your user ID ready to add a new project.
            <br> This can be found on the previous page. </p>
    </header>

    <form method="post" action="add-project.php">
    
        <label for="uid">User Id:</label>
        <input type="text" name="uid"
        placeholder="User ID"/>

        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="Title">

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date">

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date">

        <label for="description">Description:</label>
        <textarea name="description" placeholder="Description"></textarea>

        <label for="phase">Phase:</label>
        <select name="phase" placeholder="Phase">
            <option value="design">Design</option>
            <option value="development">Development</option>
            <option value="testing">Testing</option>
            <option value="deployment">Deployment</option>
            <option value="complete">Complete</option>
        </select>

        <input type="submit" name="submit" value="Save Project">
    </form>
</body>
    <p>Go back to the projects. <a href="registered-user.php">Back</a>  </p>
    <footer></footer>
</html>