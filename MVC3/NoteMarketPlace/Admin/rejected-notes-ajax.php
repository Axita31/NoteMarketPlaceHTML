<?php
include "../front/db.php";
session_start();

$search_str = (isset($_GET['search'])) ? $_GET['search'] : " ";
$seller_id=(isset($_GET['seller']))?$_GET['seller']:" ";

 $query = "SELECT DISTINCT n.ID,n.SellerID,n.Note_Title,c.Category_name,u.FirstName AS sellerfname,u.LastName AS sellerlname,
                us.FirstName AS rejectedfname,us.LastName AS rejectedlname,n.CreatedDate,n.Admin_Remarks
                FROM notes n
                LEFT JOIN users u
                ON u.ID=n.SellerID
                LEFT JOIN users us
                ON us.ID=n.Actioned_By
                LEFT JOIN category c
                ON c.ID=n.category
                WHERE n.status=10 AND n.IsActive=1";

$add_query=" ";
if (isset($_GET['search']) && !empty($_GET['search'])) {
 $add_query .= " AND (n.Note_Title LIKE '%$search_str%' OR c.Category_Name LIKE '%$search_str%' )";
}

if(isset($_GET['seller']) && !empty($_GET['seller'])){
 $add_query .=" AND n.SellerID=$seller_id";
}

$query = $query.$add_query;

$result=mysqli_query($conn,$query);


?>


<style>
.general-table-responsive .table-bordered tr td,
.general-table-responsive .table-bordered tr th {
    white-space: unset;
}
</style>

<div class="container">
    <div class="in-progress-notes-table general-table-responsive">
        <div class="table-responsive-xl">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">sr no.</th>
                        <th scope="col">Note title</th>
                        <th scope="col">category</th>                                  
                        <th scope="col">Seller</th>
                        <th scope="col"></th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Rejected By</th>  
                        <th scope="col">Remark</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                <?php

                $sr_no = 1;
                while($row = mysqli_fetch_assoc($result)){
                    $noteid = $row['ID'];
                    $title = $row['Note_Title'];
                    $category = $row['Category_name'];
                    $seller = $row['sellerfname'] . " " . $row['sellerlname'];
                    $sellerid = $row['SellerID'];
                    $rejecter_name = $row['rejectedfname'] . " " . $row['rejectedlname'];
                    $createddate = $row['CreatedDate'];
                    $remark = $row['Admin_Remarks'];

                ?>

                    <tr>
                        <td class="text-center"><?php echo $sr_no; ?></td>
                        <td class="purple-td">
                            <a style="color:#6255a5;" href="note-detail.php?noteid=<?php echo $noteid; ?>">
                            <?php echo $title; ?>
                            </a>
                        </td>
                        <td><?php echo $category; ?></td>                                   
                        <td><?php echo $seller; ?></td>
                        <td class="text-center">
                            <?php
                            echo "
                            <a href='members-detail.php?id=$sellerid'>
                            <img class='eye-img-in-table' src='images/Dashboard/eye.png' alt='edit'></a>";
                            ?>
                        </td>
                        <td><?php echo $createddate; ?></td>
                        <td><?php echo  $rejecter_name; ?></td>
                        <td><?php echo $remark; ?></td>
                        <td class="text-center visible-overflow-for-dropdown">
                            <div class="dropdown dropdown-dots-table">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                </a>
                        
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#confirm-deactive" data-noteid=<?php echo $noteid; ?> id="active-user">Approve</a>
                                    <a class="dropdown-item" href="rejected-notes.php?dnote_id=<?php echo $noteid  ?>">Download Notes</a>
                                    <a class="dropdown-item" href="note-detail.php?noteid=<?php echo $noteid; ?>">View More Details</a>                                                
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php $sr_no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
<!-- confirm Pop up -->
<div class="popup">
        <div style="margin-top: 200px;" class="modal fade " id="confirm-deactive" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="images/notes-detail/close.png" alt="">
                        </button>
                    </div>
                    <form action="rejected-notes.php" method="POST">
                        <div style="margin-top: 20px;" class="modal-body">
                            <p class="title">If you approve the notes – System will publish the notes over portal.<br> Please press yes to continue. </p>

                            <input type="hidden" name="get_note_id" id="get_note_id">
                            <button class="btn btn-purple" style="width: 60px;" name="active_yes">YES</button>
                            <button class="btn btn-purple" style="width: 60px;">No</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
<!-- popup end  -->

<script>
     $(document).on("click", "#active-user", function () {
               var note_id = $(this).data('noteid');
               $("#get_note_id").val( note_id );
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