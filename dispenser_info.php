<?php

include('inc/config.php');

$id = $_GET['id'];

$query = $db->query("SELECT * FROM dispenser WHERE id = $id");
$jum = mysqli_num_rows($query);
$dispenser = mysqli_fetch_assoc($query);
$response = array();

if ($jum == 1) {
    $response['code'] = 1;

    $response['place'] = $dispenser["place"];
    $response['floor'] = $dispenser['floor'];

    echo json_encode($response);
} else {
    $response['code'] = 0;
    echo json_encode($response);
}