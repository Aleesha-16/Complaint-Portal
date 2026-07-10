 <?php

session_start();
header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");
if($_SESSION['role']!="admin"){

    header("Location: ../login.php");

}
?>
 <?php
include "../db.php";
$totalUsers = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM users")
);

$totalComplaints = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM complaints")
);
?>

<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="../style.css">

</head>

<body>

<div class="main-content">
    <div class="dashboard-top">

<h1>👑 Admin Control Panel</h1>
<div class="stats-grid">

<div class="modern-card total-card">

<h2>
<?php echo $totalUsers; ?>
</h2>

<p>Total Users</p>

</div>

<div class="modern-card resolved-card">

<h2>
<?php echo $totalComplaints; ?>
</h2>

<p>Total Complaints</p>

</div>

</div>
<p>
Manage complaints, users and tracking system
</p>

</div>

<h1>👨‍💻 Admin Dashboard</h1>

<div class="cards-container">

<?php

$query = mysqli_query($conn,
"SELECT * FROM complaints");

while($row=mysqli_fetch_assoc($query)){

?>

<div class="card">

<h2>
<?php echo $row['title']; ?>
</h2>

<p>
<?php echo $row['description']; ?>
</p>

<form method="POST">

<input type="hidden"
name="id"
value="<?php echo $row['id']; ?>">

<select name="status">

<option value="Submitted"
<?php if($row['status']=="Submitted") echo "selected"; ?>>
Submitted
</option>

<option value="Under Review"
<?php if($row['status']=="Under Review") echo "selected"; ?>>
Under Review
</option>

<option value="In Progress"
<?php if($row['status']=="In Progress") echo "selected"; ?>>
In Progress
</option>

<option value="Resolved"
<?php if($row['status']=="Resolved") echo "selected"; ?>>
Resolved
</option>

</select>

<button name="update">
Update
</button>

</form>

</div>

<?php } ?>

</div>

</div>

</body>
</html>

<?php

if(isset($_POST['update'])){

$id=$_POST['id'];

$status=$_POST['status'];

mysqli_query($conn,

"UPDATE complaints
SET status='$status'
WHERE id='$id'");
echo "<script>
alert('Complaint Status Updated');
window.location='admin_dashboard.php';
</script>";

}
?>