<?php
//require_once 'functions.php';
require_once 'conn.php';
$name = $_SESSION["name"];
$role = $_SESSION["role"];
$image =$_SESSION["image"];

$students=Student::find_all();
foreach($students as $student) {
  echo "id: ". $student->id ."<br />";
  echo "name: ". $student->name . "<br />";
  echo "phone: ". $student->phone . "<br />";
  echo "email: ". $student->email . "<br />";
  echo "image: ". $student->image . "<br />";
}