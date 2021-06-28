<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

?>

<div class="container-fluid">
  <!--Data tables examples-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Edit User Profile
      </h6>
    </div>

    <div class="card-body">
      <?php
      if (isset($_POST['edit_request_btn'])) {

        $req_id = $_POST['edit_request_id'];
        echo $req_id;
        $query = "SELECT * FROM hostel_request WHERE hrid='$req_id'"; //"SELECT * FROM (hosteluser join user_info USING (uid)) WHERE uid='$uid'"   hrid, hostel_owner_name, hostel_name, hostel_location, hostel_type, contact_number, hostel_email, request_date, status;
        $query_run2 = mysqli_query($con, $query);
        $row = array();
        
        foreach ($query_run2 as $qr) {
        
          $row['hrid'] = $qr['hrid'];
          $row['hostel_owner_name'] = $qr['hostel_owner_name'];
          $row['hostel_name'] = $qr['hostel_name'];
          $row['hostel_location'] = $qr['hostel_location'];
          $row['hostel_location'] = $qr['hostel_location'];
          $row['hostel_location'] = $qr['hostel_location'];
          $row['hostel_type'] = $qr['hostel_type'];
          $row['contact_number'] = $qr['contact_number'];
          $row['hostel_email'] = $qr['hostel_email'];
          $row['request_date'] = $qr['request_date'];
          $row['status'] = $qr['status'];
        }

        if ($row['status'] == "Pending") {
          $isPen = true;
        } else {
          $isPen = false;
        }


      ?>
        <form action="request_code.php" method="post">
        <input hidden="true" name="update_request_id" value="<?php echo $row['hrid'] ?>">

          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label> Request ID </label>
                  <input readonly="true" type="text" name="request_hrid" class="form-control" placeholder="Enter req id" value="<?php echo $row['hrid'] ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Owner Name</label>
                  <input readonly="true" type="text" name="request_owner_name" class="form-control" value="<?php echo $row['hostel_owner_name'] ?>" placeholder="Enter Owner Naame">

                </div>
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Hostel Name</label>
                  <input readonly="true" type="" name="request_hostel_name" value="<?php echo $row['hostel_name'] ?>" class="form-control" placeholder="Enter Hostel Name">
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> Location </label>
                  <input readonly="true" type="text" name="request_hostel_location" class="form-control" placeholder="Enter location" value="<?php echo $row['hostel_location'] ?>">
                </div>
              </div>
            </div>
          </div>



          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Hostel Type</label>
                  <input readonly="true" type="text" name="request_hostel_type" class="form-control" value="<?php echo $row['hostel_type'] ?>" placeholder="Enter hostel Type">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Contact Number</label>
                  <input readonly="true" type="text" name="request_contact_number" value="<?php echo $row['contact_number'] ?>" class="form-control" placeholder="Enter contact number">
                </div>
              </div>
            </div>
          </div>




          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label> hostel_email </label>
                  <input readonly="true" type="text" name="request_hostel_email" class="form-control checking_email" placeholder="Enter email" value="<?php echo $row['hostel_email'] ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Request Date</label>
                  <input readonly="true" type="text" name="request_request_date" value="<?php echo $row['request_date'] ?>" class="form-control" placeholder="Enter Request date">
                </div>

              </div>
            </div>
          </div>



          <div class="container">
            <div class="row ">
              <div class="col d-flex justify-content-center align-items-center">
                <span class="badge badge-pill badge-info">
                  <?php echo "Status: " . $row['status'] ?>
                </span>
              </div>

            </div>
          </div>


          <?php
          if ($isPen) {
          ?>
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Hostel Code</label>
                    <input type="text" name="request_hostel_code" class="form-control" placeholder="Enter Hostel Code" required pattern="hf+.*">
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Login password </label>
                    <input type="text" name="request_login_password" class="form-control" placeholder="Enter password" required>
                  </div>
                </div>
              </div>
            </div>

            <a href="requests.php" class="btn btn-danger"> CLOSE </a>

            <button type="submit" name="update_request_btn" class="btn btn-primary"> Update </button>

          <?php

          } else {

            //$req_id = $_POST['edit_request_id'];
            $query_cred = "SELECT hostel_code, login_pwd FROM hostel_owner WHERE req_id='$req_id'";
            $query_login_run = mysqli_query($con, $query_cred);

            foreach ($query_login_run as $qlr) {
              $row['hostel_code'] = $qlr['hostel_code'];
              $row['login_pwd'] = $qlr['login_pwd'];
            }


          ?>
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Hostel Code</label>
                    <input readonly="true" type="text" name="request_hostel_code" class="form-control" value="<?php echo  $row['hostel_code'] ?>" placeholder="Enter Hostel Code">
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Login password </label>
                    <input readonly="true" type="text" name="request_login_password" value="<?php echo  $row['login_pwd'] ?>" class="form-control" placeholder="Enter password">
                  </div>
                </div>
              </div>
            </div>
            <a href="requests.php" class="btn btn-danger"> CLOSE </a>

          <?php
          }


          ?>





          <!-- <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button> -->

        </form>
      <?php
      }
      ?>
    </div>
  </div>




  <?php
  include('includes/script.php');
  include('includes/footer.php');
  ?>