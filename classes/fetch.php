
<!-- Ark's LUR fetch Function -->
<?php  
 $connect = mysqli_connect("localhost", "root", "", "school-project");  
 $output = '';  
 $sql = "SELECT name FROM students WHERE name LIKE '%".$_POST["search"]."%'";  
 $result = mysqli_query($connect, $sql);  
 if(mysqli_num_rows($result) > 0)  
 {  
      echo $output;  
 }  
 else  
 {  
      echo 'Data Not Found';  
 }  
 ?>