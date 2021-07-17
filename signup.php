<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exits = false; 

    //check whether username exists
    $existsql = "SELECT * FROM  `users`WHERE username = 'username'";
    $result = mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result);

    if ($numExistRows > 0) {

      $showError = "username already exist!";
    }

    // if (($password == $cpassword) && $exits == false) {
    if (($password == $cpassword)) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = true;
      }
      else{

        $showError = "Password do not match";
      }
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Signup </title>
  </head>
  <body>

<?php require 'partials/_nav.php'  ?>

<?php 
if($showAlert){
        
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong> Success!</strong> You are loggedin
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden = "true">&times;</span>
  </button>
  </div>';

}
if($showError){

  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> Error!</strong> '. $showError.' 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden = "true">&times;</span>
  </button>
  </div>';

    }
?>
    <div class="container mt-4">

   <h2 class="text-center"> Signup to our website </h2>

   <form action = "/loginsystem/signup.php" method = "post">

  <div class="form-group mt-4">
    <label for="username">Username</label>
    <input type="text" name = "username" class="form-control" id="username" aria-describedby="emailHelp">
   
  </div>

  <div class="form-group mt-4">
    <label for="password">password</label>
    <input type="password" name = "password" class="form-control" id="password" aria-describedby="emailHelp">
  </div>
  
  <div class="form-group mt-4">
    <label for="password">Confirm Password</label>
    <input type="password" name = "cpassword" class="form-control" id="cpassword" aria-describedby="emailHelp">
    <small class="form-text text-muted" id ="emailHelp"> Make sure type the same password </small>

  </div>

  <button type="submit" class="btn btn-primary mt-4">SignUp</button>

</form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
   

  </body>
  </html