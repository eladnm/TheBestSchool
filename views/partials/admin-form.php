<?php
?>
<form id="formAdmin" action="" enctype="multipart/form-data" method="post">
	<div>
		<?php if ($id != '') {?>
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<?php }?>
		<strong>ID Number: *</strong>
		<input type="text" required name="id1" id="id" value="<?php echo $id; ?>"/><br/>
		<strong>Role: *</strong>
		<input type="text" required name="id1" id="role" value="<?php echo $role; ?>"/><br/>
		<strong>Name: *</strong>
		<input type="text" required name="name" id="name"
		value="<?php echo $name; ?>"/><br/>
		<strong>Phone: *</strong><br/>
		<input type="phone" required name="phone" id="phone" value="<?php echo $phone; ?>"/><br/>
		<strong>Email: *</strong><br/>
		<input type="email" required name="email" id="email" value="<?php echo $email; ?>"/>
<div id="label">Upload Image: *</div>
		<input type="file" id="imageUpload" name="imageUpload"/></input>

		<p>* Required</p>
		<div id="success_message" class="ajax_response" style="float:left"></div>
   <div id="error_message" class="ajax_response" style="float:left"></div>
			<button type="submit" id="fire" name="submit">Submit</button>
<?php
