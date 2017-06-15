<?php
session_start();
include 'conn.php';
if (!isset($_SESSION['name'])) {
	header("Location:login.php");
}

if (!isset($_GET['subject']) || empty($_GET['subject'])) {
	header("Location: index.php?subject=school");
	die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The best School</title>
	    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" type="text/css" href="css.css"/>
</head>
<body>
<?php include 'views/header.php';?>

<main>

<?php
switch ($_GET['subject']) {
case 'school':
	include 'views/admins.php';
	break;
case 'admins':
	include 'views/admins.php';
	break;
}

?>
</main>

<?php include 'views/footer.php';?>
</body>
</html>