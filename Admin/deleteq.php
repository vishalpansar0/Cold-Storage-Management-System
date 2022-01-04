<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>
<?php
   $id = $_GET['id'];
   $sql = "DELETE FROM Query WHERE q_id='$id'";
   $connection->query($sql);
   header("Location: index.php");
?>