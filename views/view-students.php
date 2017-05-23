<!DOCTYPE>
<html>
<head>
<title>Add New Student</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h1>View Records</h1>

<?php
// connect to the database
include('../conn.php');

// get the records from the database
if ($result = $connection->query("SELECT * FROM students ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>ID</th><th>First Name</th><th>Phone</th><th>Email</th><th>Image</th><th></th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->name . "</td>";
echo "<td>" . $row->phone . "</td>";
echo "<td>" . $row->email . "</td>";
echo "<td>" . $row->image . "</td>";
echo "<td><a href='students-container.php?id=" . $row->id . "'>Edit</a></td>";
echo "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
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
<a href="students-container.php">Add New Record</a>
</body>
</html>