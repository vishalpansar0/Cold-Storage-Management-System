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

   if(isset($_POST['delete_btn'])){
    $del_id = $_POST['delete_btn'];
    $s = "DELETE FROM Storage WHERE s_id='$del_id'";
    $connection->query($s);
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

    <section class="container py-2 mt-4 mb-4">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="app-stats text-center mt-3"
                    style="color:black;font-family: 'Times New Roman', Times, serif;">Users Details</h2>
                <div class=" table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead bg-dark" style="color:white;">
                            <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Avatar</th>
                                
                            </tr>
                        </thead>
                        <?php
                       global $connection;
                       $sql="SELECT * FROM Users";
                       $stmt=$connection->query($sql);
                       while($Datarows = $stmt->fetch_assoc())
                       {
                           $id          = $Datarows["u_id"];
                           $Sname       = $Datarows["name"];
                           $CostItem    = $Datarows["username"];
                           $qty         = $Datarows["avatar"];
                           
                    ?>
                        <tbody class="tbody">
                            <tr>
                                <td>#<?php echo  $id;       ?></td>
                                <td> <?php echo  $Sname;      ?></td>
                                
                                <td> <?php echo  $CostItem; ?></td>
                                <td> <?php echo  $qty;      ?></td>
                                 
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

</body>

</html>