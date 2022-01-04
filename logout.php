<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>
<?php
  $_SESSION['username'] = null;
  $_SESSION['uid'] = null;
  unset($_SESSION['username']);
  unset($_SESSION['uid']);
  // session_destroy();
  header("Location: index.php");
?>