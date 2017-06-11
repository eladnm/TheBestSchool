<?php
//var_dump($_POST) or die;
// connect to the database
require_once __DIR__ . '/../../lib/core.php';
require_once '../../classes/Course.php';
$_SESSION['id'] = '$id';
$_SESSION['name'] = '$name';
$_SESSION['descr'] = '$descr';
$_SESSION['image'] = '$image';
$_SESSION['error'] = '$error';
//$_SESSION['course'] = '$course_id';
function renderForm($name = '', $descr = '', $image = '', $error = '', $id = '') {
	?>
<!DOCTYPE>
<html>
<head>
<title>
<?php if ($id != '') {echo "Edit Record";} else {echo "New Course";}?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') {echo "Edit Record";} else {echo "New Course";}?></h1>
<?php if ($error != '') {
		echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
			. "</div>";
	}?>

  	<?php
$course_params = compact('id', 'name', 'descr', 'image', 'error');
	render('course-form', $course_params)
	?>
</body>
</html>
<?php }?>
<?php
if (isset($_POST['submit'])) {

	//get the form data
	$name = htmlentities($_POST['name'], ENT_QUOTES);
	$descr = htmlentities($_POST['descr'], ENT_QUOTES);

	if ($name == '' || $descr == '') {
// if they are empty, show an error message and display the form
		$error = 'ERROR: Please fill in all required fields!';
		renderForm($name, $descr, $image, $error);
	} else {

//'insert into students (name, phone, email, image) values ("naor", "0545451334", "naoric@gmail.com", ...)'
		//$join_table_sql = "INSERT INTO students_courses (student_id, course_id)
		//VALUES ('$id', '$course_id')";
		if ($stmt = $connection->prepare("INSERT students (name, descr, image) VALUES (?, ?, ?)")) {
			$stmt->bind_param("sss", $name, $descr, $image);
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