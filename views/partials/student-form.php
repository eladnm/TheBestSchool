<?php
if (!isset($_SESSION)) {
	session_start();
}
require_once '../../classes/Course.php';
?>
<form id="formm" action="" enctype="multipart/form-data" method="post">
	<div>
<?php if ($id != '') {
	?>
<?php

	$student_courses = Course::find_student_courses($id);?>

<table style="width: 100%">
	<caption><?php echo $name; ?> is already  participating in the following courses:</caption>
	<tbody>
		<?php foreach ($student_courses as $course) {?>
		<tr>
			<td><?php echo $course->name; ?></td>
		</tr>
		<?php }?>
	</tbody>
</table><br/>
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<?php }?>
		<strong>ID Number: *</strong>
		<input type="text" required name="id1" id="id" value="<?php echo $id; ?>"/><br/>
		<strong>Name: *</strong>
		<input type="text" required name="name" id="name"
		value="<?php echo $name; ?>"/><br/>
		<strong>Phone: *</strong><br/>
		<input type="text" required name="phone" id="phone" value="<?php echo $phone; ?>"/><br/>
		<strong>Email: *</strong><br/>
		<input type="email" required name="email" id="email" value="<?php echo $email; ?>"/>
		</select>

		<div id="label">Select Your Course:</div>

<select name="Course" id="course">
<option value = "">Select Your Course</option>
<?php
$courses = Course::find_all();

foreach ($courses as $course) {
	echo "<option value='{$course->id}'>{$course->name}</option>";
}?></select>
<div id="label">Upload Image: *</div>
		<input type="file" required name="image" id="imageUpload" name="imageUpload"/></input>

		<p>* Required</p>
		<div id="success_message" class="ajax_response" style="float:left"></div>
   <div id="error_message" class="ajax_response" style="float:left"></div>
			<button type="submit" id="fire" name="submit">Submit</button>
	</div>
</form>