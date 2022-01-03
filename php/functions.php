<?php require_once('connection.php'); ?>
<?php require_once('session.php'); ?>
<?php
  class storage{
      private $con; 
      function __construct($con)
      {
          $this->con = $con;
      }
      public function isLoggedIn(){
          if(isset($_SESSION['uname'])){
              return true;
          }
          else{
              return false;
          }
      }
}


?>