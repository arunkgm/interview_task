<?php

require '../vendor/autoload.php';

$con = new mysqli('localhost:3308', 'root', '', 'guvi_task');
$mcon = new MongoDB\Client("mongodb://localhost:27017");

$email = $_POST["email"];
$uname = $_POST["uname"];
$password = $_POST["password"];
$pnumber = $_POST["pnumber"];
$dob = $_POST["dob"];
$degree = $_POST["degree"];
$yop = $_POST["yop"];

$sql = "SELECT * FROM users WHERE uname=?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $uname);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    echo "User Already Exists";
} else {
    $sql = "INSERT into users (uname,pass,email) VALUES (?,?,?)";
    $stmti = $con->prepare($sql);
    $stmti->bind_param('sss', $uname, $password, $email);
    $stmti->execute();
    $stmti->close();

    $db = $mcon->guvitask->users;
    $db->insertOne(['uname' => $uname, 'pnumber' => $pnumber, 'dob' => $dob, 'degree' => $degree, 'yop' => $yop]);
    echo "Registration Successfully";
}

?>