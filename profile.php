<?php

require '../vendor/autoload.php';

$mcon = new MongoDB\Client("mongodb://localhost:27017");

$uname = $_POST["uname"];
$pnumber = $_POST["pnumber"];
$dob = $_POST["dob"];
$degree = $_POST["degree"];
$yop = $_POST["yop"];

$db = $mcon->guvitask->users;

$db->updateOne(['uname'=>$uname],['$set'=>['pnumber'=>$pnumber,'dob'=>$dob,'degree'=>$degree,'yop'=>$yop]]);
echo "Update Successfully"
?>