<?php
//$con = mysqli_connect('localhost','root','','works');
//if (!$con) {
//  die('Could not connect: ' . mysqli_error($con));
//}
//
//mysqli_select_db($con,"works");


// Create database connection
$db = new mysqli('localhost', 'root', '', 'works');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Query to get columns from table
$query = $db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'works' AND TABLE_NAME = 'work-data'");

while($row = $query->fetch_assoc()){
    $result[] = $row;
}

// Array of all column names
$columnArr = array_column($result, 'COLUMN_NAME');

exit( json_encode( $columnArr ) );
//print_r($columnArr);
//$sql="SHOW COLUMNS FROM work-data";
//$result = mysqli_query($con,$sql);
////$row = mysqli_fetch_array($result);
//print_r($result);


//echo "<table>
//<tr>
//<th>Firstname</th>
//<th>Lastname</th>
//<th>Age</th>
//<th>Hometown</th>
//<th>Job</th>
//</tr>";
//while($row = mysqli_fetch_array($result)) {
//  echo "<tr>";
//  echo "<td>" . $row['FirstName'] . "</td>";
//  echo "<td>" . $row['LastName'] . "</td>";
//  echo "<td>" . $row['Age'] . "</td>";
//  echo "<td>" . $row['Hometown'] . "</td>";
//  echo "<td>" . $row['Job'] . "</td>";
//  echo "</tr>";
//}
//echo "</table>";
//mysqli_close($con);
?>