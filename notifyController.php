<?php
session_start();
include_once("DBconnect.php");

if(isset($_POST['sendMess'])) {
  $hostid = (int)$_POST["host_id"];
  $mess_container = $_POST["mess_container"];
  $time = date("d-m-Y") . " " . date("H:i:sa");
  $home_name = $_POST["home_name"];
  $home_address = $_POST["home_address"];
  $place_id = (int)$_POST["place_id"];

  $sql = "INSERT INTO `notify` (`id`, `hostid`, `mess_container`, `time`, `home_name`, `home_address`) VALUES (NULL, '$hostid', '$mess_container', '$time', '$home_name', '$home_address')";
  $conn->exec($sql);
  header("Location: approve_detail.php?id=$place_id");
  exit();
}

if (isset($_POST['del-mess'])) {
  try {
    $id = (int)$_POST["id-mess"];
    $sql = "DELETE FROM `notify` WHERE `notify`.`id` = $id";
    $conn->exec($sql);
    header("Location: notify.php");
    exit();
  } catch (\Exception $e) {

  }
}

?>
