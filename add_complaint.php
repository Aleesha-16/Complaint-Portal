<?php

include "db.php";

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

if(isset($_POST['submit'])){

    $title = $_POST['title'];

    $description = $_POST['description'];

    $location = $_POST['location'];

    $priority = $_POST['priority'];

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp,"uploads/".$image);

    // Logged in user id
    $user_id = $_SESSION['user_id'];

    // Insert Complaint
    $result = mysqli_query($conn,

    "INSERT INTO complaints
    (user_id,title,description,location,priority,image)

    VALUES

    ('$user_id','$title','$description',
    '$location','$priority','$image')");

    if(!$result){

        die("Query Failed: " . mysqli_error($conn));

    }

    echo "<script>

    alert('Complaint Added Successfully');

    window.location='complaints.php';

    </script>";
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Complaint</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main-content">

<div class="form-box">

<h1>➕ Add Complaint</h1>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="title"
placeholder="Complaint Title"
required>

<textarea
name="description"
placeholder="Complaint Description"
required></textarea>

<input
type="text"
name="location"
placeholder="Location"
required>

<select name="priority">

<option value="Low">Low</option>

<option value="Medium">Medium</option>

<option value="High">High</option>

</select>

<input
type="file"
name="image"
required>

<button name="submit">

Submit Complaint

</button>

</form>

</div>

</div>

</body>
</html>