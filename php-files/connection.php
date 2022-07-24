<?php
$con = mysqli_connect('localhost','root','','works');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
?>