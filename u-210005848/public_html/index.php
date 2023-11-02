<?php
    session_start();
    require('connectdb.php');

    //1. Public users can view list of all projects showing basic info (title, start date, description)
		  try{
            $query="SELECT * FROM projects";
            $rows=$db->query($query);

            if($rows && $rows->rowCount()> 0){

            ?>
                <p> You are in the homepage! </p>

            <table cellspacing="0"  cellpadding="5" id="projectTable" >
            <tr><th align='left'><b>Project ID</b></th> 
	          <th align='left'><b>Title</b></th> 
            <th align='left'><b>Start Date</b></th >
            <th align='left'><b>Description</b></th ></tr>

            <?php
            while  ($row =  $rows->fetch())	{
              echo  "<tr><td align='left'>" . $row['pid'] . "</td>";
				      echo  "<td align='left'>" . $row['title'] . "</td>";
				      echo  "<td align='left'>" . $row['start_date'] . "</td>";
				      echo "<td align='left'>". $row['description'] . "</td>\n";

              //2. Click 1 project to view more detail
              echo "<td><a href='more-details.php?pid=" . $row['pid'] . "'id='more'>More</a></td>";
              echo "</tr>";
			      }
            echo '</table>';
          } else {
            echo"<p>Log in to access more.</p>\n";
          }
        }
        catch(PDOexception $exc){
          echo "Sorry, a database error occurred! <br>";
		      echo "Error details: <em>". $exc->getMessage()."</em>";
        }
?>

<p>Log-in to add your own project! <a href="login.php">Log in</a></p>

<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Homepage!</title>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
  <p>Search through the projects here:</p>
<form method="post" action="search.php">

<p>Please input both:</p>

    <label for="title">Title:</label>
    <input type="text" name="title" id="title">

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date">

    <input type="submit" name="search" value="Search">
</form>
</body>

</html>