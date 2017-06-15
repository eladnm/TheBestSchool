<?php

function check_login() {
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

	$connection = new mysqli('localhost', 'root', '', 'school-project');
	if ($connection->errno) {echo $connection->error;die();}

	$stmt = $connection->prepare("
		SELECT roles.role as role
		from admins
		join roles on admins.role = roles.id
		where name = ? and password = ?
	");
	$stmt->bind_param('ss', $name, $password);
	$stmt->execute();
	$stmt->bind_result($role);
	$stmt->fetch();
	if (!empty($role)) {
		$_SESSION['name'] = $name;
		$_SESSION['role'] = $role;
		$_SESSION['image'] = $image;
		header("Location: index.php");
	} else {
		header("Location: login.php?error=true");
	}
}
function login() {
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$connection = new mysqli('localhost', 'root', '', 'school-project');
	if ($connection->errno) {echo $connection->error;die();}
	$stmt = $connection->prepare("SELECT admins.password, admins.image, roles.role as roles
            from admins join roles on admins.role = roles.id where name = ?");
	$stmt->bind_param('s', $name);
	$stmt->execute();
	$stmt->bind_result($hash, $image, $role);
	$stmt->fetch();
	$stmt->close();
	if (!empty($role)) {
		header("Location: index.php");
	} else {
		header("Location: login.php?error=true");
	}
	if (password_verify($password, $hash)) {
		$_SESSION["name"] = $name;
		$_SESSION["role"] = $role;
		$_SESSION["image"] = $image;
		echo 'password is correct';
	} else {
		echo 'invalid password';
	}
}

function logout() {
	session_destroy();
	header("Location: login.php");
}

function connection() {
	$connection = new mysqli('localhost', 'root', '', 'school-project');
	if ($connection->errno) {echo $connection->error;die();}
}

// new class more organized
class MySQLDatabase {

	private $connection;

	function __construct() {
		$this->open_connection();
	}

	public function open_connection() {
		$this->connection = mysqli_connect('localhost', 'root', '', 'school-project');
		if (mysqli_connect_errno()) {
			die("Database connection failed: " .
				mysqli_connect_error() .
				" (" . mysqli_connect_errno() . ")"
			);
		}
	}

	public function close_connection() {
		if (isset($this->connection)) {
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}

	public function query($sql) {
		//var_dump($sql);
		$result = mysqli_query($this->connection, $sql);
		$this->confirm_query($result);
		return $result;
	}

	private function confirm_query($result) {
		if (!$result) {
			die;
		}
	}

	public function escape_value($string) {
		$escaped_string = mysqli_real_escape_string($this->connection, $string);
		return $escaped_string;
	}

	// "database neutral" functions

	public static function fetch_array($result_set) {
		return mysqli_fetch_array($result_set);
	}

	public function num_rows($result_set) {
		return mysqli_num_rows($result_set);
	}

	public function insert_id() {
		// get the last id inserted over the current db connection
		return mysqli_insert_id($this->connection);
	}

	public function affected_rows() {
		return mysqli_affected_rows($this->connection);
	}

}

$connection = new mysqli('localhost', 'root', '', 'school-project');

$database = new MySQLDatabase();
$db = &$database;
