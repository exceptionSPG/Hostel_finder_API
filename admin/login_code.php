<?php            
if(isset($_POST['login_btn']))
{
    session_start();
  // include_once('/storage/ssd3/620/13865620/public_html/MyApi/admin/includes/adminDbConnect.php');
  include_once dirname(__FILE__)  . '\includes\adminDbConnect.php';
    $email = $_POST['emaill'];
  $password = $_POST['passwordd'];
  
  $sql = "SELECT `username`,`email`,`password` from `admin` where email = '$email' LIMIT 1";
  //echo $sql;
  if($res = $con->query($sql)){
      if($res->num_rows>0){
          while ($row = $res->fetch_array())  
        { 
            $da_pass = $row['password'];
            $username = $row['username'];
            
            if($password == $da_pass){
                
                $_SESSION['username'] = $username;
                $_SESSION['status']  = "success";
                header('Location:index.php');
                
            }else{
                
                $_SESSION['status']  = "Wrong credential";
                header('Location:login.php');
                //echo 'Password Wrong. Enter valid password.';
            }
        }
      }else {
          $_SESSION['status']  = "User does not exists.";
          header('Location:login.php');
          //echo 'User does not exists.';
      }
  }

   //echo '<script>window.location.replace("http://www.w3schools.com");</script>';
}



?>