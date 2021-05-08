<?php
include "../front/db.php";
session_start();

$search_str = (isset($_GET['search'])) ? $_GET['search'] : " ";
$seller_id=(isset($_GET['seller']))?$_GET['seller']:" ";


$under_notes_query="SELECT n.ID,n.Note_Title,n.SellerID,n.CreatedDate,n.Status,c.Category_name,u.FirstName,u.LastName,r.Value
 FROM notes n LEFT JOIN category c ON n.Category=c.ID LEFT JOIN users u ON n.SellerID=u.ID LEFT JOIN 
 referencedata r ON n.Status=r.ID WHERE (n.Status=8 OR n.Status=7)";

$searchQuery=" ";

if(isset($_GET['search']) && !empty($_GET['search']))
{
	$searchQuery .=" AND (n.Note_Title LIKE '%{$search_str}%' OR c.Category_name LIKE '%{$search_str}%')";
}

if(isset($_GET['seller']) && !empty($_GET['seller']))
{
	$searchQuery .=" AND (n.SellerID=$seller_id)";  
}


$under_notes_query=$under_notes_query . $searchQuery." ORDER BY n.CreatedDate DESC";

$result=mysqli_query($conn,$under_notes_query);


?>
<style>

.general-table-responsive .table-bordered tr td,
.general-table-responsive .table-bordered tr th {
    white-space: nowrap;
}

</style>
<div class="container">
    <div class="in-progress-notes-table general-table-responsive">
        <div class="table-responsive-xl">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Sr no.</th>
                        <th scope="col">Note title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Seller</th>
                        <th scope="col"></th>
                        <th scope="col">Date Added</th>
                        <th scope="col">status</th>
                        <th scope="col" class="text-center">action</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                <?php

                $sr_no = 1;
                while ($row = mysqli_fetch_assoc($result)){
                    $noteid = $row['ID'];
                    $sellerid = $row['SellerID'];
                    $title = $row['Note_Title'];
                    $category = $row['Category_name'];
                    $status = $row['Value'];
                    $createddate = $row['CreatedDate'];
                    $seller = $row['FirstName'] ." " .$row['LastName'] ;
                ?>

                    <tr>
                        <td class="text-center"><?php echo $sr_no ; ?></td>
                        <td class="purple-td">
                                <a style="color:#6255a5;" href="note-detail.php?noteid=<?php echo $noteid; ?>">
                                    <?php echo $title; ?>
                                </a>
                        </td>
                        <td><?php echo $category ; ?></td>
                        <td><?php echo $seller; ?></td>
                        <td class="text-center">
                        <a href='members-detail.php?id=<?php echo $sellerid ; ?> '>
                            <img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="edit">
                        </td>
                        <td><?php echo $createddate ; ?></td>
                        <td><?php echo $status ; ?></td>
                        <td>

                            <button class="btn action-btn-in-table" id="approve-btn"  data-id="<?php echo $noteid ?>" data-target="#approve" data-toggle="modal" >Approve</button>
                            <button class="btn action-btn-in-table" id="reject-btn"  data-id="<?php echo $noteid ?>" data-title="<?php echo $title ?>" data-target="#reject" data-toggle="modal">Reject</button>
                            <button class="btn action-btn-in-table" id="inreview-btn"  data-id="<?php echo $noteid ?>" data-target="#inreview" data-toggle="modal">InReview</button>
                        </td>
                        <td class="text-center visible-overflow-for-dropdown">
                            <div class="dropdown dropdown-dots-table">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="note-detail.php?noteid=<?php echo $noteid; ?>">View More Details</a>                                                
                                    <a class="dropdown-item" href="notes-under-review.php?dnote_id=<?php echo $noteid  ?>">Download Notes</a>
                                </div>
                            </div>                                            
                        </td>
                    </tr>

                <?php $sr_no++ ; } ?>

                </tbody>
            </table>                
        </div>
    </div>
</div>  


<!-- Approve confirm Pop up -->
<div class="popup">
    <div style="margin-top: 200px;" class="modal fade " id="approve" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="images/notes-detail/close.png" alt="">
                    </button>
                </div>
                <form action="notes-under-review.php" method="POST">
                    <div style="margin-top: 20px;" class="modal-body">
                        <p class="title">If you approve the notes – System will publish the notes over portal.<br> Please press yes to continue. </p>

                        <input type="hidden" name="approve_note_id" id="approve_note_id">
                        <button class="btn btn-purple" style="width: 60px;" name="approve_btn">YES</button>
                        <button class="btn btn-purple" style="width: 60px;">No</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<!-- Approve popup end  -->


<!-- reject popup -->
<div id="note-under-review">            
        <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="images/notes-detail/close.png" alt="">
                        </button>
                    </div>
                    <div class="modal-body">   
                     <form action="notes-under-review.php" method="POST">   
                        <p style="font-size:22px;color:#6255a5;margin-bottom:30px;" class="add-review-heading" id="reject_note_title"></p> 
                                               
                        <div class="form-group">
                            <input type="hidden" name="reject_note_id" id="reject_note_id">

                            <label class="info-label" for="comment-questions">Remarks</label>
                            <textarea class="form-control input-box-style" name="remark"  placeholder="Write remarks"></textarea>
                        </div>

                        <div class="reject-popup-btns">
                            <div class="row no-gutters">
                                <button style="background:red;color:white;margin-right:10px;" class="btn action-btn-in-table"  name="reject_yes">Reject</button>
                                 <button class="btn action-btn-in-table" id="cancel-btn">Cancel</button>
                            </div>
                        </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
</div>

 <!-- Reject popup -->
<!-- inreview  Pop up -->
<div class="popup">
    <div style="margin-top: 200px;" class="modal fade " id="inreview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="images/notes-detail/close.png" alt="">
                    </button>
                </div>
                <form action="notes-under-review.php" method="POST">
                    <div style="margin-top: 20px;" class="modal-body">
                        <p class="title">Via marking the note In Review – System will let user know that review process has been initiated. <br>Please press yes to continue.  </p>

                        <input type="hidden" name="inreview_note_id" id="inreview_note_id">
                        <button class="btn btn-purple" style="width: 60px;" name="inreview_btn">YES</button>
                        <button class="btn btn-purple" style="width: 60px;">No</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<!-- inreview popup end  -->

<script>
  
    $(document).ready(function () {
        
        var admin_table = $('#myTable').DataTable({
            //"order": [[5,"desc" ]],
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

    //note id for approve
    $(document).on("click", "#approve-btn", function() {
        $("#approve_note_id").val($(this).data("id"));
    });

    //note id for review
    $(document).on("click", "#inreview-btn", function() {
        $("#inreview_note_id").val($(this).data("id"));
    });

    // noteid and title for reject
    $(document).on("click", "#reject-btn", function() {
        $("#reject_note_title").html($(this).data("title"));
        $("#reject_note_id").val($(this).data("id"));
    });
    </script>

   <!--  datatable js -->
   <script src="js/datatables.js"></script>        