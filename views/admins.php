<?php
require_once 'functions.php';
require_once 'conn.php';
$name = $_SESSION["name"];
$role = $_SESSION["role"];
$image =$_SESSION["image"];

//$dirname = "/images/";
//$images = glob($dirname."*.jpg");
/* long method
$admin_set = Admin::find_all();
while ($admin = $database->fetch_array($admin_set)) {
  echo "Name: ". $admin['name'] ."<br />";
  echo "id: ". $admin['id'] . "<br />";
  echo "Email: ". $admin['email'] . "<br />";
  echo "Phone: ". $admin['phone'] . "<br />";
}


$admin=Admin::find_by_id(54547852);
echo $admin->full_details();
echo "<hr />";
*/
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
  width: 20%;

}
.list {
    height: 50%;
    overflow-y: auto;
}
.courses_full {
  width:30%;
}
#edit {
  width:50%;
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
        background: #73AD21;
    }
.courses_full {
      width:70;
    }
#searchbox {
    border: 2px solid blue;
    border-radius: 4px;
}
}
</style>
<script>

$(document).ready(function(){
  $("#add_student_button").click(function(){
    $("#edit").load('views/students-container.php', function () {
      $('#formm').submit(function(e) {
        e.preventDefault();     
        //var dataString = $('#formm').serializeArray();
        var formData = new FormData();
        formData.append('name', $("#name").val());
        formData.append('phone', $("#phone").val());
        formData.append('email', $("#email").val());
        formData.append('id', $("#id").val());
        formData.append('submit', 'submit');
        formData.append('imageUpload', $('#imageUpload').get(0).files[0])
        //var name = $("#name").val();
        //var id = $("#id").val();
       //var phone = $("#phone").val();
       //var email = $("#email").val();
       //var image = $("#image").val();
       // var dataString = 'name='+ name + '&phone='+ phone +'&email='+ email + '&image='+ image

        $.ajax({
                type: "post",
                url: "http://localhost/school_project/add-student.php",
                processData: false,
                contentType: false,
                data: formData,
                success: function(result){
                  console.log(result);
                }
          });
        }); 
    });
  });
});
$(document).ready(function(){
  $("#add_course_button").click(function(){
    $("#edit").load('views/courses-container.php', function () {
      $('#form_course').submit(function(e) {
        e.preventDefault();     
        var name = $("#name").val();
        var id = $("#id").val();
       var descr = $("#descr").val();
       var image = $("#image").val();
       var dataString = 'name='+ name + '&descr='+ descr +'&image='+ image

        $.ajax({
                type: "post",
                url: "http://localhost/school_project/add-course.php",
                data: dataString,
                success: function(result){
                alert(result);
              }
          });
        }); 
    });
  });
});
</script> 
<main>
    <h2>School Info:</h2>
    <span class="under_line"></span> 
    <div id="container">
     <div class="students_full">
            <span>Students:</span><button id="add_student_button" title="Add a new student">+</button><div class= "list">
 <?php $students=Student::find_all();
foreach($students as $student) {  
  //echo "id: ". $student->id ."<br />";
  echo $student->name . "<br />";
  echo $student->phone . "<br />";
  //echo "email: ". $student->email . "<br />";
  //echo "image: ". $student->image . "<br />";
  echo '<img src="'.$student->image. '" height="100" width="100"><br /> ';
  echo "<a href='views/students-container.php?id=" . $student->id . "'>Edit</a>";
  echo "<a href='views/delete-student.php?id=" . $student->id . "'>Delete</a>";
}
?>
</div>
</div>
          <div class="courses_full">
            <span>Courses:</span><button id="add_course_button" title="Add a new course">+</button><div class= "list"> <?php $courses=
Course::find_all();
foreach($courses as $course) {
  //echo "id: ". $course->id ."<br />";
  echo $course->name . "<br />";
  //echo "descr: ". $course->descr . "<br />";
  echo '<img src="'.$course->image. '" height="150" width="260"><br /> ';
  echo "<a href='views/courses-container.php?id=" . $course->id . "'>Edit</a>";
  echo "<a href='views/delete-course.php?id=" . $course->id . "'>Delete</a>";
}
?>
       </div>
      </div>
        <div id="edit">
<?php       //include "views/students-container.php" 
        ?>
       </div>
</div>
</main>
