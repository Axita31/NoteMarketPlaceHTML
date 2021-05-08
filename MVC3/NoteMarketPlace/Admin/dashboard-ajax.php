<?php

include "../front/db.php";
session_start();

if(isset($_GET['search'])){
    $selected_search = $_GET['search'];
}else{
    $selected_search = "";
}

if(isset($_GET['search_month'])&&!empty($_GET['search_month'])){
    $selected_month = $_GET['search_month'];
    $selected_month = explode("-",$selected_month);
}else{
    $selected_month = "";
}

$query_publish_notes="";

$query_publish_notes="SELECT notes.ID,notes.SellerID,notes.Note_Title,notes.Category,notes.Is_Paid,notes.Price,notes.Actioned_By,
notes.PublishedDate,referencedata.Value,users.FirstName,users.LastName,category.Category_name,notesattachment.Path 
FROM notes LEFT JOIN notesattachment ON notes.ID=notesattachment.Note_ID LEFT JOIN users ON notes.SellerID=users.ID 
LEFT JOIN category ON notes.Category=category.ID LEFT JOIN referencedata ON notes.Is_Paid=referencedata.ID 
WHERE notes.Status=9 ";


$query_publish_notes.= " AND (notes.Note_Title LIKE '%$selected_search%' OR category.Category_name LIKE '%$selected_search%' OR 
notes.Price  LIKE '%$selected_search%' OR users.FirstName LIKE '%$selected_search%' OR users.LastName 
LIKE '%$selected_search%' OR referencedata.Value LIKE '%$selected_search%')";

$query_publish_notes.= (!empty($selected_month)&&$selected_month!="")? "AND MONTH(notes.PublishedDate) =$selected_month[1] AND YEAR(notes.PublishedDate) =$selected_month[0] ":"";

$query_publish_notes.=" ORDER BY notes.PublishedDate DESC";
$result=mysqli_query($conn,$query_publish_notes);

/* if($result){
    echo "select";
}else{
    echo "not".mysqli_error($conn);
} */
?>

<style>

.general-table-responsive .table-bordered tr td,
.general-table-responsive .table-bordered tr th {
    white-space: unset;
    overflow: ;
}
</style>
<div class="dashboard-table general-table-responsive">
    <div class="table-responsive-xl">
        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th scope="col">sr no.</th>
                    <th scope="col">title</th>
                    <th scope="col">category</th>
                    <th scope="col">Attachment Size</th>
                    <th scope="col">Sell type</th>
                    <th scope="col">price</th>
                    <th scope="col">publisher</th>
                    <th scope="col">published date</th>
                    <th scope="col" class="text-center">Number of<br>downloads</th>
                    <th scope="col" width="80px"></th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $sr_no = 1 ;
                    while($row = mysqli_fetch_assoc($result)){
                        $noteid = $row['ID'];
                        $sellerid = $row['SellerID'];
                        $title = $row['Note_Title'];
                        $category = $row['Category_name'];
                        $sell_type = $row['Value'];
                        $price = $row['Price'];
                        $date = $row['PublishedDate'];
                        $publishername = $row['FirstName'] . " " . $row['LastName'];
                    
                ?>
                <tr>
                    <td><?php echo $sr_no ; ?></td>
                    <td class="purple-td">
                        <a style="color:#6255a5;" href="note-detail.php?noteid=<?php echo $noteid; ?>">
                            <?php echo $title; ?>
                        </a>
                    </td>
                    <td><?php echo $category ; ?></td>
                    <td class="text-center">10 KB</td>
                    <td class="text-center"><?php echo $sell_type ; ?></td>
                    <td><?php echo $price ; ?></td>
                    <td><?php echo $publishername ; ?></td>
                    <td><?php echo $date ; ?></td>
                    <td class="purple-td text-center">
                    <a href="downloaded-notes.php?note=<?php echo $noteid; ?>" >
                        <?php              
                            $attach_query=mysqli_query($conn,"SELECT DISTINCT DownloaderID FROM downloads WHERE SellerID=$sellerid AND NoteID=$noteid AND IsAttachmentDownloaded=1");
                            $attach_count=mysqli_num_rows($attach_query);
                            echo $attach_count;
                        ?>
                        </a>
                    </td>
                    <td class="text-center visible-overflow-for-dropdown">
                        <div class="dropdown dropdown-dots-table">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="dashboard.php?dnote_id=<?php echo $noteid  ?>">Download Notes</a>
                                <a class="dropdown-item" href="note-detail.php?noteid=<?php echo $noteid; ?>">View More Details</a> 
                                <a role="button"  data-toggle="modal" data-note_title="<?php echo $title ?>" data-noteid="<?php echo $noteid; ?>"  data-target="#unpublish_box" id="unpublish" class="dropdown-item" href="#">Unpublish</a>

                            </div>
                        </div>
                    </td>
                </tr>
            <?php $sr_no++ ; } ?>

            </tbody>
        </table>
    </div>
</div>


<div id="popup">
    <div class="modal fade" id="unpublish_box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="images/notes-detail/close.png" alt="">
                    </button>
                </div>
                <div class="modal-body">
                <form action="dashboard.php" method="post">
                    <p style="font-size:25px;color:#6255a5;margin-bottom:50px;font-weight: 600;" class="add-review-heading" id="get_note_title"></p>
                    
                    <div class="form-group">
                        <label class="info-label" for="comment-questions">Remarks *</label>
                        <textarea style="height:100px;" class="form-control input-box-style" id="" name="remark" placeholder="Remarks..." required></textarea>
                    </div>
                    
                    <input id="get_note_id" name="get_note_id" type="hidden">
                    <div class="form-btn">
                        <button style="width:auto;" type="submit" class="btn btn-general btn-purple" name="unpublish_yes">Unpublish</button>
                        <button style="width:auto;" class="btn btn-general btn-purple" onclick="window.location.href='published-notes.php' " >cancel</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popup end  -->

<script>

    //note title getter via data id
    $(function() {
    $(document).on("click", "#unpublish", function() {
                $("#get_note_title").text($(this).data('note_title'));
                $("#get_note_id").val($(this).data('noteid'));
                $("#unpublish_box").modal('show');
            })
        });

    $(document).ready(function () {

    var admin_table = $('#myTable').DataTable({
        //"order": [[3,"desc" ]],
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            
        },
        'sDom': '"top"i',
        "iDisplayLength": 5,
        "bInfo": false,
        language: {
            "zeroRecords": "No record found",
            paginate: {
                next: "<img src='images/pagination/right-arrow.png' alt='next'>",
                previous: "<img src='images/pagination/left-arrow.png' alt='prev'>"
            }
        }
    });
    });

</script>

 <!--  datatable js -->
 <script src="js/datatables.js"></script>