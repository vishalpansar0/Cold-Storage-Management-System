<?php require_once('php/connection.php'); ?>
<?php require_once('php/session.php'); ?>
<?php require_once('php/functions.php'); ?>
<?php
    $fun = new storage($connection);
    $flag = false;
    $flag = $fun->isLoggedIn();
    if($flag){
        header("Location: admin-panel.php");
    }
    $error = "";
    if(isset($_POST['submit'])){
        $uname = $connection -> real_escape_string($_POST['email']);
        $pass = $connection-> real_escape_string($_POST['pass']);
        if(!empty($uname) && !empty($pass)){
        if($uname=='admin' && $pass=='test123'){
            $_SESSION['uname'] = 'Admin';
            header("Location: admin-panel.php");
        }
        else{
            $error = '<div class="alert alert-danger">Invalid Credentials!</div>';
        }
        }
        else{
            $error = '<div class="alert alert-danger">Fill All Fields!</div>';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Friends & Storages</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/74ae24f2bf.js" crossorigin="anonymous"></script>
</head>
<body>
    
<nav class="navbar navbar-light">
<div class="container">
  <a class="navbar-brand" href="#">
  <i class="fas fa-user-shield" style="color:#922B21"> ADMIN LOGIN</i>
  </a>
  
  </div>
</nav>
<div class="container">
    <section class="main-section">
        <div class="login" style="margin-top:150px">
        <div class="login-wrap">
            <?php echo $error; ?>
        <form method="post">
           <div class="form-group">
           <div class="form-group">
               <div class="mb-2">
              <label for="exampleFormControlInput1">Username</label>
              <input type="text" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter Username">
              </div>
              <div class="mb-3">
              <label for="pass">Password</label>
              <input type="password" name="pass" class="form-control" id="pass" placeholder="Enter Password">
              </div>
              <div class="mb-2">
                  <button type="submit" name="submit" class="btn btn-success" style="width:100%;background-color:#922B21">LOGIN
                  </button>
              </div>
            </div>
           </div>
        </form>
        </div>
        </div>
        
    </section>
</div>

</body>
</html>