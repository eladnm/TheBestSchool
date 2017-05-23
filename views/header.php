<?php
 $name = $_SESSION["name"];
 $role = $_SESSION["role"];
 $image =$_SESSION["image"];
 ?>
  <style>
nav{
	background-image: url(images/school.jpg);
background-position: center center;
background-size:100% auto;
}
  .nav_container {
   display: -webkit-flex;
   display: flex;
   -webkit-flex-direction: row; 
   flex-direction: row;
   -webkit-align-items: flex-start;
   align-items: flex-start;
  }
a {
display: flex;
	color: yellow;
  text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;
  text-decoration: bold;
  -webkit-flex: 2 0 0; 
   flex: 2 0 0; 
}
.container_user {

    border: 5px solid blue;
    box-sizing: border-box;

 }

 </style>
<header>
	<nav>
<div class="nav_container">
		<a href="/?subject=admins">School</a>
		<?php 
		// if (Permissions::permit('$_SESSION['role'])) {
		if ($_SESSION['role'] !== 'sales') {
			echo '<a href="/?subject=admins">Administration</a>';
		}
		 ?>
	<div class="container_user">
        <div class="user-name">
            <span><?php echo $name . "," ?></span>
            <span><?php echo $role ?></span>
            <a href="api.php/?action=logout">Log out</a>
        </div>
            <img src= <?php echo $image ?> height="80" width="80" alt="user-image"/>
  </div>
</div>   
	</nav>
</header>