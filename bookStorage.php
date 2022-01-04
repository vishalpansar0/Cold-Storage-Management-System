<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>
<?php
   $s_id = $_GET['sid']; 
   $u_id = $_GET['uid'];
   if(empty($u_id)){
    header("Location: index.php");   
   }
   if(!empty($s_id)){
        $sql = "SELECT * FROM Storage WHERE s_id='$s_id'";
      
         $result = $connection->query($sql);
         while($row=$result->fetch_assoc()){
             $img = $row['img_path'];
             $name=$row['name'];
             $cost = $row['cost'];
             $stqty = $row['quantity'];
             $desc = $row['description'];
             $remains = $row['remains'];
         }

   }
   else{
       header("Location: index.php");
   }
   if(isset($_POST['submit'])){
       $reqQty = $_POST['reqQty'];
       $startD = $_POST['startDate'];
       $endD = $_POST['endDate'];
       if($reqQty>$remains){
          $_SESSION['e']  = '<div class="container mt-4"><div class="alert alert-warning">Not that much storage available!</div></div>';
       }else{
          if($startD>$endD){
            $_SESSION['e']  = '<div class="container" mt-4><div class="alert alert-warning">Start Date should not exceed end date!</div></div>';
          }
          else{
              $c = $cost*$reqQty;
              $s = "INSERT INTO Orders(u_id,item_quantity,cost,order_date,end_date,s_id) VALUES('$u_id','$reqQty','$c','$startD','$endD','$s_id')";
              $Ucons = $consu + $reqQty;
              $r = $remains-$reqQty;
              $s2 = "UPDATE Storage SET remains='$r',consumed='$Ucons' WHERE s_id='$s_id'";
              $connection->query($s);
              $connection->query($s2);
              header("Location: user-dashboard.php");
          }
       }
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/74ae24f2bf.js" crossorigin="anonymous"></script>
</head>

<body>
<?php
          if(isset($_SESSION['e'])){
              $err = $_SESSION['e'];
              $_SESSION['e']=null;
              unset($_SESSION['e']);
              echo $err;
          }
         ?>
    <div class="container">
        <div class="row" style="margin-top:50px">
            <div class="col-6">
                <img src="Admin/<?php echo $img; ?>" alt="storage image"
                    style="border-radius:10px;height:400px;width:100%">
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6 text-center">
                        <h3 style="color:red">Storage Name</h3>
                        <h3 style="color:steelblue"><?= $name; ?></h3>
                    </div>
                    <div class="col-6 text-center">
                        <h3 style="color:red">Storage Cost/Unit</h3>
                        <h3 style="color:steelblue"><?= $cost; ?></h3>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <h4 style="color:black">Description</h4>
                        <h4 style="color:steelblue"><?= $desc; ?></h4>
                    </div>
                </div>
                <div class="row">
                <form method="post">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="row">
                                    <div class="mb-2">
                                        <label for="exampleFormControlInput1">Choose Start Date</label>
                                        <input type="datetime-local" name="startDate" class="form-control"
                                            id="exampleFormControlInput1" required>
                                    </div>
                                </div>
                              
                                <div class="row">
                                    <div class="mb-2">
                                        <label for="exampleFormControlTextarea1">Choose End Date</label>
                                        <input type="datetime-local" class="form-control" name="endDate" id="exampleFormControlTextarea1"
                                             required></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2">
                                        <label for="exampleFormControlInput1">Enter Required Space Quantity</label>
                                        <input type="number" min="1" max="<?php echo $remains; ?>" name="reqQty" class="form-control"
                                            id="exampleFormControlInput1" required>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" name="submit" class="btn"
                                        style="width:100%;background-color:lightblue">Book Storage
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <div class="fixed-bottom"><?php include 'footer.php';?></div>
</body>

</html>