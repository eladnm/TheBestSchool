<?php
include 'conn.php';
// get the form data
$name = $_POST['name'];
$descr = $_POST['descr'];
$image = $_POST['image'];

$sql = "INSERT INTO courses (name, descr, image)
VALUES ('$name', '$descr', 'image')";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close_connection();


// if the form hasn't been submitted yet, show the form
?>