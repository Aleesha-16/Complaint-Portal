<?php
include "db.php";

$search = $_GET['search'];

$query = mysqli_query($conn,

"SELECT * FROM complaints
WHERE title LIKE '%$search%'");

while($row=mysqli_fetch_assoc($query)){

echo "
<div class='card'>

<h2>".$row['title']."</h2>

<p>".$row['description']."</p>

</div>
";

}
?>