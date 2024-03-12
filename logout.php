<?php
  session_start();

  unset($_SESSION['user_id']);
  unset($_SESSION['idTokenString']);

  header('Location: login.php');
  exit();
?>
