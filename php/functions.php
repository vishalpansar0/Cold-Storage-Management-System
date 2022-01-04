<?php require_once('connection.php'); ?>
<?php require_once('session.php'); ?>
<?php
  class Users{
      private $con; 
      function __construct($con)
      {
          $this->con = $con;
      }
      public function isLoggedIn(){
          if(isset($_SESSION['username'])){
              return true;
          }
          else{
              return false;
          }
      }
      public function userLogin($uname,$pass){
          $sql = "SELECT * FROM Users WHERE username='$uname' AND password='$pass'";
          $result = $this->con->query($sql);
          $row_cnt = $result->num_rows;
          $row = $result->fetch_assoc();
          $_SESSION['uid'] = $row['u_id'];
          if($row_cnt==1){
              return true;
          }
          else{
              return false;
          }
      }
      public function checkUser($uname){
          $sql = "SELECT username FROM Users WHERE username='$uname'";
          $result = $this->con->query($sql);
          $row_cnt = $result->num_rows;
          if($row_cnt>0){
            return true;
          }
          else{
            return false;
          }
      }
}


?>