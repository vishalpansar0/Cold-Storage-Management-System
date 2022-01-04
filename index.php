<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>

<?php
$fun = new Users($connection);
$flag = $fun->isLoggedIn();
if($flag){
    header("Location: user-dashboard.php");
}
$err="";
   if(isset($_POST['submit'])){
       $uname=$_POST['uname'];
       $pass=$_POST['pass'];
       
       $f = $fun->userLogin($uname,$pass);
       if($f){
           $_SESSION['username'] = $uname;
           header("Location: user-dashboard.php");
       }
       else{
           $_SESSION['err'] = "Invalid Credentials! Try Again or Sign Up <a href='signup.php' style='text-decoration:none'>here</a>";
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
    <style>
        .jumbotron{
            height: 91.9vh;
            background-image: url("images/sld2.jpg");
            background-repeat:no-repeat;
            background-size: cover;
            /* background-attachment: fixed; */
        }
        .section{
            
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .section h1{
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
                        <img src="images/iconLogo.png" width="30" height="30" class="d-inline-block align-top"
                            alt=""><span class="mt-4">Friends & Storages</span>

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
                                <a class="nav-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#newStorageAddModel">Sign In</a>
                            </li>
                        </ul>
                       
                    </div>
                </div>
            </nav>
        </div>
<!-- Add New Storage Modal -->
<div class="modal fade" id="newStorageAddModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><strong>SIGN IN</strong></h5>
                    
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                <div class="modal-body">

                    <form method="post">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="row">
                                    <div class="mb-2">
                                        <label for="exampleFormControlInput1">Username</label>
                                        <input type="text" name="uname" class="form-control"
                                            id="exampleFormControlInput1" required>
                                    </div>
                                </div>
                              
                                <div class="row">
                                    <div class="mb-2">
                                        <label for="exampleFormControlTextarea1">Password</label>
                                        <input type="password" class="form-control" name="pass" id="exampleFormControlTextarea1"
                                             required></input>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" name="submit" class="btn"
                                        style="width:100%;background-color:lightblue">Sign In
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <h5>Doesn't Have An Account?<a href="signup.php"> Sign Up Here</a></h5>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid" style="background-color:lightcoral">
    <div class="container text-center">
        <?php
          if(isset($_SESSION['err'])){
              $err = $_SESSION['err'];
              $_SESSION['err']=null;
              unset($_SESSION['err']);
              echo $err;
          }
         ?>
    </div>   
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
                                    <a href="viewStorage.php?id=<?php echo $id; ?>" class="btn btn-success"><i
                                            class="far fa-times-circle">Book</i></a>
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

<?php include('footer.php'); ?>


</body>

</html>