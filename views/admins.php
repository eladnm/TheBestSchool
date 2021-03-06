<?php
require_once 'functions.php';
require_once 'conn.php';
if (!isset($_SESSION)) {
	session_start();
}
$name = $_SESSION["name"];
$role = $_SESSION["role"];
$image = $_SESSION["image"];
$userimage = $_SESSION["image"];
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
#container {
  display: flex;
 flex-wrap: wrap;
 width: 100%;
 font-family: 'Roboto', serif;
 color: blue;
}

.students_full {
  width: 15%;
}
#edit {
  background-image: url(images/school2.jpg);
background-repeat:no-repeat;
}
.list {
    height: 50%;
    overflow-y: auto;
}
.courses_full {
  width:25%;
}

#searchbox {
    border: 2px solid blue;
    border-radius: 4px;
    width:25%;
}
@media only screen and (max-width: 768px) {
    /* For mobile phones: */
.students_full {
        width: 20%;
        border-radius: 25px;
    }
.courses_full {
  width:20%;
}
#edit {
  width:60%;
  background-image: url(images/school2.jpg);
background-repeat:no-repeat;
}

</style>
<script>


</script>
<main>
    <span class="under_line"></span>
    <div id="container">
     <div class="students_full">
            <span>Students:</span><button id="add_student_button" title="Add a new student">+</button><div class= "list">
 <?php $students = Student::find_all();
foreach ($students as $student) {
	//echo "id: ". $student->id ."<br />";
	echo $student->name . "<br />";
	echo $student->phone . "<br />";
	//echo "email: ". $student->email . "<br />";
	//echo "image: ". $student->image . "<br />";
	echo '<img src="' . $student->image . '" height="100" width="100"><br /> ';
	echo "<a href='views/partials/edit-student.php?id=" . $student->id . "' class='edit_student_button'>Edit</a>";
	echo "<a href='views/delete-student.php?id=" . $student->id . "'>Delete</a>";
}
?>
</div>
</div>
          <div class="courses_full">
            <span>Courses:</span><button id="add_course_button" title="Add a new course">+</button><div class= "list"> <?php $courses = Course::find_all();
foreach ($courses as $course) {
	//echo "id: ". $course->id ."<br />";
	echo $course->name . "<br />";
	//echo "descr: ". $course->descr . "<br />";
	echo '<img src="' . $course->image . '" height="150" width="260"><br /> ';
	echo "<a href='views/partials/edit-course.php?id=" . $course->id . "' class='edit_course_button'>Edit</a>";
	echo "<a href='views/delete-course.php?id=" . $course->id . "'>Delete</a>";
}
?>
       </div>
      </div>
        <div id="edit">
<?php include "edit-index.html"
?>
       </div>
</div>
<script type="text/javascript" src="javascript/app.js"></script>
</main>
