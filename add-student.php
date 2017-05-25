<?php
include 'conn.php';
include "classes/student.php";



function dd($someVar) {
    var_dump($someVar);
    die();
}

session_start();
// get the form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$image = $_POST['email'];

if(isset($_POST["submit"]))
{
    $target_dir = "images/";
    $file = $_FILES['imageUpload']['name'];
    $target_file = $target_dir . $file;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $imageTmpName = $_FILES['imageUpload']['tmp_name'];
    // Check if image file is a actual image or fake image
    $check = getimagesize($imageTmpName);
    if($check !== false) {
        echo "File is an image - " . $check['mime'] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    $imageFileDestination = __DIR__ . '/images/' . $file;
    move_uploaded_file($imageTmpName, $imageFileDestination);
}

$filePath = $connection->escape_string('images/' . $file);

$sql = "INSERT INTO students (name, phone, email, image)
VALUES ('$name', '$phone', '$email', '$filePath')";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
$db->close_connection();

?>