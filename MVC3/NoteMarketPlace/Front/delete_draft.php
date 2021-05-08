<?php
include "db.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

$delete_query = "UPDATE notes SET IsActive=0 WHERE id=$id";
mysqli_query($conn, $delete_query);


if ($delete_query) 
    header('Location:Dashboard-1.php');
}
?>

