<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['name'])) {
    header("Location:http://localhost/school_project/");
}
if (!isset($_GET['subject']) || empty($_GET['subject'])) {
    header("Location: index.php?subject=school");
    die();
}
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>TheSchool</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="newcss.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
<?php

include 'view/header.php';
    switch ($_GET['subject']) {

        case 'student':
            include 'view/students.php';
            break;

        case 'admins':
            include 'view/admins.php';
            break;
    }
 ?>
    </body>
    <script src="" type="text/javascript"></script>
</html>