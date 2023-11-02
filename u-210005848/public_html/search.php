<?php
session_start();
require_once('connectdb.php');

//3. Search all projects using the title or end date
if (isset($_POST['search'])) {
    $title = $_POST['title'];
    $start_date = $_POST['start_date'];

    $query = "SELECT * FROM projects WHERE start_date = '$start_date' OR title = '$title'"; 
    $rows=$db->query($query);

    if($rows && $rows->rowCount()> 0){
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
  <p>Search through the projects here:</p>
      <h2>Search Results</h2>
      <table id="projectTable">
      <tr><th>Title</th>
      <th>Start Date</th>
      <th>Description</th></tr>
</form>
</body>

</html>

      <?php
        
        while ($row = ($rows->fetch())) {
            echo  "<td>" . $row['title'] . "</td>";
            echo  "<td>" . $row['start_date'] . "</td>";
            echo "<td>". $row['description'] . "</td></tr>\n";
        }
        echo '</table>';
    } else {
        echo "No results found.";
    }
  }

?>
<p>Go back to the homepage <a href="index.php">Back</a>  </p>;