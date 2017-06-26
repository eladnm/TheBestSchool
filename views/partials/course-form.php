<?php
require_once '../../classes/Course.php';
$_SESSIO['id'] = '$id';
$_SESSIO['image'] = '$image';
$_SESSION['name'] = '$name';
$_SESSION['descr'] = '$descr';
$_SESSION['error'] = '$error';
$_SESSION['course'] = '$course_id';
?>
<html>
<body>
<form id="formm" action="" enctype="multipart/form-data" method="post">
	<div>
<?php if ($id != '') {?>
<?php
$course_students = Course::find_course_students($id);?>
<table style="width: 100%">
	<caption>List of Students Registered to the class: <?php echo $name; ?></caption>
	<tbody>
		<?php foreach ($course_students as $student) {?>
		<tr>
			<td><?php echo $student->name; ?></td>
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
			<strong>Description: *</strong><br/><textarea name="descr" id="descr" rows='6' cols='60'><?php echo $descr; ?></textarea><br/>
			<div id="label">Upload Image: *</div>
		<input type="file" required name="image" id="imageUpload" name="imageUpload"/></input>

		<p>* Required</p>
		<button type="submit" id="fire" name="submit">Submit</button>
		<div id="success_course_message" class="ajax_response" style="float:left"></div>
	   <div id="error_course_message" class="ajax_response" style="float:left"></div>

</body>
</html>
	</div>
	</form>