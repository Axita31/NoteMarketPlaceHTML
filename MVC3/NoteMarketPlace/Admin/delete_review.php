
<?php
include "../front/db.php";

//get id from url
$id = (isset($_GET['id'])) ? $_GET['id'] : "";
$noteid = (isset($_GET['noteid'])) ? $_GET['noteid'] : "";

//del review query
echo $id;
$query = mysqli_query($conn, "UPDATE sellernotesreviews SET IsActive=0 WHERE ID=$id");
if($query){
    echo "updated";
}else{
    echo "not".mysqli_error($conn);
}

header("Refresh:0");
header("Location:note-detail.php?noteid=$noteid");