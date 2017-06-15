<?php
session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	switch ($_GET['action']) {
	case 'logout':
		session_destroy();
		header("location:http://localhost/school_project");
		break;
	}
}

switch ($_POST['action']) {
case 'login':
	login();
	break;

}
