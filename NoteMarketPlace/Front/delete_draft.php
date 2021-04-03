<?php
include "db.php";

$id = $_GET['ID'];

$id = mysqli_real_escape_string($conn, $id);

$delete_query = "UPDATE notes SET IsActive=0 WHERE ID=$id";
mysqli_query($conn, $delete_query);


if ($delete_query) {
    header('Location:Dashboard-1.php');
} else {
    echo "Query Failed for Id=" . $id . "<br>Refresh the page<br>" . "<a href='Dashboard-1.php'>Dashboard</a>";
    echo "<br><br><a href='http://localhost/NotesMarketPlace/front/delete_draft.php?ID=$id'>Retry!</a>";
}
?>

