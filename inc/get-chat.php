<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once __DIR__ . "/../classes/class.chat.php";
    $myid = $_SESSION['unique_id'];
    $oid = $_POST['incoming_id'];
    $chat = new Chat();
    $chat->getChat($myid, $oid);
} else {
    header("location: ../login.php");
}