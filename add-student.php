<?php
include 'conn.php';
include "classes/student.php";

session_start();
// get the form data
$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$course_id = $_POST['Course'];

if (isset($_POST["submit"])) {
	$target_dir = "images/";
	$file = $_FILES['imageUpload']['name'];
	$target_file = $target_dir . $file;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$imageTmpName = $_FILES['imageUpload']['tmp_name'];
	// Check if image file is a actual image or fake image
	$check = getimagesize($imageTmpName);
	if ($check !== false) {
		$uploadOk = 1;
	} else {
		$uploadOk = 0;
	}
	$imageFileDestination = __DIR__ . '/images/' . $file;
	move_uploaded_file($imageTmpName, $imageFileDestination);
}
$filePath = $connection->escape_string('images/' . $file);
$sql = "INSERT INTO students (id, name, phone, email, image)
VALUES ('$id', '$name', '$phone', '$email', '$filePath');";

$join_table_sql = "INSERT INTO students_courses (student_id, course_id)
VALUES ('$id', '$course_id')";

if ($db->query($sql)) {
	echo "New record created successfully.<br />";
} else {
	echo "Error: " . $sql . "<br>" . $db->error;
}

if ($db->query($join_table_sql)) {
	echo "Student was added to the course ID number: '$course_id'";
} else {
	echo "Error: " . $sql . "<br>" . $db->error;
}
$db->close_connection();
?>