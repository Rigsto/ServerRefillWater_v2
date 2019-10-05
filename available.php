<?php

include('inc/config.php');

$query = $db->query("SELECT * FROM dispenser ORDER BY remain DESC");
$response = array();

while ($row = mysqli_fetch_assoc($query)) {
    $dis = array();
    $dis['place'] = $row['place'];
    $dis['floor'] = $row['floor'];
    $dis['remain'] = ($row['remain'] / $row['max']) * 100;

    array_push($response, $dis);
}

echo json_encode($response);
