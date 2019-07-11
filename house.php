<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php

if(isset($_GET['id'])){

    $houseID = (int) $_GET['id'];

    if($houseID > 0) {
        require_once'database.php';
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        $db_found = mysqli_select_db($conn, DB_NAME);

        if($db_found) {

            $query = 'SELECT *FROM housing';
            $result = mysqli_query($conn, $query);
            $db_field = mysqli_fetch_assoc($result);

            echo'<br>';
            echo '<img href="' . $db_field['photo'] . '" alt="' . $db_field['title'] . '">';
            echo '<p><strong>Title : </strong>' . $db_field['title']. '</p>'; 
            echo '<p><strong>Address : </strong>' . $db_field['address'] . '</p>';

        } else {
            echo 'DB not found (' . DB_NAME . ')';
        }

      } else {
          echo 'Something\'s wrong...';
        echo '<a href="./">Go Back</a>';
      }

} else {
    echo 'Something\'s wrong...';
    echo '<a href="./">Go Back</a>';
}

 ?>