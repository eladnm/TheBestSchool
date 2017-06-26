<?php
require_once __DIR__ . '/../../lib/core.php';
require_once '../../classes/Course.php';

$_SESSIO['id'] = '$id';
$_SESSION['name'] = '$name';
$_SESSION['phone'] = '$phone';
$_SESSION['email'] = '$email';
$_SESSION['image'] = '$image';
$_SESSION['error'] = '$error';
$_SESSION['course'] = '$course_id';
if (hasUserID() && isGetRequest()) {
	renderForm();
} else if (isPostRequest()) {
	updateStudentInDatabase();
}

function hasUserID() {
	return isset($_GET['id']);
}

function isGetRequest() {
	return !isPostRequest();
}

function isPostRequest() {
	return isset($_POST['submit']);
}
?>
<?php function renderForm() {
	?><div id="head" style="display: flex;
    align-items: center; justify-content: center; font-size: 20px;"><?php echo "Edit Student's Details"; ?></div>
	<?php $userID = $_GET['id'];
	$user = fetchUserDetailsByID($userID);
	render('student-form', $user);
}

function fetchUserDetailsByID($userID) {
	global $connection;
	$stmt = $connection->prepare("SELECT id, name, phone, email, image FROM students WHERE id=?");
	$stmt->bind_param("i", $userID);
	$stmt->execute();
	$stmt->bind_result($id, $name, $phone, $email, $image);
	$stmt->fetch();
	$stmt->close();
	return compact('id', 'name', 'phone', 'email', 'image');
}

function updateStudentInDatabase() {
	$student = getStudentDetails();
	if (studentDataIsValid($student)) {
		saveStudent($student);
	}
}

function getStudentDetails() {
	return [
		'id' => htmlentities($_POST['id'], ENT_QUOTES),
		'name' => htmlentities($_POST['name'], ENT_QUOTES),
		'phone' => htmlentities($_POST['phone'], ENT_QUOTES),
		'email' => htmlentities($_POST['email'], ENT_QUOTES),
		'course_id' => htmlentities($_POST['Course'], ENT_QUOTES),
	];
}

function studentDataIsValid($student) {
	return $student['id'] !== '' &&
		$student['name'] !== '' &&
		$student['phone'] !== '' &&
		$student['email'] !== '';
}

function saveStudent($student) {
	global $connection;
	$image = saveStudentImage();
	$stmt = $connection->prepare("UPDATE students SET name = ?, phone = ?, email = ?, image = ?
WHERE id=?");
	extract($student);
	$stmt->bind_param("ssssi", $name, $phone, $email, $image, $id);
	$stmt->execute();
	$join_table_sql = "INSERT INTO students_courses (student_id, course_id)
VALUES ('$id', '$course_id')";
	if ($connection->query($join_table_sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $join_table_sql . "<br>" . $connection->error;
	}
	printf("%d Row inserted.\n", $stmt->affected_rows);
	$stmt->close();
}

function saveStudentImage() {
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
	$imageFileDestination = __DIR__ . '/../../images/' . $file;
	move_uploaded_file($imageTmpName, $imageFileDestination);
	return $target_file;
}