<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>

<?php
$error = "";
if(isset($_SESSION['uname'])){
   $uname = $_SESSION['uname'];}
   else{
     header("Location: index.php");
   }
?>
<?php
global $connection;
    //  $fun = new storage($connection);
    if(isset($_POST['submitNew'])){
        $Sname = $_POST['storageName'];
        $cpu = $_POST['cpu'];
        $qty = $_POST['qty'];
        $desc = $_POST['desc'];
        $nameimg = $_FILES['file']['name'];  
        if(!empty($Sname) && !empty($cpu) && !empty($qty) && !empty($desc) && !empty($nameimg)){

            $location = "uploads/";
            $img_path = $location.$nameimg;
          $temp_name = $_FILES['file']['tmp_name'];  
          move_uploaded_file($temp_name, $location.$nameimg);
          $sql = "INSERT INTO Storage(name,cost,quantity,description,img_path,remains) values('$Sname','$cpu','$qty','$desc','$img_path','$qty')";      
          $connection->query($sql);
         header("Location: admin-panel.php");

         }
        else{
            $_SESSION['error'] = '<div class="container"><div class="alert alert-danger">Fill All Required Fields!</div></div>';
            header("Location: admin-panel.php");
        }

        
    }
?>