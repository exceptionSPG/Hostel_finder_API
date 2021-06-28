<?php
include('security.php');

//include_once('C:\xampp\htdocs\MyApi\includes\DBOperations.php');
include_once('/storage/ssd3/620/13865620/public_html/MyApi/includes/DBOperations.php');
if(isset($_POST['registerbtn'])){
  $name = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $conpass = $_POST['confirmpassword'];

if(!$name==''||!$password==''||!$email==''){
    

  if($password == $conpass){
    $db = new DBOperations;
    $result = $db->createUser( $name, $email, $password);
  
    if($result == USER_CREATED){
  
      $message = array(); 
      $message['error'] = false; 
      $message['message'] = 'User created successfully';
      $_SESSION['success'] = "<script>alert('User created Successfully.')</script>";
      header('Location: users.php');
  
    }else if($result == USER_FAILURE){
  
      $message = array(); 
      $message['error'] = true; 
      $message['message'] = 'Some error occurred';
  
      $_SESSION['status'] = "<script>alert('User not created.')</script>;";
      header('Location: users.php');
    
    }else if($result == USER_EXISTS){
      $message = array(); 
      $message['error'] = true; 
      $message['message'] = 'Admin Already Exists';
  
      $_SESSION['status'] = "<script>alert('User already exists.')</script>;";
      header('Location: users.php');
  
    }
  }else {
    $_SESSION['status'] = 'Password and Confirm Password does not match.';
    header('Location: users.php');
  }
}else {
    
    echo "<script>alert(' enter name, email and password properly...');
    window.location = 'users.php'</script>";
    //header('Location: users.php');
}
}



if(isset($_POST['delete_user_btn']))
{
  //include('security.php');
    $id = $_POST['delete_id'];

  
    $query = "DELETE FROM hosteluser WHERE uid='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "<script>alert(' $id User is Deleted Successfully.')</script>";
        $_SESSION['status_code'] = "success";
        header('Location: users.php'); 
    }
    else
    {
        $_SESSION['status'] = "<script>alert('$id User is NOT Deleted.')</script>";      
        $_SESSION['status_code'] = "error";
        header('Location: users.php'); 
    }    
}

?>