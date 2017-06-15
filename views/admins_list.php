<?php
session_start();
$name = $_SESSION["name"];
$role = $_SESSION["role"];
$image = $_SESSION["image"];
$userimage = $_SESSION["image"];
include 'header.php';

?>
<style>
	.list {
		width: 20%;
	}
	#editAdmin {
		width: 80%;
	}
	#containerAdmins {
		display: flex;
	}
	#formAdmin {
		height: 60%;
	}
	input[type=text] {
		display: flex;
		font-size: 22px;
    display: block;
    width: 90%;
    padding: 3px 3px;
    border: 1px solid #a0b3b0;
    color: black;
	}

</style>
<link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" type="text/css" href="../css.css"/>
<div><span>Administrators:</span></div>
<div id="containerAdmins">
<div class= "list">
<?php
require_once "../classes/Admin.php";
$admins = Admin::find_all();
foreach ($admins as $admin) {
	echo $admin->name . "<br />";
	echo "Role: " . $admin->role . "<br />";
	echo "Phone: " . $admin->phone . "<br />";
	//echo "email: ". $admin->email . "<br />";
	echo '<img src="../' . $admin->image . '" height="100" width="100"><br /> ';
	echo "<a href='partials/edit-admin.php?id=" . $admin->id . "' class='edit_admin_button'>Edit</a>";
	echo "<a href='views/delete-admin.php?id=" . $admin->id . "'>Delete</a>";
}
?>
</div>
<div id="editAdmin">
<?php include "edit-index.html"
?>
</div>
</div>
<head>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
</head>
<script>
function handleAdminForm(options) {
  $("#editAdmin").load(options.path, function () {
      $('#formAdmin').submit(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $("#name").val());
        formData.append('phone', $("#phone").val());
        formData.append('email', $("#email").val());
        formData.append('id', $("#id").val());
        formData.append('submit', 'submit');
        formData.append('imageUpload', $('#imageUpload').get(0).files[0])
        $.ajax({
                type: "post",
                url: options.action,
                processData: false,
                contentType: false,
                data: formData,
                success: function(result){
      $('#success_message').fadeIn().html(result);
        setTimeout(function() {
          $('#success_message').fadeOut("slow");
        }, 2000 );
              }
          });
        });
    });
}
  $('.edit_admin_button').click(function (e) {
    var action = this.getAttribute('href');
    e.preventDefault();
    handleAdminForm({
      path: action,
      action: action
    });
  });
</script>