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
require_once'database.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn, DB_NAME);

if($db_found) {

    $query = 'SELECT * FROM housing ORDER BY id_housing';
    $result = mysqli_query($conn, $query);


    while($db_field = mysqli_fetch_assoc($result)) {
        echo'<br>';
        echo '<img href="' . $db_field['photo'] . '" alt="' . $db_field['title'] . '">';
        //echo '<table>'<tr>'<th>Title: </th>'</tr><tr><td>. $db_field['address']</td></tr></table>'
        echo '<p><strong>Title : </strong>' . '<a href="house.php?id=' . $db_field['id_housing'] . '">' . $db_field['title'] . '</a></p>'; 
		echo '<p><strong>Address : </strong>' . $db_field['address'] . '</p>';
    }
}

else {
    echo 'DB not found (' . DB_NAME . ')';
}


?>

<table></table>