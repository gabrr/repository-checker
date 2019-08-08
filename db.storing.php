<?php
require_once('database.php');
require_once('checkingEaq.php');

// $dateYMD = $_POST['user'];
// $mail = $_POST['mail'];
// $pass = $_POST['pass'];




$objDb = new eaq_checker_db();
$link = $objDb->mysqli_connection();

$sql = "insert into User(user, mail, password) values('$user', '$mail', '$pass')";

if (mysqli_query($link, $sql)) {
    echo "Success";
} else {
    echo "Error";
}


?>
