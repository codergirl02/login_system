<?php
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // $sql = "Select * from users where username = '$username' AND password = '$password'";
    // $sql = "Select * from users where username = '$username' ";
    $sql = "SELECT * FROM `users` WHERE username = '$username'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);

      if ($num == 1) {
          while ($row = mysqli_fetch_assoc($result)) {
              if (password_verify($password, $row['password'])) {
                 
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("location : welcome.php");

                }
                else{

                    $showError = "Invalid credentials";
                }
            }
        }
      else{
        $showError = "Invalid credentials";
         }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php require 'partials/_nav.php'  ?>

<?php
if($login){
        
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> Success!</strong> You are logged in
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden = "true">&times;</span>
    </button>
    </div>';

}
if($showError){

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> Error! </strong> '. $showError.' 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden = "true"> &times; </span>
    </button>
    </div>';

}
?>

<div class="container my-4">

<h2 class="text-center"> Login to our website </h2>

<form action = "/loginsystem/login.php" method = "post">

<div class="form-group">
 <label for="username">Username</label>
 <input type="text" name = "username" class="form-control" id="username" aria-describedby="emailHelp">

</div>

<div class="form-group">
 <label for="password">password</label>
 <input type="password" name = "password" class="form-control" id="password" aria-describedby="emailHelp">
</div>

<button type="submit" class="btn btn-primary mt-4">Login</button>

</form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
   

</body>
</html>