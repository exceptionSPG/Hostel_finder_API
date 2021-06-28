<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

?>

<div class="container-fluid">
  <!--Data tables examples-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Edit Admin Profile
      </h6>
    </div>

    <div class="card-body">
      <?php
      if (isset($_POST['edit_btn'])) {

        $id = $_POST['edit_id'];
        $query = "SELECT * FROM admin WHERE id='$id' ";
        $query_run = mysqli_query($con, $query);
        foreach ($query_run as $row) {
      ?>

          <form action="code.php" method="post">

          <input name="edit_id" value="<?php echo $row['id'] ?>">
            <div class="form-group">
              <label> Username </label>
              <input type="text" name="edit_username" class="form-control" placeholder="Enter Username" value="<?php echo $row['username'] ?>">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="edit_email" class="form-control checking_email" value="<?php echo $row['email'] ?>" placeholder="Enter Email">
              <small class="error_email" style="color: red;"></small>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password">
            </div>

            <a href="register.php" class="btn btn-danger"> CANCEL </a>
            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

          </form>
      <?php

        }
      }
      ?>
    </div>
  </div>




  <?php
  include('includes/script.php');
  include('includes/footer.php');
  ?>