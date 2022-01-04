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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/74ae24f2bf.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <title>Friends & Storages</title>
    <style>
    body {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        backdrop-filter: blur(3px);
        background-image: url("images/mainWall.jpg");
        background-repeat: no-repeat, repeat;
        background-color: #cccccc;
        background-size: cover;

    }

    .table .tbody tr td {
        color: black;
    }
    </style>

</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-user-shield" style="color:#922B21"> ADMIN PANEL</i>
            </a>

            <p style="float:right;color:#922B21;font-size:20px;margin-top:8px"><a href="admin-panel.php"style="text-decoration:none;color:#922B21;margin-right:15px">DASHBOARD</a><a href="logout.php"
                    style="text-decoration:none;color:#922B21"><i class="fa fa-sign-out-alt">&nbsp;</i>Logout</a></p>

        </div>
    </nav>
    <?php 
    // unset($_SESSION['error']);
    if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);}
        echo $error;
    ?>



    <div class="container">
        <div class="btn-section mt-4 text-center">
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-success" title="Add Storage" data-bs-toggle="modal"
                        data-bs-target="#newStorageAddModel">Add New Storage</button>
                </div>
                <div class="col-md-3">
                    <a href="storage-action.php"><button class="btn btn-danger">Delete Storage</button></a>
                </div>
                <div class="col-md-3">
                <a href="storage-action.php"><button class="btn btn-info">Update Storage</button></a>
                </div>
                <div class="col-md-3">
                <a href="bookingsDetails.php"><button class="btn btn-warning">See Bookings</button></a>
                </div>

            </div>
        </div>
    </div>


    <!-- Add New Storage Modal -->
    <div class="modal fade" id="newStorageAddModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><strong>ADD NEW STORAGE</strong></h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                <div class="modal-body">

                    <form action="addnewstorage.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="row">
                                    <div class="mb-2">
                                        <label for="exampleFormControlInput1">Name For Storage</label>
                                        <input type="text" name="storageName" class="form-control"
                                            id="exampleFormControlInput1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="pass">Cost Per UNIT</label>
                                            <input type="number" name="cpu" class="form-control" id="pass">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="qty">Quantity</label>
                                            <input type="number" name="qty" class="form-control" id="qty">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload Storage Image</label>
                                        <input type="file" name="file" id="file" class="form-control form-control-md"  accept=".jeg,.png,.jpeg">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" name="submitNew" class="btn btn-success"
                                        style="width:100%;">CREATE STORAGE
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






    <section class="container py-2 mt-4 mb-4">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="app-stats text-center mt-3"
                    style="color:black;font-family: 'Times New Roman', Times, serif;">Users Queries</h2>
                <div class=" table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead bg-dark" style="color:white;">
                            <tr>
                                <th>Query Id</th>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Query</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                        <?php
                       global $connection;
                       $sql="SELECT * FROM Query";
                       $stmt=$connection->query($sql);
                       while($Datarows = $stmt->fetch_assoc())
                       {
                           $id          = $Datarows["q_id"];
                           $uId         = $Datarows["u_id"];
                           $storage     = $Datarows["username"];
                           $CostItem    = $Datarows["query_msg"];
                          
                    ?>
                        <tbody class="tbody">
                            <tr>
                                <td>#<?php echo  $id;       ?></td>
                                <td> <?php echo  $uId;      ?></td>
                                <td> <?php echo  $storage;  ?></td>
                                <td> <?php echo  $CostItem; ?></td>
                              
                                <td><a href="deleteq.php?id=<?php echo $id; ?>" title="Delete this query" class="btn btn-warning"><i class="fas fa-trash"></i>
                                    </a>
                                    
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

</body>

</html>