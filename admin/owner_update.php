<?php

 //include('security.php');
include('includes/adminDbConnect.php');

include_once('/storage/ssd3/620/13865620/public_html/MyApi/includes/DBOperations.php');
if(isset($_POST['update_owner_btn'])){
  $owner_id = $_POST['update_owner_id'];


  $sid = $owner_id;
  $hostel_owner_name = $_POST['request_owner_name'];
  $hostel_name = $_POST['request_hostel_name'];
  $hostel_location=$_POST['request_hostel_location'];
  $hostel_type = $_POST['request_hostel_type'];
  $contact_number = $_POST['request_contact_number'];
  $hostel_email = $_POST['request_hostel_email'];
  $hostel_code = $_POST['request_hostel_code'];
  $login_pwd  = $_POST['request_login_password'];



  //getting all data to insert into hostel_owner current_timestamp()
  //INSERT INTO `hostel_owner`(`sid`, `req_id`, `hostel_owner_name`, `hostel_name`, `hostel_location`, `hostel_type`, `contact_number`, `hostel_email`, `hostel_code`, `login_pwd`, `hostel_registered_date`, `updation_date`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
  //$insert_query_by_hrid = "INSERT INTO hostel_owner (req_id, hostel_owner_name, hostel_name,hostel_location , hostel_type, contact_number, hostel_email, hostel_code, login_pwd) VALUES ('$hrid','$hostel_owner_name','$hostel_name', '$hostel_location', '$hostel_type', '$contact_number', '$hostel_email', '$hostel_code', '$login_pwd')";
  
$update_query_by_sid = "UPDATE hostel_owner SET hostel_owner_name = '$hostel_owner_name', hostel_name = '$hostel_name',hostel_location = '$hostel_location',hostel_type='$hostel_type',contact_number='$contact_number', hostel_email = '$hostel_email' WHERE sid = '$sid'";
  //$conn->query($sql) === TRUE $result = mysqli_query($con,$insert_query_by_hrid);

  if($con->query($update_query_by_sid) == TRUE){
      
      $_SESSION['success'] = "<script>alert('Owner updated Successfully.')</script>";
      if(isset($_SESSION['success'])){
          header('Location:owner.php');
        die();
      }
      
            
       
   
   
    }else {
        $_SESSION['status'] = "<script>alert('Owner not updated. '". $conn->error.")</script>;$update_query_by_sid";
        header('Location: owner.php');
  }

  // $sel_qry = "SELECT status from hostel_request where hrid = '$req_id'";

  // $stats = mysqli_query($con,$sel_qry);
  // foreach($stats as $st){
  //   $sta = $stats['status'];
  // }
  // if($sta = "Approved"){
  //   $_SESSION['status'] = "<script>alert('status updated successfully.')</script>;";
  //   header('Location: requests.php');
  // }else{
  //   $_SESSION['status'] = "<script>alert('status not updated.')</script>;";
  //   header('Location: requests.php');
  // }
}

?>
