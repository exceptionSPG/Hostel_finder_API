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
      <!--<form action="owner_code.php" method="POST">

        <div class="modal-body">

          <div class="form-group">
            <label> Ownername </label>
            <input type="text" name="username" class="form-control" placeholder="Enter Ownername">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control checking_email " placeholder="Enter Email">
            <small class="error_email" style="color: red;"></small>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form> -->

    </div>
  </div>


</div>

<div class="container-fluid">
  <!--Data tables examples ----data-target="#addadminprofile"-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Owner Profile
        <a href="requests.php" id="requestpage" ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#requestpage">
          View Owner Request
        </button></a>
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
        // include_once('C:\xampp\htdocs\MyApi\includes\DBOperations.php');
        // $db = new DBOperations;
        // $result = $db->getAllHostelOwners();
        
        
        
        $request_query = "SELECT hrid, hostel_owner_name, hostel_name, hostel_location, hostel_type, contact_number, hostel_email, request_date, status FROM hostel_request ORDER BY status DESC,request_date ASC";

        $result = mysqli_query($con,$request_query);

        ?>


        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Req. ID</th>
              <th>Owner Name</th>
              <th>Hostel Name</th>
              <th>Location</th>
              <th>Hostel Type</th>

              <th>Contact Number</th>
              <th>Hostel Email</th>
            
            
              <th>Req-Date</th>
              <th>Status</th>
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
                  <td><?php echo $res['hrid']; ?></td>
                  <td><?php echo $res['hostel_owner_name']; ?></td>
                  <td><?php echo $res['hostel_name']; ?></td>
                  <td><?php echo $res['hostel_location']; ?></td>
                  <td><?php echo $res['hostel_type']; ?></td>

                  <td><?php echo $res['contact_number']; ?></td>
                  <td><?php echo $res['hostel_email']; ?></td>
                  
                  <td><?php echo $res['request_date']; ?></td>
                  
                  <td><?php echo $res['status']; ?></td>
                  <td>
                    <form action="request_edit.php" method="post">
                      <input type="hidden" name="edit_request_id" value="<?php echo $res['hrid']; ?>">
                      <button type="submit" name="edit_request_btn" class="btn btn-success"> EDIT</button>
                    </form>
                  </td>
                  <td>
                    <form action="request_code.php" method="post">
                      <input type="hidden" name="delete_request_id" value="<?php echo $res['hrid']; ?>">
                      <button type="submit" name="delete_request_btn" class="btn btn-danger"> DELETE</button>
                    </form>
                  </td>
                </tr>
            <?php

              }
            } else {
              echo "No data fouund.";
            }
            ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>

</div>

<?php
include('includes/script.php');
include('includes/footer.php');
?>