<?php
session_start();
require_once('connectdb.php');
$pid = $_GET['pid'];

    $query = "SELECT * FROM projects WHERE pid = $pid";
    $rows=$db->query($query);

    ?>

      <table cellspacing="0"  cellpadding="5" id="projectTable" >
        <tr><th align='left'><b>Project ID</b></th> 
	      <th align='left'><b>Title</b></th> 
        <th align='left'><b>Start Date</b></th >
        <th align='left'><b>End Date</b></th>
        <th align='left'><b>Description</b></th >
        <th align='left'><b>Phase</b></th ></tr>

    <?php

    while ($row = ($rows)->fetch() ) {
      echo  "<tr><td align='left'>" . $row['pid'] . "</td>";
      echo  "<td align='left'>" . $row['title'] . "</td>";
      echo  "<td align='left'>" . $row['start_date'] . "</td>";
      echo  "<td align='left'>" . $row['end_date'] . "</td>";
      echo "<td align='left'>". $row['description'] . "</td>";
      echo  "<td align='left'>" . $row['phase'] . "</td></tr>\n";
    }
    echo '</table>';
?>
<link rel="stylesheet" href="style.css">
<p>Log-in to add your own project! <a href="login.php">Log in</a></p>
<p>Go back to the projects. <a href="index.php">Back</a>  </p>
