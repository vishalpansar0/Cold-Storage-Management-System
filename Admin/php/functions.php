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
      public function editStorage($id){
          $sql = "SELECT * FROM Storage WHERE s_id='$id'";
          $result = $this->con->query($sql);
          return $result;
      }
      public function updateStorage($Uname,$Ucost,$Uqty,$Udesc,$id,$cons){
          $re = $Uqty-$cons;
        $sql1 = "UPDATE Storage SET name='$Uname',cost='$Ucost',quantity='$Uqty',description='$Udesc',remains='$re' WHERE s_id='$id'";      
        if($this->con->query($sql1)===true){
            return true;
        }
        else{
            return false;
        }
      }
}


?>