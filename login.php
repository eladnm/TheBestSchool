<?php
if (isset($_GET['error']) && $_GET['error'] === 'true') {
  $error = true;
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to school</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
  <?php 
  if (isset($error) && $error === true) {
    echo '<h3>One or more credentionals is wrong</h3>';
  }
   ?>
   <h1 class="title"> Please log in</h1>
  <form action="api.php" method="POST">
    <input type="hidden" name="action" value="login" id="submit"/>
    <div class="field-wrap">
    <label>
    <span class="req"></span>
    </label>
    <input type="text" name="name" placeholder="Name">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login">
    <div/>
  </form>
</body>
</html>