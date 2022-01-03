<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>

<?php
global $connection;
$fun = new storage($connection);
$error = "";
if(isset($_SESSION['uname'])){
   $uname = $_SESSION['uname'];}
   else{
     header("Location: index.php");
   }
   $getID = $_GET['id'];
   if(isset($_POST['submit1'])){
       $Uname = $_POST['Ename'];
       $Ucost = $_POST['Ecost'];
       $Uqty = $_POST['Eqty'];
       $Udesc = $_POST['desc'];
       $Ucons = $_POST['cons'];
       $f = $fun->updateStorage($Uname,$Ucost,$Uqty,$Udesc,$getID,$Scons);
       if(!$f){
        $_SESSION['error'] = '<div class="container"><div class="alert alert-danger">Oops... Error Occurred! Not Updated!</div></div>';
        header("Location: storage-action.php");
       }
       else{
        $_SESSION['error'] = '<div class="container"><div class="alert alert-danger">Successfully Updated!</div></div>';
        header("Location: storage-action.php");
       }
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
        <?php
       $result = $fun->editStorage($getID);
    
       while($Datarows = $result->fetch_assoc()){
           $Sname = $Datarows['name'];
           $Scost = $Datarows['cost'];
           $Sqty = $Datarows['quantity'];
           $Sdesc = $Datarows['description'];
           $Scons = $Datarows['consumed'];
       }
    ?>
        <form method="post">
            <div class="form-group">
                <div class="form-group">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1">Edit Name</label>
                        <textarea type="text" name="Ename" class="form-control" id="exampleFormControlInput1"
                            ><?php echo $Sname; ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pass">Edit Cost</label>
                                <textarea type="text" name="Ecost" class="form-control" id="pass"
                                    ><?php echo $Scost; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="qty">Edit Quantity</label>
                                <textarea type="text" name="Eqty" class="form-control" id="qty"
                                    ><?php echo $Sqty; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1"
                                rows="5"><?php echo $Sdesc; ?></textarea>
                        </div>
                    </div>
                    <input type="text" name="cons" value="<?php echo $Scons; ?>" hidden>
                    <div class="mb-2">
                        <button type="submit" name="submit1" class="btn btn-success" style="width:100%;">EDIT
                        </button>
                    </div>
                </div>
            </div>
        </form>


    </div>





</body>

</html>