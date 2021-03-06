<?php

// connect to the database
include '../conn.php';

// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
// get the 'id' variable from the URL
	$id = $_GET['id'];

// delete record from database
	if ($stmt = $connection->prepare("DELETE FROM admins WHERE id = ? LIMIT 1")) {
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->close();
	} else {
		echo "ERROR: could not prepare SQL statement.";
	}
	$connection->close();

// redirect user after delete is successful
	header("Location: ../index.php");
} else
// if the 'id' variable isn't set, redirect the user
{
	header("Location: views/404.php");
}

?>