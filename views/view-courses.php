<!DOCTYPE>
<html>
<head>
<title>Add New Course</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h1>View Records</h1>

<?php
// connect to the database
include('../conn.php');

// get the records from the database
if ($result = $connection->query("SELECT * FROM courses ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='50'>";

// set table headers
echo "<tr><th>ID</th><th>Name</th><th>Descrption</th><th>Image</th><th></th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
  echo "id: ". $row->id ."<br />";
  echo "name: ". $row->name . "<br />";
  echo "descr: ". $row->descr . "<br />";
  echo "image: ". $row->image . "<br />";
echo "<td><a href='courses-container.php?id=" . $row->id . "'>Edit</a></td>";
echo "<td><a href='delete-course.php?id=" . $row->id . "'>Delete</a></td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $connection->error;
}

// close database connection
$connection->close();

?>
<a href="courses-container.php">Add New Record</a>
</body>
</html>