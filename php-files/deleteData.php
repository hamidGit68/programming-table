<?php
require "connection.php";
$result = false;
$resultDelete = false;
$resultInsert = false;

$sqlDelete = "TRUNCATE TABLE `work-data`";
if(mysqli_query($con, $sqlDelete)){
    $resultDelete = true;
}

$sql = "INSERT INTO `work-data` (amount, what, why, days, according)
VALUES ('2 hours', 'say what did you do?', 'was done correctlly by me', '30', 'Yes')";

if(mysqli_query($con, $sql)){
    $resultInsert = true;
}

if ($resultDelete && $resultInsert) {
    $result = true;
}
 
// Close connection
mysqli_close($con);
exit( json_encode( $result ) );

?>