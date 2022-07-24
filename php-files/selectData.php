<?php
function queryLoop($queryPara, $connection) {
    $emptyArr = array();
    if ($result1 = mysqli_query($connection, $queryPara)) {
        while ($row = mysqli_fetch_assoc($result1)) {
            array_push($emptyArr, $row);
        }
        mysqli_free_result($result1);
    }
    return $emptyArr;
}

?>
