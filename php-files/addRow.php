<?php
require "connection.php";
$result = false; 
// Attempt insert query execution
$sql = "INSERT INTO `work-data` (amount, what, why, days, according)
VALUES ('2 hours', 'say what did you do?', 'was done correctlly by me', '30', 'Yes')";

if(mysqli_query($con, $sql)){
    $result = true;
}
 
// Close connection
mysqli_close($con);
exit( json_encode( $result ) );
?>