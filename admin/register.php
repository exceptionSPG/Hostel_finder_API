<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

?>




<!--code download gareko hai soltiko bata-->

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

          <div class="form-group">
            <label> Username </label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control  checking_email" placeholder="Enter Email">
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
      </form>

    </div>
  </div>


</div>

<div class="container-fluid">
  <!--Data tables examples-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Admin Profile
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
          Add Admin Profile
        </button>
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
       include_once('/storage/ssd3/620/13865620/public_html/MyApi/includes/DBOperations.php');

        $db = new DBOperations;
        $result = $db->getAllAdmins();
        $cnt = 1;
        ?>


        <table class="display table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sno.</th>
              <th>ID</th>
              <th>Email</th>
              <th>Name</th>
              <th>Password</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result > 0) {
              foreach ($result as $res) {
                // echo $res['id'];
                // echo $res['email'];
                // echo $res['username'];
                // echo $res['password'];
            ?>

                <tr>
                <td><?php echo $cnt; ?></td>
                  <td><?php echo $res['id']; ?></td>
                  <td><?php echo $res['email']; ?></td>
                  <td><?php echo $res['username']; ?></td>
                  <td><?php echo $res['password']; ?></td>
                  <td>
                    <form action="register_edit.php" method="post">
                      <input type="hidden" name="edit_id" value="<?php echo $res['id']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="delete_id" value="<?php echo $res['id']; ?>">
                      <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                    </form>
                  </td>
                </tr>
            <?php
             $cnt = $cnt + 1;

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





<?php
include('includes/script.php');
include('includes/footer.php');
?>