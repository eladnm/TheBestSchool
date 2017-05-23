<?php
require_once ("conn.php");
session_start();
echo $_SESSION['id'];
echo $_SESSION['phone'];
echo $_SESSION['email'];
function renderForm($name = '', $phone ='', $email ='', $error = '', $id = ''){}
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id']))
{
}
// if the form's submit button is clicked, we need to process the form
// get variables from the URL/form
$id = $_POST['id'];
$name = htmlentities($_POST['name'], ENT_QUOTES);
$phone = htmlentities($_POST['phone'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
// check that name and phone and email are not empty
if ($name == '' || $phone == '' || $email == '')
{
	var_dump($_GET) or die;
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($name, $phone, $email, $error, $id);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $connection->prepare("UPDATE students SET name = ?, phone = ?, email = ?
WHERE id=?"))
{
$stmt->bind_param("sssi", $name, $phone, $email, $id);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: ../index.php");
}

// if the 'id' variable is not valid, show an error message


// if the form hasn't been submitted yet, get the info from the database and show the form

// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $connection->prepare("SELECT name, phone, email FROM students WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($name, $phone, $email);
$stmt->fetch();

// show the form
renderForm($name, $phone, $email, NULL, $id);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}
// if the 'id' value is not valid, redirect the user back to the view.php page
else
{
header("Location: ../index.php");
}

