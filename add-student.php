<?php
include 'conn.php';
include "classes/student.php";
// get the form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$image = $_POST['image'];
$sql = "INSERT INTO students (name, phone, email, image)
VALUES ('$name', '$phone', '$email', '$image')";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
$db->close_connection();


// if the form hasn't been submitted yet, show the form
?>