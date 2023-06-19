<?php
require "konek.php";
$find= mysqli_select_db($mysqli, $database);

if(isset($_POST['login'])){
$email = $_POST['email'];
$ubah=$_POST['password'];
$password=md5($ubah);
 
$query = "SELECT * FROM user where email='$email' AND password='$password'";
$data= mysqli_query($mysqli, $query);
$result= mysqli_fetch_assoc($data);
$cek = mysqli_num_rows($data);

$query2 = "SELECT * FROM admin where email='$email' AND password='$password'";
$data2= mysqli_query($mysqli, $query2);
$result2= mysqli_fetch_assoc($data2);
$cek2 = mysqli_num_rows($data2);

if($cek){
    session_start();
    $_SESSION["user"] = $result;
    header("Location: home_user.php");
}else if($cek2){
    session_start();
    $_SESSION["admin"] = $result2;
    header("Location: home_admin.php");
}else {
    echo '<script>alert("Email atau password salah")</script>';
}
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body class="text-center bg-light">
    
    <main class="form-signin w-100 m-auto">
    <div class="card" style="margin:100px 450px 20px 450px;">
    <div class="card-body">
        <form method="post">
          <h2 class="mb-3 fw-normal">Login</h1>
          <h3 class="mb-3 fw-normal text-primary">Desicion Support System</h3>
          
          <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating" style="margin-top: 10px;">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <hr>
          <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Masuk</button>
          <p class="mb-3 fw-normal">Belum punya akun? <a href="daftar.php">Daftar</a></p>
          
        </form>
</div>
</div>
      </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>