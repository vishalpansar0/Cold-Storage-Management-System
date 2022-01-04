<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>

<?php
$fun = new Users($connection);
$flag = $fun->isLoggedIn();
if(!$flag){
    header("Location: index.php");
}
else{
    $user = $_SESSION['username'];
    $uid = $_SESSION['uid'];

}
if(isset($_POST['submitQ'])){
    $que = $_POST['que'];
    if(!empty($que)){
         $sq1 = "INSERT INTO Query(u_id,username,query_msg) VALUES('$uid','$user','$que')";
         $connection->query($sq1);
         $_SESSION['err'] = '<div class="alert alert-success"><div class="container text-center">Query submitted! Team will contact you soon!</div></div>';
    }
    else{
        $_SESSION['err'] = '<div class="alert alert-warning"><div class="container text-center">Query can\'t be empty</div></div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/74ae24f2bf.js" crossorigin="anonymous"></script>
    <style>
    .jumbotron {
        height: 91.9vh;
        background-image: url("images/sld2.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        /* background-attachment: fixed; */
    }

    .section {

        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .section h1 {
        font-size: 3.5em;
        color: lightblue;
        margin-top: 25%;
    }
    </style>


</head>

<body>
    <div class="container-fluid" style="background-color:lightblue">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="images/iconLogo.png" width="30" height="30" class="d-inline-block align-top" alt=""><span
                        class="mt-4">Friends & Storages</span>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="storage" style="border:none;background:none"
                                onclick="storeview()">Storages</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="storage" style="border:none;background:none"
                                onclick="bookview()">My bookings</button>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#newStorageAddModel">Raise Query</a>
                            </li>

                    </ul>


                </div>
                <h5 style="margin-top:7px;float:right;font-weight:300"><i class="fas fa-user"
                        style="color:lightcoral"></i><?php echo " ".$user; ?></h5>
                <a href="logout.php"
                    style="font-size:20px;margin-top:3px;float:right;font-weight:300;text-decoration:none;color:black"><i
                        class="fa fa-sign-out-alt" style="color:lightcoral;margin-left:20px"></i>Logout</a>
            </div>
        </nav>
    </div>
    <!-- Add New Storage Modal -->
<div class="modal fade" id="newStorageAddModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><strong>RAISE QUERY</strong></h5>
                    
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                <div class="modal-body">

                    <form method="post">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="row">
                                    <div class="mb-2">
                                        <label for="exampleFormControlInput1">Enter Your Query</label>
                                        <textarea class="form-control" name="que" id="exampleFormControlTextarea1"
                                            rows="3" required></textarea>
                                    </div>
                                </div>
                              
                                <div class="mb-2">
                                    <button type="submit" name="submitQ" class="btn"
                                        style="width:100%;background-color:lightcoral">Send Your Query
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                </div>
            </div>
        </div>
    </div>
  
    <div class="container-fluid">
        
            <?php
          if(isset($_SESSION['err'])){
              $err = $_SESSION['err'];
              $_SESSION['err']=null;
              unset($_SESSION['err']);
              echo $err;
          }
         ?>
        
    </div>

    <div class="jumbotron jumbotron-fluid">
        <div class="section">
            <h1>Get Best Storage Services At Minimum Cost!</h1>
        </div>
    </div>
    <div class="container-fluid py-2" style="background-color:lightblue">
        <section class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="app-stats text-center mt-3"
                        style="color:black;font-family: 'Times New Roman', Times, serif;">Available Storages</h2>
                    <div class=" table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead bg-dark" style="color:white;">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Cost/Item</th>
                                    <th>Available Quantity</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <?php
                       global $connection;
                       $sql="SELECT * FROM Storage";
                       $stmt=$connection->query($sql);
                       while($Datarows = $stmt->fetch_assoc())
                       {
                           $id          = $Datarows["s_id"];
                           $Sname = $Datarows['name'];
                           $storage     = $Datarows["img_path"];
                           $CostItem    = $Datarows["cost"];
                           $qty         = $Datarows["quantity"];
                           $re = $Datarows['remains'];
                           
                    ?>
                            <tbody class="tbody">
                                <tr>
                                    <td><img src="Admin/<?php  echo $storage;?>" width="150px" height="70px"></td>

                                    <td> <?php echo  $Sname;      ?></td>
                                    <td> <?php echo  $CostItem; ?></td>

                                    <td> <?php echo  $re;    ?></td>

                                    <td>
                                        <a href="bookStorage.php?sid=<?php echo $id; ?>&uid=<?php echo $uid; ?>" class="btn btn-success">Book</a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container-fluid py-2" style="background-color:lightcoral">
        <section class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="app-stats text-center mt-3"
                        style="color:black;font-family: 'Times New Roman', Times, serif;">My Bookings</h2>
                    <div class=" table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead bg-dark" style="color:white;">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Storage Name</th>
                                    <th>Cost/Item</th>
                                    <th>Purchased Quantity</th>
                                    <th>Total Cost</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <?php
                       global $connection;
                       $sql="SELECT * FROM Orders WHERE u_id='$uid'";
                       $stmt=$connection->query($sql);
                       while($Datarows = $stmt->fetch_assoc())
                       {   $sid = $Datarows['s_id'];
                           $sql1="SELECT * FROM Storage WHERE s_id='$sid'";
                           $stmt1=$connection->query($sql1);
                           while($Datarows1 = $stmt1->fetch_assoc()){
                               $Sname1 = $Datarows1['name'];
                               $Scost1 = $Datarows1['cost'];
                           }
                           $bid          = $Datarows["booking_id"];
                         
                           $qty1         = $Datarows["item_quantity"];
                           $Bcost = $Scost1*$qty1;
                           $odate = $Datarows['order_date'];
                           $edate = $Datarows['end_date'];
                           
                    ?>
                            <tbody class="tbody">
                                <tr>
                                    <td> <?php echo  $bid;      ?></td>
                                    <td><a href="bookStorage.php?sid=<?php echo $sid; ?>&uid=<?php echo $uid; ?>" style="text-decoration:none;color:blue"><?php echo  $Sname1; ?></a></td>
                                    <td> <?php echo  $Scost1; ?></td>
                                    <td> <?php echo  $qty1;    ?></td>
                                    <td> <?php echo  $Bcost;    ?></td>
                                    <td> <?php echo  $odate;    ?></td>
                                    <td> <?php echo  $edate;    ?></td>

                                </tr>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php include 'footer.php'?>

</body>

</html>