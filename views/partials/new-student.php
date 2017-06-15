<?php
require_once __DIR__ . '/../../lib/core.php';
require_once '../../classes/Course.php';
$_SESSION['id'] = '$id';
$_SESSION['name'] = '$name';
$_SESSION['phone'] = '$phone';
$_SESSION['email'] = '$email';
$_SESSION['image'] = '$image';
$_SESSION['error'] = '$error';
$_SESSION['course'] = '$course_id';
function renderForm($name = '', $phone = '', $email = '', $image = '', $error = '', $id = '') {
	?>
<!DOCTYPE>
<html>
<head>
<title>
<?php if ($id != '') {echo "Edit Record";} else {echo "New Student";}?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') {echo "Edit Record";} else {echo "New Student";}?></h1>
<?php if ($error != '') {
		echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
			. "</div>";
	}?>

  	<?php
$student_params = compact('id', 'name', 'phone', 'email', 'image', 'error');
	render('student-form', $student_params)
	?>
</body>
</html>
<?php }?>
<?php
if (isset($_POST['submit'])) {

	//get the form data
	$name = htmlentities($_POST['name'], ENT_QUOTES);
	$phone = htmlentities($_POST['phone'], ENT_QUOTES);
	$email = htmlentities($_POST['email'], ENT_QUOTES);

	if ($name == '' || $phone == '' || $email == '') {
// if they are empty, show an error message and display the form
		$error = 'ERROR: Please fill in all required fields!';
		renderForm($name, $phone, $email, $image, $error);
	} else {

//'insert into students (name, phone, email, image) values ("naor", "0545451334", "naoric@gmail.com", ...)'
		//$join_table_sql = "INSERT INTO students_courses (student_id, course_id)
		//VALUES ('$id', '$course_id')";
		if ($stmt = $connection->prepare("INSERT students (name, phone, email, image) VALUES (?, ?, ?, ?)")) {
			$stmt->bind_param("ssss", $name, $phone, $email, $image);
			$stmt->execute();

			$stmt->close();
		}
// show an error if the query has an error
		else {
			echo "ERROR: Could not prepare SQL statement.";
		}

// redirec the user
		echo "Student added successfully";
//header("Location: view.php");
	}

}
// if the form hasn't been submitted yet, show the form
else {
	renderForm();
}
