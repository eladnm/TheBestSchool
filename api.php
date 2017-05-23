<?php 
session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
	switch ($_GET['action']){
		case 'logout':
            session_destroy();
            header("location:http://localhost/school_project");
            break;
    }
}

switch ($_POST['action']){
	case 'login':
		login();
		break;
        	
}

function savePic ($pic){
    $target_dir = "uploads/";
    $file_name = filter_var($_FILES[$pic]['name'], FILTER_SANITIZE_STRING);
    $target_file = $target_dir . basename ($file_name);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    move_uploaded_file($_FILES[$pic]['tmp_name'], $target_file);
    return '<img src=' . "$target_file" . '>'; 
};
