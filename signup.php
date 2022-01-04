<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>
<?php
require_once('php/connection.php');

$fun=new Users($connection);
$flag = $fun->isLoggedIn();
if($flag){
  header("Location: user-dashboard.php");
}
if(isset($_POST['formdata'])){
    $name =$_POST['fullName'];

    $username    =$_POST['email'];
    $password =$_POST['password'];
   
    $city =$_POST['city'];
    $state =$_POST['state'];
    $zipcode =$_POST['zipcode'];
    // echo " ".$zipcode." ".$name." ".$username." ".$email." ".$password." ".$address." ".$city." ".$state." ";
    $result = $fun->checkUser($username);
    if(!$result){
        $inserdata ="
        INSERT INTO Users (name,username,password,city,state,zip) VALUES (
        '$name','$username','$password','$city','$state','$zipcode')";
        $connection->query($inserdata);
        header("Location: user-dashboard.php");
    }
    else{
      $_SESSION['err'] = "User Already Exists! Try with another email or Sign In <a href='index.php' style='text-decoration:none'>here</a>";
    }
    
    

}


?>


















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styleq.css" rel="stylesheet">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid" style="background-color:lightblue">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color:lightblue">
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
                                <a class="nav-link active" href="index.php">Home</a>
                            </li>
                            
                        </ul>
                       
                    </div>
                </div>
            </nav>
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


<nav class="navbar navbar-light bg-light" style="margin-top:70px">
  <div class="container-fluid">
    <h1 class=""><center>Fill Up all the details</center></h1>
  </div>
</nav>




<form class="row g-3 my-form-class" method="POST">
<div class="col-md-6">
  <label for="inputPassword4" class="form-label">Email</label>
  <input type="email" class="form-control" id="inputPassword4" name="email" required>
</div>
<div class="col-md-6">
  <label for="inputPassword4" class="form-label">Full Name</label>
  <input type="text" class="form-control" id="inputPassword4" name="fullName" required>
</div>

<div class="col-md-6">
  <label for="inputPassword4" class="form-label">Password</label>
  <input type="password" class="form-control" id="inputPassword4"  name="password" required>
</div>

<div class="col-md-6">
  <label for="inputCity" class="form-label">City</label>
  <input type="text" class="form-control" id="inputCity" name="city">
</div>
<div class="col-md-6">
  <label for="inputState" class="form-label">State</label>
  <select id="inputState" class="form-select" name="state">
    <option selected>Choose...</option>
    <option>Andhra Pradesh</option>
    <option>Arunachal Pradesh</option>
    <option>Assam</option>
    <option>Bihar</option>
    <option>Chhattisgarh</option>
    <option>Delhi</option>
    <option>Goa</option>
    <option>Gujarat</option>
    <option>Haryana</option>
    <option>Himachal Pradesh</option>
    <option>Jharkhand</option>
    <option>Karnataka</option>
    <option>Kerala</option>
    <option>Madhya Pradesh</option>
    <option>Maharashtra</option>
    <option>Manipur</option>
    <option>Meghalaya</option>
    <option>Mizoram</option>
    <option>Nagaland</option>
    <option>Odisha</option>
    <option>Punjab</option>
    <option>Rajasthan</option>
    <option>Sikkim</option>
    <option>Tamil Nadu</option>
    <option>Telangana</option>
    <option>Uttar Pradesh</option>
    <option>Tripura</option>
    <option>Uttarakhand</option>
    <option>West Bengal</option>
  </select>
</div>
<div class="col-md-6">
  <label for="inputZip" class="form-label">Zip</label>
  <input type="text" class="form-control" id="inputZip" name="zipcode">
</div>
<div class="col-12">
  <button type="submit" class="btn btn-primary" name="formdata">Sign Up</button>
</div>
</body>
</html>









