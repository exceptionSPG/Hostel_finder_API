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
      if (isset($_POST['edit_btn'])) {

        $uid = $_POST['edit_user_id'];
        $query = "SELECT * FROM hosteluser WHERE uid='$uid'";//"SELECT * FROM (hosteluser join user_info USING (uid)) WHERE uid='$uid'";
        $query_run2 = mysqli_query($con, $query);

        foreach ($query_run2 as $qr) {
          $row['username'] = $qr['username'];
          $row['email'] = $qr['email'];
          $row['password'] = $qr['password'];
          $row['reg_date'] = $qr['reg_date'];
        }

        $query3 = "SELECT * FROM user_info WHERE uid='$uid'";
        $query_run3 = mysqli_query($con, $query3);

    
        $num_rows = mysqli_num_rows($query_run3);
        if ($num_rows == 0) {
          //$query1 = "SELECT * FROM hosteluser WHERE uid='$uid'";
          //$query_run2 = mysqli_query($con, $query1);
          

          $row['user_phone_number'] = "N/A";
          $row['user_address'] = "N/A";
          $row['user_DOB'] = "N/A";
          $row['user_gender'] = "N/A";
          $row['user_guardian_contact_number'] = "N/A";
          $row['user_guardian_name'] = "N/A";
          $row['education'] = "N/A";
          $row['about_you'] = "N/A";
        } else {
           foreach ($query_run3 as $query_run) {
          // $row['username'] = $query_run['username'];
          // $row['email'] = $query_run['email'];
          // $row['password'] = $query_run['password'];
          // $row['reg_date'] = $query_run['reg_date'];

          $row['user_phone_number'] =  $query_run['user_phone_number'];
          $row['user_address'] =  $query_run['user_address'];
          $row['user_DOB'] =  $query_run['user_DOB'];
          $row['user_gender'] =  $query_run['user_gender'];
          $row['user_guardian_contact_number'] =  $query_run['user_guardian_contact_number'];
          $row['user_guardian_name'] =  $query_run['user_guardian_name'];
          $row['education'] =  $query_run['education'];
          $row['about_you'] =  $query_run['about_you'];
          }
        }
      ?>

        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label> Username </label>
                <input readonly="true" type="text" name="edit_username" class="form-control" placeholder="Enter Username" value="<?php echo $row['username'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input readonly="true" type="email" name="edit_email" class="form-control checking_email" value="<?php echo $row['email'] ?>" placeholder="Enter Email">
                <small class="error_email" style="color: red;"></small>
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input readonly="true" type="" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password">
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> User Phone Number </label>
                <input readonly="true" type="text" name="edit_userphone" class="form-control" placeholder="Enter phone" value="<?php echo $row['user_phone_number'] ?>">
              </div>
            </div>
          </div>
        </div>



        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>User Address</label>
                <input readonly="true" type="text" name="edit_address" class="form-control" value="<?php echo $row['user_address'] ?>" placeholder="Enter address">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>User DOB</label>
                <input readonly="true" type="text" name="edit_dob" value="<?php echo $row['user_DOB'] ?>" class="form-control" placeholder="Enter DOB">
              </div>
            </div>
          </div>
        </div>




        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label> User Gender </label>
                <input readonly="true" type="text" name="edit_usergender" class="form-control" placeholder="Enter Gender" value="<?php echo $row['user_gender'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Guardian Name</label>
                <input readonly="true" type="email" name="edit_user_guardian_name" class="form-control" value="<?php echo $row['user_guardian_name'] ?>" placeholder="Enter Guardian name">
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Guardian Number</label>
                <input readonly="true" type="text" name="edit_guardian_number" value="<?php echo $row['user_guardian_contact_number'] ?>" class="form-control" placeholder="Enter guardian number">
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> User Education </label>
                <input readonly="true" type="text" name="edit_education" class="form-control" placeholder="Enter education" value="<?php echo $row['education'] ?>">
              </div>
            </div>
          </div>
        </div>



        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>About <?php echo $row['username'] ?> </label>
                <input readonly="true" type="text" name="edit_about_you" class="form-control" value="<?php echo $row['about_you'] ?>" placeholder="Enter about you">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Registration Date</label>
                <input readonly="true" type="text" name="edit_reg_date" value="<?php echo $row['reg_date'] ?>" class="form-control" placeholder="Enter reg date">
              </div>
            </div>
          </div>
        </div>






        <a href="users.php" class="btn btn-danger"> CLOSE </a>
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