<?php

include "db.php";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check)>0){

        echo "<script>alert('Email Already Exists')</script>";
    }

    else{

        mysqli_query($conn,

        "INSERT INTO users(name,email,password)

        VALUES('$name','$email','$password')");

        echo "<script>

        alert('Registration Successful');

        window.location='login.php';

        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-box">

<h1>Create Account ✨</h1>

<form method="POST">

<input
type="text"
name="name"
placeholder="Enter Full Name"
required
>

<input
type="email"
name="email"
placeholder="Enter Email"
required
>

<input
type="password"
name="password"
placeholder="Enter Password"
required
>

<button name="register">
Register
</button>

</form>
<div class="auth-switch">

<p>
Already have an account?
</p>

<a href="login.php" >
Login Here
</a>

</div>

</div>

</body>
</html>