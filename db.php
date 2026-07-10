<?php

$conn = mysqli_connect(
"127.0.0.1",
"root",
"Alee@268",
"complaintportal",
3306
);

if(!$conn){
die("Connection Failed: " . mysqli_connect_error());
}

?>