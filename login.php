<?php
include('inc/config.php');

//$email = $_POST['email'];
//$pass = $_POST['password'];
$email = $_GET['email'];
$pass = $_GET['pass'];

$query = $db->query("SELECT * FROM user WHERE (email = '$email') AND (password = '$pass')");
$jum = mysqli_num_rows($query);
$validate = mysqli_fetch_assoc($query);
$response = array();

if ($jum == 1) {
    $response['code'] = 1;

    $user = array();
    $user["name"] = $validate["name"];
    $user["api"] = $validate["spi"];

    $response['profile'] = $user;

    echo json_encode($response);
} else {
    $response['code'] = 0;
    echo json_encode($response);
}