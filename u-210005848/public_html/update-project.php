<?php
session_start();
require_once('connectdb.php');

//9. Security Measure - Authentication
if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true){
    if(!isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'authorised'){
        header('Location: login.php');
        exit;
    }
}


if(isset($_SESSION['username'])){  
    $username=$_SESSION['username'];
    $query = "SELECT uid from users where username = '$username'";
    $rows=$db->query($query);
    $row=$rows->fetch(PDO::FETCH_ASSOC);
    $uid = $row['uid'];

          $query="SELECT * FROM projects WHERE uid = '$uid'";
          $rows=$db->query($query);
          
         }

          if($rows && $rows->rowCount()> 0){

          ?>

          <table cellspacing="0"  cellpadding="5" id="projectTable" >
          <tr><th align='left'><b>Project ID</b></th> 
            <th align='left'><b>Title</b></th> 
          <th align='left'><b>Start Date</b></th >
          <th align='left'><b>End Date</b></th>
          <th align='left'><b>Description</b></th >
          <th align='left'><b>Phase</b></th ></tr>

          <?php

          while  ($row =  $rows->fetch())	{
            echo  "<tr><td align='left'>" . $row['pid'] . "</td>";
                    echo  "<td align='left'>" . $row['title'] . "</td>";
                    echo  "<td align='left'>" . $row['start_date'] . "</td>";
            echo  "<td align='left'>" . $row['end_date'] . "</td>";
                    echo "<td align='left'>". $row['description'] . "</td>";
            echo  "<td align='left'>" . $row['phase'] . "</td></tr>\n";
                }
          echo '</table>' . '<br>';
        } 


    if(isset($_POST['submitted'])){
        var_dump($_POST);

        $pid=$_POST['pid'];
        $uid = $_POST['uid'];
        var_dump($pid);
        var_dump($uid);
        $title=$_POST['title'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $description=$_POST['description'];
        $phase=$_POST['phase'];

        //7. Update existing projects
        $query = "UPDATE projects SET title = '$title', start_date = '$start_date', end_date = '$end_date', description = '$description', phase = '$phase' WHERE uid = '$uid' AND pid = '$pid'";

        if($db->query($query)){
            header("Location:registered-user.php");
        } else {
             echo "Error inserting data";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Your Project!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="update-project.php">

        <label for="pid">Project ID:</label>
        <input type="text" name="pid" <?php echo htmlspecialchars('pid'); ?> required>
        <br>
    <!--13. Handle injects - SQL/HTML -->
        <label for="title">Title:</label>
        <input type="text" name="title" <?php echo htmlspecialchars('title'); ?> required>
        <br>
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" <?php echo htmlspecialchars('start_date'); ?> required>
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" <?php echo htmlspecialchars('end_date'); ?> required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" <?php echo htmlspecialchars('description'); ?>required> </textarea>
        <br>
        <label for="phase">Phase:</label>
        <select name="phase" placeholder="Phase" required>
            <option value="design">Design</option>
            <option value="development">Development</option>
            <option value="testing">Testing</option>
            <option value="deployment">Deployment</option>
            <option value="complete">Complete</option>
        </select>

        <br>
        <label for="uid">User Id:</label>
        <input type="text" name="uid" <?php echo htmlspecialchars('uid'); ?> required>
        <br>
        <input type="submit" value="Save Changes">
        <input type="hidden" name="submitted" value="true"/>
    </form>

</body>
    <p>Go back to the projects. <a href="registered-user.php">Back</a>  </p>

    <footer></footer>
</html>