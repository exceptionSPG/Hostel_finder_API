<?php
include('security.php');

include_once('C:\xampp\htdocs\HF_Online\includes\DBOperations.php');

if(isset($_POST['edit_enquiry_btn'])){
  $enq_id = $_POST['edit_enquiry_id'];

  
  $db = new DBOperations;
  $result = $db->updateEnquiryStatus($enq_id);

  if($result){
    $_SESSION['success'] = "<script>alert('Enquiry Updated Successfully.')</script>";
    if (isset($_SESSION['success'])) {
      header('Location:enquiry.php');
      die();
    } else {
      $_SESSION['status'] = "<script>alert('Status not updated. ')</script>;";
      header('Location: enquiry.php');
    }
  }else{
    $_SESSION['status'] = "<script>alert('Enquiry status not updated. '". $conn->error.")</script>;$insert_query_by_hrid";
    header('Location: enquiry.php');
  }
}


if(isset($_POST['delete_enquiry_btn']))
{
  // include('security.php');
    $id = $_POST['delete_enquiry_id'];
    $db = new DBOperations;

    $result = $db->deleteEnquiry($id);

    if($result)
    {
        $_SESSION['status'] = "<script>alert(' $id Enquiry is Deleted Successfully.')</script>";
        $_SESSION['status_code'] = "success";
       header('Location: enquiry.php'); 
    }
    else
    {
        $_SESSION['status'] = "<script>alert('$id Enquiry is NOT Deleted.')</script>";      
        $_SESSION['status_code'] = "error";
        header('Location: enquiry.php'); 
    }    
}

?>

 


