<?php
require_once '../../classes/Course.php';
?>
<form id="formm" action="" enctype="multipart/form-data" method="post">
	<div>
		<?php if ($id != '') {?>
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<p>ID: <?php echo $id; ?></p>
		<?php }?>
		<strong>ID Number: *</strong>
		<input type="text" required name="id1" id="id" value="<?php echo $id; ?>"/><br/>
		<strong>Name: *</strong>
		<input type="text" required name="name" id="name"
		value="<?php echo $name; ?>"/><br/>
		<strong>Phone: *</strong>
		<input type="text" required name="phone" id="phone" value="<?php echo $phone; ?>"/><br/>
		<strong>Email: *</strong>
		<input type="email" required name="email" id="email" value="<?php echo $email; ?>"/>
		</select>
		<div id="label">Select Your Course:</div>

<select name="Course" id="course">
<option value = "">Select Your Course</option>
<?php
$courses = Course::find_all();

foreach ($courses as $course) {
	echo "<option value='{$course->id}'>{$course->name}</option>";
}

?>
		<input type="file" id="imageUpload" name="imageUpload"/>

		<p>* required</p>
		<button type="submit" id="fire" name="submit">Submit</button>
	</div>
<?php

$student_courses = Course::find_student_courses($id);?>

<table style="width: 100%">
	<caption>Participating in the following courses:</caption>
	<tbody>
		<?php foreach ($student_courses as $course) {?>
		<tr>
			<td><?php echo $course->name; ?></td>
		</tr>
		<?php }?>
	</tbody>
</table>
