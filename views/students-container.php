<?php
/*
Allows the user to both create new records and edit existing records
*/
//var_dump($_POST) or die;
// connect to the database
require_once ("../conn.php");
require_once ('../functions.php');
session_start(); 
$_SESSION['id'] = '$id';
$_SESSION['name'] = '$name';
$_SESSION['phone'] = '$phone';
$_SESSION['email'] = '$email';
$_SESSION['image'] = '$image';
$_SESSION['error'] = '$error';
function renderForm($name = '', $phone ='', $email ='', $image ='', $error = '', $id = '')
{ ?>
<!DOCTYPE>
<html>
<head>
<title>
<?php if ($id != '') { echo "Edit Record"; } else { echo "New Student"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') { echo "Edit Record"; } else { echo "New Student"; } ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

  <form id="formm" action="" method="post">
<div>
<?php if ($id != '') { ?>
<input type="hidden" name="id"value="<?php echo $id; ?>" />
<p>ID: <?php echo $id; ?></p>
<?php } ?>
<strong>Name: *</strong> <input type="text" required name="name" id="name"
value="<?php echo $name; ?>"/><br/>
<strong>Phone: *</strong> <input type="text" required name="phone" id="phone"value="<?php echo $phone; ?>"/><br/>
<strong>Email: *</strong> <input type="email" required name="email" id="email"value="<?php echo $email; ?>"/>
<strong>Image: *</strong> <input type="file" src=images accept="image/* id="image"value="<?php echo $image; ?>"/>
<p>* required</p>
<input id="fire" type="submit" name="submit" value="submit" />
</div>
</form>
</body>
</html>

<?php }



/*

EDIT RECORD

*/

// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['id']))
{
// get variables from the URL/form
$id = $_POST['id'];
$name = htmlentities($_POST['name'], ENT_QUOTES);
$phone = htmlentities($_POST['phone'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$image = htmlentities($_POST['image'], ENT_QUOTES);
// check that name and phone and email are not empty
if ($name == '' || $phone == '' || $email == '' || $image == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($name, $phone, $email, $image, $error, $id);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $connection->prepare("UPDATE students SET name = ?, phone = ?, email = ?, image = ?
WHERE id=?"))
{
$stmt->bind_param("ssssi", $name, $phone, $email, $image, $id);
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
}
// if the 'id' variable is not valid, show an error message
else
{
echo "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $connection->prepare("SELECT name, phone, email, image FROM students WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($name, $phone, $email, $image);
$stmt->fetch();

// show the form
renderForm($name, $phone, $email, $image, NULL, $id);

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
}
}



/*

New Student

*/
// if the 'id' variable is not set in the URL, we must be creating a new record
else
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// get the form data
$name = htmlentities($_POST['name'], ENT_QUOTES);
$phone = htmlentities($_POST['phone'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$image = htmlentities($_POST['image'], ENT_QUOTES);
// check that variables not empty
if ($name == '' || $phone == '' || $email == '' || $image == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($name, $phone, $email, $image, $error);
}
else
{
// insert the new record into the database
if ($stmt = $connection->prepare("INSERT students (name, phone, email, image) VALUES (?, ?, ?, ?)"))
{
$stmt->bind_param("ssss", $name, $phone, $email, $image);
$stmt->execute();
$stmt->close();
}
// show an error if the query has an error
else
{
echo "ERROR: Could not prepare SQL statement.";
}

// redirec the user
echo "Student added successfully";
//header("Location: view.php");
}

}
// if the form hasn't been submitted yet, show the form
else
{
renderForm();
}
}

?>