<?php
///public_html/MyApi/includes/DBOperations.php
include_once('/storage/ssd3/620/13865620/public_html/MyApi/includes/DBOperations.php');

if(isset($_POST['registerbtn'])){
  $name = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $conpass = $_POST['confirmpassword'];

  if($password == $conpass){
    $db = new DBOperations;
    $result = $db->createAdmin( $name, $email, $password);
  
    if($result == USER_CREATED){
      header('Location: register.php');
      echo '<script>alert("Updation done.")</script>';
      $message = array(); 
      $message['error'] = false; 
      $message['message'] = 'Admin created successfully';
      $_SESSION['success'] = "<script>alert('Admin created Successfully.')</script>;";
      
  
    }else if($result == USER_FAILURE){
      header('Location: register.php');
      $message = array(); 
      $message['error'] = true;
      $message['message'] = 'Some error occurred';
  
      $_SESSION['status'] = "<script>alert('Admin not created.')</script>;";
    
    }else if($result == USER_EXISTS){
      $message = array(); 
      $message['error'] = true; 
      $message['message'] = 'Admin Already Exists';
  
      $_SESSION['status'] = "<script>alert('Admin already exists.')</script>;";
      header('Location: register.php');
  
    }
  }else {
    $_SESSION['status'] = 'Password and Confirm Password does not match.';
    header('Location: register.php');
  }
  $con->close();

}
// }//else{
//   $_SESSION['status'] = 'Password and Confirm Password does not match.';
//   header('Location: register.php');
// }




//update handling
if(isset($_POST['updatebtn'])){
  include('security.php');
  $id = $_POST['edit_id'];
  $editname = $_POST['edit_username'];
  $editemail = $_POST['edit_email'];
  $editpassword = $_POST['edit_password'];

 

  

  $query1 = "UPDATE admin SET username='$editname', email='$editemail',password='$editpassword', updation_date = current_timestamp() WHERE id='$id' ";

  
  $result = mysqli_query($con, $query1);
  if ( false===$result ) {
    //echo '<script>alert("Welcome to <pre>Debug: $query1</pre>\n ")</script>';
        $_SESSION['status'] = "<script>alert('Your Data is NOT Updated Successfully.')</script>;";
        header('Location: register.php'); 
   // printf("error: %s\n", mysqli_error($con));
  }
  else {
       header('Location: register.php'); 
      //echo '<script>alert("Updation done.")</script>';
      $_SESSION['status'] = "<script>alert('Your Data is Updated Successfully.')</script>";

      $_SESSION['status_code'] = "success";
     
    //echo 'done.';
  }

 // $stmt = $con->prepare("UPDATE admin SET username='$editname', email='$editemail',password='$editpassword', updation_date = current_timestamp()  WHERE id=?");
  //if($stmt)
  //$stmt->bind_param("i",$id);
  // $stmt->bind_param("ssi", $email, $name, $uid);
              
  
  //  $query_run = mysqli_query($con, $query1,MYSQLI_STORE_RESULT); //$stmt->execute()
  // if($query_run)
  // {
  //     $_SESSION['status'] = "Your Data is Updated echo K xa? Returned rows are: " . $query1 . $id;
  //     $_SESSION['status_code'] = "success";
  //     header('Location: register.php'); 
  // }
  // else
  // {
  //   echo '<script>alert("Welcome to ")</script>';
  //     $_SESSION['status'] = "Your Data is NOT Updated Returned rows are: " .$query1 . $id;
  //     $_SESSION['status_code'] = "error";
  //     header('Location: register.php'); 
  // }
}



//handling delete btn

if(isset($_POST['delete_btn']))
{
  include('security.php');
    $id = $_POST['delete_id'];

  
    $query = "DELETE FROM admin WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "<script>alert('Your Data is Deleted Successfully.')</script>";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "<script>alert('Your Data is NOT Deleted.')</script>";      
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}



//logout btn handling

if(isset($_POST['logout_btn']))
{
    if(!isset($_SESSION['username']))
    {
     if(isset($_SESSION['status'])){
         unset($_SESSION['status']);
     }
        
        //unset($_SESSION['username']);
        header('Location: login.php');
        exit;
    }else if(session_status() == PHP_SESSION_ACTIVE){
        session_destroy();
        unset($_SESSION['status']);
        unset($_SESSION['username']);
        header('Location: login.php');
    }
    
    
    
}



?>