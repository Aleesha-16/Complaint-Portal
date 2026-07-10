<div class="sidebar">

<h2>🚀 Portal</h2>

<!-- USER INFO -->

<div class="user-box">

<h3>

<?php echo $_SESSION['name']; ?>

</h3>

<?php
if(isset($_SESSION['role']) &&
$_SESSION['role']=="admin"){
?>

<p class="admin-badge">

👑 ADMIN

</p>

<?php }else{ ?>

<p class="user-badge">

🙋 USER

</p>

<?php } ?>

</div>

<!-- LINKS -->
<a href="index.php">
🏠 Home
</a>
<a href="dashboard.php">
📊 Dashboard
</a>

<a href="add_complaint.php">
➕ Add Complaint
</a>

<a href="complaints.php">
📂 Complaints
</a>

<a href="track.php">
📍 Tracking
</a>

<!-- ADMIN ONLY -->

<?php
if(isset($_SESSION['role']) &&
$_SESSION['role']=="admin"){
?>

<div class="admin-section">

<h4>ADMIN PANEL</h4>

<a href="admin/admin_dashboard.php">
👨‍💻 Admin Dashboard
</a>

<a href="admin/manage_users.php">
👥 Manage Users
</a>

<a href="admin/manage_complaints.php">
🛠 Manage Complaints
</a>

</div>

<?php } ?>

<a href="logout.php">
🚪 Logout
</a>

</div>