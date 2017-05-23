<?php
require_once('../functions.php');
require_once('../classes/session.php');

if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<html>
  <head>
    <title>Photo Gallery</title>
    <link href="../css/main.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="header">
      <h1>Photo Gallery</h1>
    </div>
    <div id="main">
		<h2>Menu</h2>
		
		</div>
		
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Elad Nahum</div>
  </body>
</html>