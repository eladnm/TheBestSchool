<?php
require_once("../conn.php");
require_once('../functions.php');
require_once("../classes/session.php");
require_once("admin.php");
if($session->is_logged_in()) {
  redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  $name = trim($_POST['name']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.
	$found_admin = Admin::authenticate($name, $password);
	
  if ($found_admin) {
    $session->login($found_admin);
    redirect_to("index.php");
  } else {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $name = "";
  $password = "";
}

?>
<html>
  <head>
    <title>Photo Gallery</title>
    <link href="../stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="header">
      <h1>Photo Gallery</h1>
    </div>
    <div id="main">
		<h2>Staff Login</h2>
		<?php echo output_message($message); ?>
		<form action="login.php" method="post">
		  <table>
		    <tr>
		      <td>Name:</td>
		      <td>
		        <input type="text" name="name" maxlength="30" value="<?php echo htmlentities($name); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan="2">
		        <input type="submit" name="submit" value="Login" />
		      </td>
		    </tr>
		  </table>
		</form>
    </div>
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Kevin Skoglund</div>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>
