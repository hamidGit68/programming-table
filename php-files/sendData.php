<?php
//header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'));
/* save values of data in variables */
$id = intval( $data->id );
$date = $data->date;
$amount = $data->amount;
$what = $data->what;
$why = $data->why;
$days = intval( $data->days );
$according = $data->according;

//$dt = \DateTime::createFromFormat('m/d/Y', $date);
//$dateConvert = $dt->format('Y-m-d');

//$con = mysqli_connect('localhost','root','','works');
//if (!$con) {
//  die('Could not connect: ' . mysqli_error($con));
//}
require "connection.php";

//INSERT INTO `work-data`(`id`, `date`, `amount`, `what`, `why`, `days`, `according`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')

//$sql="SELECT * FROM user WHERE id = '".$q."'";
//$sql = "INSERT INTO `work-data` (id, date, amount, what, why, days, according) VALUES (".$id.", ".$date.", ".$amount.", ".$what.", ".$why.", ".$days.", ".$according.")"; 

$sql = "INSERT INTO `work-data` (id, date, amount, what, why, days, according)
VALUES ('{$id}', '{$date}', '{$amount}', '{$what}', '{$why}', '{$days}', '{$according}') ON DUPLICATE KEY UPDATE date = '{$date}', amount = '{$amount}', what = '{$what}', why = '{$why}', days = '{$days}', according = '{$according}'";



/*
ON DUPLICATE KEY UPDATE date = '".$date."', amount = '".$amount."', what = '".$what."', why = '".$why."', days = '$days', according = '".$according."'";
*/

$result = mysqli_query($con,$sql);
mysqli_close($con);
//$result = false;
//echo $dateConvert;
exit( json_encode( $result ) );
?>