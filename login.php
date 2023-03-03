<?php

require '../vendor/autoload.php';

$con = new mysqli('localhost:3308', 'root', '', 'guvi_task');
$mcon = new MongoDB\Client("mongodb://localhost:27017");

$uname = $_POST["uname"];
$password = $_POST["password"];

$sql = "SELECT * FROM users where uname=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $uname);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $stmt->close();
    if ($user['pass'] == $password) {
        $db = $mcon->guvitask->users;
        $dbuser = $db->findOne(['uname' => $uname]);
        echo json_encode(array("status" => "Login Successfully", "uname" => $user['uname'], "email" => $user['email'], "dbuser" => $dbuser));
    } else {
        echo json_encode(array("error" => "Incorect Password"));
    }
} else {
    echo json_encode(array("error" => "User Not Registered"));
}

?>
