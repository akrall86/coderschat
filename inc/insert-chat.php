<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once __DIR__ . "/../classes/class.chat.php";
    $myid = $_SESSION['unique_id'];
    $oid = $_POST['incoming_id'];
    $message = $_POST['message'];
    $chat = new Chat();
    $chat->insertChat($myid, $oid, $message);
} else {
    header("location: ../login.php");
}