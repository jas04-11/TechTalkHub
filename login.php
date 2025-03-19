<?php
include "db.php";
session_start();


if(isset($_POST["name"]) && isset($_POST["phone"])){

  $name=$_POST["name"];
  $phone=$_POST["phone"];

  $q="SELECT * FROM `user` WHERE uname='$name' && phone='$phone'";
  if($rq=mysqli_query($db,$q)){

    if(mysqli_num_rows($rq)==1){
      
      $_SESSION["userName"]=$name;
      $_SESSION["phone"]=$phone;
      header("location: index.php");



    }else{


      $q="SELECT * FROM `user` WHERE phone='$phone'";
      if($rq=mysqli_query($db,$q)){
        if(mysqli_num_rows($rq)==1){
          echo "<script>alert($phone+' is already taken by another person')</script>";
        }else{

          $q="INSERT INTO `user`(`uname`, `phone`) VALUES ('$name','$phone')";
          if($rq=mysqli_query($db,$q)){
            $q="SELECT * FROM `user` WHERE uname='$name' && phone='$phone'";
            if($rq=mysqli_query($db,$q)){
              if(mysqli_num_rows($rq)==1){

                $_SESSION["userName"]=$name;
                $_SESSION["phone"]=$phone;
                header("location: index.php");

              }
            }

          }

        }
      }
    }
  }


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TechTalk Hub</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <h1>TechTalk Hub</h1>
  <div class="login">
    <h2>Login / Register</h2>
    <p>"A dynamic hub where programmers and tech enthusiasts unite to collaborate, debug, and push the boundaries of innovation." 🚀</p>
    <form action="" method="post">

      <h3>FullName</h3>
      <input type="text" placeholder="Full Name" name="name" required>

      <h3>UserName:</h3>
      <input type="text" placeholder="Enter your unique user name" name="phone" required>

      <button>Login / Register</button>

    </form>
  </div>
</body>
</html>