<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

?>


<!--code download gareko hai soltiko bata-->
<!--code download gareko hai soltiko bata-->

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Owner Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    </div>
  </div>


</div>

<div class="container-fluid">
  <!--Data tables examples ----data-target="#addadminprofile"-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Pending Enquiries
        
      </h6>
    </div>

    <!--card - body - table  show-->
    <div class="card-body">
      <?php
      if (isset($_SESSION['success']) && $_SESSION['success'] != "") { //!empty($_SESSION['status'])
        echo $_SESSION['success'];
        unset($_SESSION['success']);
      }

      if (isset($_SESSION['status']) && $_SESSION['status'] != "") { //!empty($_SESSION['status'])
        echo $_SESSION['status'];
        unset($_SESSION['status']);
      }

      ?>

      <div class="table-responsive">

        <?php
         include_once('C:\xampp\htdocs\HF_Online\includes\DBOperations.php');
         $db = new DBOperations;
         $result = $db->getAllPendingEnquiry();
        
        
        
        // $request_query = "SELECT hrid, hostel_owner_name, hostel_name, hostel_location, hostel_type, contact_number, hostel_email, request_date, status FROM hostel_request ORDER BY status DESC,request_date ASC";

        // $result = mysqli_query($con,$request_query);
/*
$eid, $userid, $ownerid, $user_name, $user_email, $user_phone, $owner_name, $hostel_name, $hostel_address, $enquiry_message, $enquiry_date, $enquiry_status, $enquiry_status_update_date
*/
        ?>


        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Enq. ID</th>
              <th>User ID</th>
              <th>Owner ID</th>
              <th>User Name</th>
              <th>User Email</th>
              <th>User Phone</th>
              <th>Owner Name</th>
              <th>Hostel Name</th>
              <th>Hostel Address</th>
              <th>Enquiry Message</th>
              <th>Enquiry Date</th>
              <th>Enquiry Status</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result) {
              foreach ($result as $res) {
                // echo $res['id'];
                // echo $res['email'];
                // echo $res['username'];
                // echo $res['password'];
            ?>
                <tr>
              
                  <td><?php echo $res['eid']; ?></td>
                  <td><?php echo $res['userid']; ?></td>
                  <td><?php echo $res['ownerid']; ?></td>
                  <td><?php echo $res['user_name']; ?></td>
                  <td><?php echo $res['user_email']; ?></td>
                  <td><?php echo $res['user_phone']; ?></td>
                  <td><?php echo $res['owner_name']; ?></td>

                  <td><?php echo $res['hostel_name']; ?></td>
                  <td><?php echo $res['hostel_address']; ?></td>
                  
                  <td><?php echo $res['enquiry_message']; ?></td>
                  <td><?php echo $res['enquiry_date']; ?></td>
                  <td><?php echo $res['enquiry_status']; ?></td>
                  <td>
                    <form action="enquiry_edit.php" method="post">
                      <input type="hidden" name="edit_enquiry_id" value="<?php echo $res['eid']; ?>">
                      <button type="submit" name="edit_enquiry_btn" class="btn btn-success"> Reviewed</button>
                    </form>
                  </td>
                  <td>
                    <form action="enquiry_edit.php" method="post">
                      <input type="hidden" name="delete_enquiry_id" value="<?php echo $res['eid']; ?>">
                      <button type="submit" name="delete_enquiry_btn" class="btn btn-danger"> DELETE</button>
                    </form>
                  </td>
                </tr>
            <?php

              }
            } else {
              echo "No Remaining Pending enquiry";
            }
            ?>
          </tbody>

        </table>
        <div>
          
        </div>
      </div>

      
      
    </div>

    
    
  </div>
  
  

</div>

    <!--reviewed wala enquiry haru-->


<div class="container-fluid">
  <!--Data tables examples ----data-target="#addadminprofile"-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Reviewed Enquiries
      </h6>
    </div>

    <!--card - body - table  show-->
    <div class="card-body">
      <?php
      if (isset($_SESSION['success']) && $_SESSION['success'] != "") { //!empty($_SESSION['status'])
        echo $_SESSION['success'];
        unset($_SESSION['success']);
      }

      if (isset($_SESSION['status']) && $_SESSION['status'] != "") { //!empty($_SESSION['status'])
        echo $_SESSION['status'];
        unset($_SESSION['status']);
      }

      ?>

      <div class="table-responsive">

        <?php
         include_once('C:\xampp\htdocs\HF_Online\includes\DBOperations.php');
         $db = new DBOperations;
         $result = $db->getAllReviewedEnquiry();
        
        
        
        // $request_query = "SELECT hrid, hostel_owner_name, hostel_name, hostel_location, hostel_type, contact_number, hostel_email, request_date, status FROM hostel_request ORDER BY status DESC,request_date ASC";

        // $result = mysqli_query($con,$request_query);
/*
$eid, $userid, $ownerid, $user_name, $user_email, $user_phone, $owner_name, $hostel_name, $hostel_address, $enquiry_message, $enquiry_date, $enquiry_status, $enquiry_status_update_date
*/
        ?>


        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Enq. ID</th>
              <th>User ID</th>
              <th>Owner ID</th>
              <th>User Name</th>
              <th>User Email</th>
              <th>User Phone</th>
              <th>Owner Name</th>
              <th>Hostel Name</th>
              <th>Hostel Address</th>
              <th>Enquiry Message</th>
              <th>Enquiry Date</th>
              <th>Enquiry Status Reviewed Date</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result) {
              foreach ($result as $res) {
                // echo $res['id'];
                // echo $res['email'];
                // echo $res['username'];
                // echo $res['password'];
            ?>
                <tr>
              
                  <td><?php echo $res['eid']; ?></td>
                  <td><?php echo $res['userid']; ?></td>
                  <td><?php echo $res['ownerid']; ?></td>
                  <td><?php echo $res['user_name']; ?></td>
                  <td><?php echo $res['user_email']; ?></td>
                  <td><?php echo $res['user_phone']; ?></td>
                  <td><?php echo $res['owner_name']; ?></td>

                  <td><?php echo $res['hostel_name']; ?></td>
                  <td><?php echo $res['hostel_address']; ?></td>
                  
                  <td><?php echo $res['enquiry_message']; ?></td>
                  <td><?php echo $res['enquiry_date']; ?></td>
                  <td><?php echo $res['enquiry_status_update_date']; ?></td>
                  <td>
                    <form action="enquiry_edit.php" method="post">
                      <input type="hidden" name="delete_enquiry_id" value="<?php echo $res['eid']; ?>">
                      <button type="submit" name="delete_enquiry_btn" class="btn btn-danger"> DELETE</button>
                    </form>
                  </td>
                </tr>
            <?php

              }
            } else {
              echo "No Reviewed Enquiry.";
            }
            ?>
          </tbody>

        </table>
        <div>
          
        </div>
      </div>

      
      
    </div>    
    
  </div>
  
  

</div>

<?php
include('includes/script.php');
include('includes/footer.php');
?>