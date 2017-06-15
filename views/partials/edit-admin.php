<?php
require_once __DIR__ . '/../../lib/core.php';

$_SESSIO['id'] = '$id';
$_SESSION['name'] = '$name';
$_SESSION['role'] = '$role';
$_SESSION['phone'] = '$phone';
$_SESSION['email'] = '$email';
$_SESSION['image'] = '$image';
$_SESSION['error'] = '$error';

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
    align-items: center; justify-content: center; font-size: 20px;"><?php echo "Edit Admin's Details"; ?></div>
	<?php $userID = $_GET['id'];
	$user = fetchUserDetailsByID($userID);
	render('admin-form', $user);
}

function fetchUserDetailsByID($userID) {
	global $connection;
	$stmt = $connection->prepare("SELECT id, name, phone, email, image, role FROM admins WHERE id=?");
	$stmt->bind_param("i", $userID);
	$stmt->execute();
	$stmt->bind_result($id, $name, $phone, $email, $image, $role);
	$stmt->fetch();
	$stmt->close();
	return compact('id', 'name', 'phone', 'email', 'image', 'role');
}

function updateStudentInDatabase() {
	$admin = getStudentDetails();
	if (studentDataIsValid($admin)) {
		saveStudent($admin);
	}
}

function getStudentDetails() {
	return [
		'id' => $_POST['id'],
		'name' => htmlentities($_POST['name'], ENT_QUOTES),
		'phone' => htmlentities($_POST['phone'], ENT_QUOTES),
		'email' => htmlentities($_POST['email'], ENT_QUOTES),
		'role' => htmlentities($_POST['role'], ENT_QUOTES),
	];
}

function studentDataIsValid($admin) {
	return $admin['id'] !== '' &&
		$admin['name'] !== '' &&
		$admin['phone'] !== '' &&
		$admin['email'] !== '';
}

function saveStudent($admin) {
	global $connection;
	$image = saveStudentImage();
	$stmt = $connection->prepare("UPDATE admins SET name = ?, phone = ?, email = ?, image = ?, role = ?
WHERE id=?");
	extract($admin);
	$stmt->bind_param("ssssii", $name, $phone, $email, $image, $role, $id);
	$stmt->execute();
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