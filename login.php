<?php

if (isset($_GET['error']) && $_GET['error'] === 'true') {
	$error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Nachum School</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<div id="container">
<body>
   <h1 class="title"> Please log in</h1>
     <?php
if (isset($error) && $error === true) {
	echo '<h3>One or more credentials is wrong</h3>';
}
?>
  <form action="api.php" method="POST">
  <div id="formContain">
    <input type="hidden" name="action" value="login" id="submit"/>
    <div class="field-wrap">
    <input type="text" name="name" placeholder="Name">
    <input type="password" name="password" placeholder="Password">
    <input id="login_button" type="submit" value="Login">
  </form>
  </div>
</body>
</div>
</html>