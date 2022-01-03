<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>
<?php
  $_SESSION['uname'] = null;
  unset($_SESSION['uname']);
  // session_destroy();
  header("Location: index.php");
?>