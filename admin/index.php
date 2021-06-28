<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>





    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
      </div>

      <!-- Content Row -->
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php

                    include('includes/adminDbConnect.php');
                    $query = "SELECT id FROM admin ORDER BY id ";
                    $query_run = mysqli_query($con, $query);

                    $rows = mysqli_num_rows($query_run);
                    echo "<h5>Total Admin: </h5><a class='text-decoration-none' href = 'register.php'><h2>".$rows."</h2></a>";
                    ?>

                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Registered User</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php

                    include('includes/adminDbConnect.php');
                    $query = "SELECT uid FROM hosteluser ORDER BY uid ";
                    $query_run = mysqli_query($con, $query);
                    $rows = mysqli_num_rows($query_run);
                    echo "<h5>Total User: ".$rows."</h5>";
                    ?>

                  
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fa fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

         <!-- Earnings (Monthly) Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Registered Hostel</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php

                    include('includes/adminDbConnect.php');
                    $query = "SELECT sid FROM hostel_owner ORDER BY sid ";
                    $query_run = mysqli_query($con, $query);
                    $rows = mysqli_num_rows($query_run);
                    echo "<h5>Total Hostel: ".$rows."</h5>";
                    ?>

                  
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fa fa-home fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                    </div>
                    <div class="col">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div> -->

        <!-- Pending Requests Card Example  <a class="card-block stretched-link text-decoration-none" href>
        <h4 class="card-title">Card title</h4>-->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                  <!--redirect to page where requests are handled-->  
                  Pending Requests</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php

                    include('includes/adminDbConnect.php');
                    $query = "SELECT hrid FROM hostel_request WHERE status = 'Pending' ORDER BY hrid ";
                    $query_run = mysqli_query($con, $query);
                    if($query_run){
                         $rows = mysqli_num_rows($query_run);
                   
                    }else {
                        $rows = 0;
                    }
                    echo " <h6>Pending Requests:</h6><a class='text-decoration-none text-danger' href = 'requests.php'><h2>".$rows."</h2></a>";
                    ?>

                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Content Row -->


    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->




  <?php
  include('includes/script.php');
  include('includes/footer.php');
  ?>