<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
    <header></header>
    <main>
    <div>
            <form enctype="multipart/form-data" action="#" method="post">
            <input type="text" name="title" placeholder="title">
            <input type="text" name="address" placeholder="address">
            <input type="text" name="city" placeholder="city">
            <input type="text" name="pc" placeholder="pc">
            <input type="text" name="area" placeholder="area">
            <input type="text" name="price" placeholder="price">
            <input type="radio" name="type" value="rent" id="radio"> Rent 
            <input type="radio" name="type" value="buy"> Buy 
            <textarea name="description" placeholder="description" id="" cols="30" rows="10"></textarea>
            <input type="file" name="myFile">
            <input type="submit" name="add" value="add">
        </form>
    </div>
    </main>

    <footer></footer>
    
</body>
</html>

<?php

require_once'database.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
$db_found = mysqli_select_db($conn, DB_NAME);

$query = "SELECT* FROM housing ";

if(!$conn) {
    echo 'connection went wrong';
}

if(mysqli_query($conn, $query)){

    echo "record updated successfully";
} else{

    echo "Error";
}

if(isset($_POST['add'])) {

    $title = $_POST['title'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pc = $_POST['pc'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $photo = $_POST['photo'];
    $type = $_POST['type'];
    $description = $_POST['description'];


    $insert = "INSERT INTO housing(title, address, city, pc, area, price, photo, type, description) 
    VALUES ('$title', '$address', '$city', '$pc', '$area', '$price', '$photo', '$type', '$description')";
    $results = mysqli_query($conn, $insert);

    //?Required fields
    if(empty($title) or empty($address) or empty($city) or empty($pc) or empty($area) or empty($price) or empty($type))
        echo'Please fill the mandatory fields';
    //? Postal code format
    elseif (strlen( $pc < 5))
        echo 'Your password should contain at least 8 characters';
    //? Price and Area--> INT


    //? Constrains Photo
    if (isset($_POST['mySubmit'])) {
        var_dump($_FILES);

    if ($_FILES['myFile']['error'] != UPLOAD_ERR_OK) {
        echo "Some error during upload";
      } else {
    
        //* Check extension
        $extensionArray = array(
          'jpg' => 'image/jpeg',
          'png' => 'image/png',
          'gif' => 'image/gif'
        );
        // Check if the extension match a value in the array
        $extFile = array_search($_FILES['myFile']['type'], $extensionArray);

        if ($extFile) {
            // Hash the file name
            $shaFile = sha1_file($_FILES['myFile']['tmp_name']);
            echo "HASH NAME : " . $shaFile;
            $destinationDir = './uploads/';
            $fileNumbers = 0;
            do {
              $fileName = $shaFile . $fileNumbers . '.' . $extFile;
              $fullPath = $destinationDir . $fileName;
              var_dump($fullPath);
              $fileNumbers++;
            } while (file_exists($fullPath));
      
            $moved = move_uploaded_file($_FILES['myFile']['tmp_name'], $fullPath);
      
            if ($moved)
              echo "File successfully saved";
            else
              echo "Error during saving";
          } else {
            echo 'File not an image !';
          }
    
    }

}
}

use Sirprize\PostalCodeValidator\Validator;

$validator = new Validator();
$validator->hasCountry('CH'); // returns true

$results = mysqli_query($conn, $query);

mysqli_close($conn);
?>

