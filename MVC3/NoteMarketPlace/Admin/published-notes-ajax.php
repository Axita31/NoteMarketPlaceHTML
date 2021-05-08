<?php
include "../front/db.php";
session_start();

$search_str = (isset($_GET['search'])) ? $_GET['search'] : " ";
$seller_id=(isset($_GET['seller']))?$_GET['seller']:" ";
$userid=(isset($_GET['userid']))?$_GET['userid']:" ";


$publish_query = "SELECT n.ID,n.Note_Title,c.Category_name,n.Price,r.Value,u.ID AS sellerid,u.FirstName AS sfname,u.LastName AS slname,
 n.PublishedDate, us.FirstName AS apfname ,us.LastName AS aplname FROM notes n LEFT JOIN category c ON n.Category = c.ID
 LEFT JOIN referencedata r ON r.ID = n.Is_Paid LEFT JOIN users u ON u.ID = n.SellerID
  LEFT JOIN users us ON us.ID=n.Actioned_By WHERE n.Status = 9 ";

$add_query=" ";
if (isset($_GET['search']) && !empty($_GET['search'])) {
 $add_query .= " AND (n.Note_Title LIKE '%$search_str%' OR c.Category_name LIKE '%$search_str%' OR  r.Value LIKE '%$search_str%' )";
}

if(isset($_GET['seller']) && !empty($_GET['seller']))
{
 $add_query .=" AND n.SellerID=$seller_id";
}

if(isset($_GET['userid']) && !empty($_GET['userid']) && $userid!=" ")
{
    $add_query .=" AND n.SellerID=$userid";
}

$publish_query=$publish_query.$add_query;
$result=mysqli_query($conn,"$publish_query");


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
                            <th scope="col">Sell type</th>
                            <th scope="col">price</th>
                            <th scope="col">Seller</th>
                            <th scope="col"></th>
                            <th scope="col">published date</th>
                            <th scope="col">Approved By</th>  
                            <th scope="col" class="text-center">Number of<br>downloads</th>
                            <th scope="col" width="80px"></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        $sr_no = 1;
                        while($row = mysqli_fetch_assoc($result)){
                            $noteid = $row['ID'];
                            $title = $row['Note_Title'];
                            $category = $row['Category_name'];
                            $sell_type = $row['Value'];
                            $publisheddate = $row['PublishedDate'];
                            $seller = $row['sfname'] . ' ' . $row['slname'];
                            $sellerid = $row['sellerid'];
                            $approver = $row['apfname'] . ' ' . $row['aplname'];
                            $price = $row['Price'];
                         
                    
                    ?>

                        <tr>
                            <td class="text-center"><?php echo $sr_no ; ?></td>
                            <td class="purple-td">
                                <a style="color:#6255a5;" href="note-detail.php?noteid=<?php echo $noteid; ?>">
                                    <?php echo $title; ?>
                                </a>
                            </td>
                            <td><?php echo $category ; ?></td>                                    
                            <td class="text-center"><?php echo $sell_type ; ?></td>
                            <td><?php echo $price ; ?></td>
                            <td><?php echo $seller ; ?></td>
                            <td class="text-center">
                            <?php
                                echo "
                                <a href='members-detail.php?id=$sellerid'>
                                <img class='eye-img-in-table' src='images/Dashboard/eye.png' alt='edit'></a>";
                            ?>
                            </td>
                            <td><?php echo $publisheddate ; ?></td>

                            <td><?php echo $approver ;?></td>

                            <td class="purple-td text-center">
                                <a style="color:#6255a5;" href="downloaded-notes.php?id=<?php echo $sellerid ?>">
                                    <?php
                                        $download_query = "SELECT DISTINCT DownloaderID FROM downloads WHERE SellerID = $sellerid AND NoteID = $noteid AND IsSellerHasAllowedDownload= 1";
                                        $result2 = mysqli_query($conn,$download_query);
                                        $download_count = mysqli_num_rows($result2);

                                        echo $download_count;
                                    ?>
                                </a>
                            </td>
                            <td class="text-center visible-overflow-for-dropdown">
                                <div class="dropdown dropdown-dots-table">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                    </a>
                            
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="published-notes.php?dnote_id=<?php echo $noteid  ?>">Download Notes</a>
                                        <a class="dropdown-item" href="note-detail.php?noteid=<?php echo $noteid; ?>">View More Details</a>                                                
                                        <a role="button"  data-toggle="modal" data-note_title="<?php echo $title ?>" data-noteid="<?php echo $noteid; ?>"  data-target="#unpublish_box" id="unpublish" class="dropdown-item" href="#">Unpublish</a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php  $sr_no++; } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>    


        
<!-- popup   -->
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
                    <form action="published-notes.php" method="post">
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

<!-- popupend -->

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