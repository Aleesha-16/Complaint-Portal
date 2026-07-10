<?php

session_start();

include "db.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];

    $password = $_POST['password'];

    $query = mysqli_query($conn,

    "SELECT * FROM users
    WHERE email='$email'
    AND password='$password'");

    if(mysqli_num_rows($query)>0){

        $user = mysqli_fetch_assoc($query);

        $_SESSION['user_id'] = $user['id'];

        $_SESSION['name'] = $user['name'];

        $_SESSION['role'] = $user['role'];

        // ROLE CHECK

        if($user['role']=="admin"){

            header("Location: admin/admin_dashboard.php");

        }else{

            header("Location: dashboard.php");

        }

    }else{

        echo "<script>
        alert('Invalid Email or Password');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-box">

<h1>🔐 Login</h1>

<form method="POST">

<input
type="email"
name="email"
placeholder="Enter Email"
required>

<input
type="password"
name="password"
placeholder="Enter Password"
required>

<button name="login">

Login

</button>

</form>

<div class="auth-switch">

<p>
Don't have an account?
</p>

<a href="register.php">
Create Account
</a>

</div>

</div>

</body>
</html>