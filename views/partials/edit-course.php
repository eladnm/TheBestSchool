<?php
require_once __DIR__ . '/../../lib/core.php';
require_once '../../classes/Course.php';
$_SESSIO['id'] = '$id';
$_SESSION['name'] = '$name';
$_SESSION['descr'] = '$descr';
$_SESSION['error'] = '$error';
$_SESSION['course'] = '$course_id';

if (hasCourseID() && isGetRequest()) {
	renderForm();
} else if (isPostRequest()) {
	updateCourseInDatabase();
}

function hasCourseID() {
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
    align-items: center; justify-content: center; font-size: 20px;"><?php echo "Edit Course's Details"; ?></div>
	<?php $courseID = $_GET['id'];
	$course = fetchCourseDetailsByID($courseID);
	render('course-form', $course);
}

function fetchCourseDetailsByID($courseID) {
	global $connection;
	$stmt = $connection->prepare("SELECT id, name, descr, image FROM courses WHERE id=?");
	$stmt->bind_param("i", $courseID);
	$stmt->execute();
	$stmt->bind_result($id, $name, $descr, $image);
	$stmt->fetch();
	$stmt->close();
	return compact('id', 'name', 'descr', 'image');
}

function updateCourseInDatabase() {
	$courseDetails = getCourseDetails();
	if (courseDataIsValid($courseDetails)) {
		saveCourse($courseDetails);
	}
}

function getCourseDetails() {
	return [
		'id' => $_POST['id'],
		'name' => htmlentities($_POST['name'], ENT_QUOTES),
		'descr' => htmlentities($_POST['descr'], ENT_QUOTES),
	];
}

function courseDataIsValid($courseDetails) {
	return $courseDetails['id'] !== '' &&
		$courseDetails['name'] !== '' &&
		$courseDetails['descr'] !== '';
}

function saveCourse($courseDetails) {
	global $connection;
	$image = saveCourseImage();
	$stmt = $connection->prepare("UPDATE courses SET name = ?, descr = ?, image = ?
WHERE id=?");
	extract($courseDetails);
	$stmt->bind_param("sssi", $name, $descr, $image, $id);
	$stmt->execute();
	printf("%d Row inserted.\n", $stmt->affected_rows);
	$stmt->close();
}

function saveCourseImage() {
	$target_dir = "images/";
	$file = $_FILES['imageUpload']['name'];
	$target_file = $target_dir . $file;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$imageTmpName = $_FILES['imageUpload']['tmp_name'];
	// Check if image file is a actual image or fake image
	$check = getimagesize($imageTmpName);
	if ($check !== false) {
		echo "File is an image - " . $check['mime'] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
	$imageFileDestination = __DIR__ . '/../../images/' . $file;
	move_uploaded_file($imageTmpName, $imageFileDestination);
	return $target_file;
}