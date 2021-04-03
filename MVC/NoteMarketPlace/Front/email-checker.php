<?php
include "db.php";

$id = $_GET['ID'];
$id = mysqli_real_escape_string($conn, $id);

$query = "UPDATE users SET ISEmailVerified=1 WHERE ID=$id";
mysqli_query($conn, $query);
?>
<h1>Email verified</h1>
<a href="login.php">Click here to login</a>