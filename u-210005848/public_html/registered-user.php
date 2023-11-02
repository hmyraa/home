<?php
    session_start();
    require_once('connectdb.php');

        //9. Authentication check
        if(isset($_SESSION['username'])){
          $username=$_SESSION['username'];
          $_SESSION['user_role'] = 'authorised';
	        echo "<h2> Welcome ".$_SESSION['username']."! </h2>";

          $query = "SELECT uid from users where username = '$username'";
          $rows=$db->query($query);
          $row=$rows->fetch(PDO::FETCH_ASSOC);
          $uid = $row['uid'];
            echo "<p> Logged in with User ID: " . $uid . "</h2>";
          
          try{
            $query="SELECT * FROM projects";
            $rows=$db->query($query);
            if($rows && $rows->rowCount()> 0){

            ?>

            <table cellspacing="0"  cellpadding="5" id="projectTable" >
            <tr><th><b>Project ID</b></th> 
	          <th><b>Title</b></th> 
            <th><b>Start Date</b></th >
            <th><b>End Date</b></th>
            <th><b>Description</b></th >
            <th><b>Phase</b></th ></tr>

            <?php

            while  ($row =  $rows->fetch())	{
              echo  "<tr><td>" . $row['pid'] . "</td>";
				      echo  "<td>" . $row['title'] . "</td>";
				      echo  "<td>" . $row['start_date'] . "</td>";
              echo  "<td>" . $row['end_date'] . "</td>";
				      echo "<td>". $row['description'] . "</td>";
              echo  "<td>" . $row['phase'] . "</td></tr>\n";
			      }
            echo '</table>';
          } else {
            echo"<p>No course in the list.</p>\n";
          }
        }
        catch(PDOexception $exc){
          echo "Sorry, a database error occurred! <br>";
		      echo "Error details: <em>". $exc->getMessage()."</em>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Homepage!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class='link'>
<p>Would like to add a new project? <a href="add-project.php">New Project</a>  </p>

<p>Would like to update an existing project? <a href="update-project.php">Update</a>  </p>

<p>Would like to log out? <a href="logout.php">Log out</a>  </p>
</div>
</body>
</html>
