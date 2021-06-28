

<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require '../vendor/autoload.php';
require '../includes/DBOperations.php';


$app = AppFactory::create();
$app->addBodyParsingMiddleware();
/**
    endpoint = createuser,
    parameters = username,email,password
    method = POST
 */

$app->post('/HF_Online/public/createuser', function (Request $request, Response $response) {

    if(!haveEmptyParameters(array('name', 'email', 'password'), $request, $response)){

        $request_data = $request->getParsedBody(); 
        $email = $request_data['email'];
        $password = $request_data['password'];
        $name = $request_data['name']; 
        //echo "hello, $email";
       

       // $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $db = new DBOperations;
        $result = $db->createUser( $name, $email, $password);
        
        if($result == USER_CREATED){

            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'User created successfully';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);

        }else if($result == USER_FAILURE){

            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occurred';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    

        }else if($result == USER_EXISTS){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'User Already Exists';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    
        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});



$app->post('/HF_Online/public/createadmin', function (Request $request, Response $response) {

    if(!haveEmptyParameters(array('name', 'email', 'password'), $request, $response)){

        $request_data = $request->getParsedBody(); 
        $email = $request_data['email'];
        $password = $request_data['password'];
        $name = $request_data['name']; 
        //echo "hello, $email";
       

       // $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $db = new DBOperations;
        $result = $db->createAdmin( $name, $email, $password);
        
        if($result == USER_CREATED){

            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'Admin created successfully';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);

        }else if($result == USER_FAILURE){

            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occurred';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    

        }else if($result == USER_EXISTS){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Admin Already Exists';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    
        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});

/**
    endpoint = requesthostelowner,
    parameters = hostel_name,hostel_location,hos_lati,hos_longi,hostel_type,owner_name,contact_number,hostel_email
    method = POST
 */

$app->post('/HF_Online/public/requesthostelowner', function (Request $request, Response $response) {

    if(!haveEmptyParameters(array('hostel_name', 'hostel_location', 'hos_lati', 'hos_longi', 'hostel_type', 'owner_name', 'contact_number', 'hostel_email'), $request, $response)){

        $request_data = array();
        $request_data = $request->getParsedBody(); 
        $hostel_name = $request_data['hostel_name'];
        $hostel_location = $request_data['hostel_location'];
        $hos_lati = $request_data['hos_lati'];
        $hos_longi = $request_data['hos_longi'];
        $hostel_type = $request_data['hostel_type'];
        $owner_name = $request_data['owner_name'];
        
       
        
        $contact_number = $request_data['contact_number'];
        $hostel_email = $request_data['hostel_email'];

        $db = new DBOperations; 

        $result = $db->requestHostelOwner($hostel_name,$hostel_location,$hos_lati,$hos_longi, $hostel_type,$owner_name, $contact_number,$hostel_email);
        
        
        if($result == HOSTEL_REQUEST_SUCCESSFULL){

            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'new hostel requested successfully. We also sent an email to admin. Approval will be done very soon.';
            
             require_once('../includes/class.phpmailer.php');
            /* creates object */
            $mail = new PHPMailer(true);
            $mailid = $hostel_email;
            $subject = "Thank u";
            $text_message = "Hello";
            $mail_message = "Thank You \nWe Received your request to join our platform.\n We will contact back you soon for further approval process. ";
            
            try
            {
            $mail->IsSMTP();
            $mail->isHTML(true);
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = '465';
            $mail->AddAddress($mailid);
            $mail->Username ="gyawalishiva14@gmail.com";//divyasundarsahu@gmail.com
            $mail->Password ="KeshavGy14";//password@123 setfrom: divyasundarsahu@gmail.com  Divyasundar Sahu
            $mail->SetFrom('gyawalishiva14@gmail.com','Shiva Prasad Gyawali');
            $mail->AddReplyTo("gyawalishiva14@gmail.com","Shiva Prasad Gyawali");//divyasundarsahu@gmail.com
            $mail->Subject = "Request Received - Hostel Finder";
            $mail->Body = $mail_message;
            $mail->AltBody = $mail_message;
            if($mail->Send())
            {
                $message['message'].= "Mail sent. Thank you ".$owner_name;
            //echo "Thank you for register u got a notification through the mail you provide";
            }
            }
            catch(phpmailerException $ex)
            {
            $msg = "
            ".$ex->errorMessage()."
            ";
            }
            

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);

        }else if($result == HOSTEL_REQUEST_FAILURE){

            $message = array(); 
            $message['error'] = true; 
            $message['result'] = $result;
            $message['message'] = 'Some error occurred while requesting hostel.';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    

        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});




/**
    endpoint = createhostelowner,
    parameters = hostel_owner_name,hostel_name,hostel_location,hostel_type,contact_number,hostel_email,hostel_code,login_pwd
    method = POST
 */

$app->post('/HF_Online/public/createhostelowner', function (Request $request, Response $response) {

    if(!haveEmptyParameters(array('hostel_owner_name', 'hostel_name', 'hostel_location', 'hostel_type', 'contact_number', 'hostel_email', 'hostel_code', 'login_pwd'), $request, $response)){

        $request_data = array();
        $request_data = $request->getParsedBody(); 
        $owner_name = $request_data['hostel_owner_name'];
        $hostel_name = $request_data['hostel_name'];
        $hostel_location = $request_data['hostel_location'];
        $hostel_type = $request_data['hostel_type'];
        $contact_number = $request_data['contact_number'];
        $hostel_email = $request_data['hostel_email'];
        $hostel_code = $request_data['hostel_code'];
        $login_pwd = $request_data['login_pwd'];

        $hash_password = password_hash($login_pwd, PASSWORD_DEFAULT);

        $db = new DBOperations; 

        $result = $db->createHostelOwner($owner_name,$hostel_name,$hostel_location,$hostel_type,$contact_number,$hostel_email,$hostel_code,$login_pwd);
        
        if($result == HOSTEL_CREATED){

            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'new hostel created successfully';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);

        }else if($result == HOSTEL_REGISTER_FAILURE){

            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occurred while registering hostel.';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    

        }else if($result == HOSTEL_EXISTS){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Hostel Already Exists';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    
        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});


/**
    endpoint = inserthosteldetails,
    parameters = hostel_code, total_room_number, facility, pricing,
    method = POST
 */

$app->post('/HF_Online/public/inserthosteldetails', function (Request $request, Response $response) {

    if(!haveEmptyParameters(array('hostel_code', 'total_room_number', 'facility', 'pricing'), $request, $response)){

        $request_data = $request->getParsedBody(); 
        $hostel_code =  $request_data['hostel_code'];
        $total_room_number =  $request_data['total_room_number'];
        $facility =  $request_data['facility'];
        $pricing = $request_data['pricing'];

        $db = new DBOperations; 

        $result = $db->insertHostelDetails($hostel_code, $total_room_number, $facility, $pricing);
        
        if($result == HOSTEL_DETAILS_SAVED_SUCCESSFULLY){

            $message = array(); 
            $message['error'] = false; 
            $message['message'] = ' hostel details saved successfully';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);

        }else if($result == HOSTEL_DETAILS_SAVING_FAILURE){

            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occurred while saving hostel details.';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    

        }else if($result == HOSTEL_CODE_NOT_EXISTS){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Hostel does not Exist. You cannot add details of this hostel.';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    
        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});



/**
    endpoint = insertUserDetails,
    parameters = uid, user_phone_number, user_address, user_DOB, user_guardian_name, user_guardian_contact_number, education, about_you
    method = POST
 */

$app->post('/HF_Online/public/insertUserDetails', function (Request $request, Response $response) {

    if(!haveEmptyParameters(array('uid', 'user_phone_number', 'user_address', 'user_DOB', 'user_gender', 'user_guardian_name', 'user_guardian_contact_number', 'education', 'about_you'), $request, $response)){

        $request_data = $request->getParsedBody(); 

        $uid =  $request_data['uid'];
        $user_phone_number =  $request_data['user_phone_number'];
        $user_address =  $request_data['user_address'];
        $user_DOB =  $request_data['user_DOB'];
        $user_gender =  $request_data['user_gender'];
        $user_guardian_name =  $request_data['user_guardian_name'];
        $user_guardian_contact_number =  $request_data['user_guardian_contact_number'];
        $education =  $request_data['education'];
        $about_you =  $request_data['about_you'];
        

        $db = new DBOperations; 

        $result = $db->insertUserDetails($uid, $user_phone_number, $user_address, $user_DOB, $user_gender, $user_guardian_name, $user_guardian_contact_number, $education, $about_you);
        
        if($result == USER_DETAILS_SAVED_SUCCESSFULLY){

            $message = array(); 
            $message['error'] = false; 
            $message['message'] = ' user details saved successfully'.$uid;

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);

        }else if($result == USER_DETAILS_SAVING_FAILURE){

            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occurred while saving user details.';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    

        }else if($result == USER_DETAILS_Already_Exists){

            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'User details already exists.';

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    

        }else if($result == USER_DOES_NOT_EXIST){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'User does not Exist. You cannot add details of this user.'.$uid;

            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    
        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});

/*
    endpoint: insertenquiry
    parameter: $userid, $ownerid, $username, $user_email, $user_phone, $hostel_name, $hostel_address, $enquiry_message
    method: post
    insertEnquiry

*/
$app->post('/HF_Online/public/insertenquiry', function(Request $request, Response $response){
    if(!haveEmptyParameters(array('userid','ownerid','username','user_email','user_phone','hostel_name','hostel_address','enquiry_message'),$request, $response)){
            $request_data = $request->getParsedBody();
            $userid= $request_data['userid'];
            $ownerid = $request_data['ownerid'];
            $username=$request_data['username'];
            $user_email=$request_data['user_email'];
            $user_phone = $request_data['user_phone'];
            $hostel_name = $request_data['hostel_name'];
            $hostel_address = $request_data['hostel_address'];
            $enquiry_message = $request_data['enquiry_message'];

            $db = new DbOperations;
            $result = $db->insertEnquiry($userid, $ownerid, $username, $user_email, $user_phone, $hostel_name, $hostel_address, $enquiry_message );

            if($result == USER_CREATED){
                $message = array(); 
                $message['error'] = false; 
                $message['message'] = ' Enquiry saved successfully';
    
                $response->getBody()->write(json_encode($message));
    
                return $response
                            ->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
            }else if($result == USER_FAILURE){
                $message = array(); 
                $message['error'] = true; 
                $message['message'] = ' Enquiry saving failure';
    
                $response->getBody()->write(json_encode($message));
    
                return $response
                            ->withHeader('Content-type', 'application/json')
                            ->withStatus(422);
            }


    }
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(422);    
});


/**
    endpoint = allusers,
    parameters = no params
    method = GET
 */
$app->get('/HF_Online/public/allusers', function(Request $request, Response $response){

    $db = new DbOperations; 

    $users = $db->getAllUsers();

    $response_data = array();

    $response_data['error'] = false; 
    $response_data['users'] = $users; 

    $response->getBody()->write(json_encode($response_data));

    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});


/**
    endpoint = allHostelOwners,
    parameters = no parameters
    method = GET
 */
$app->get('/HF_Online/public/allHostelOwners', function(Request $request, Response $response){

    $db = new DbOperations; 

    $users = $db->getAllHostelOwners();

    $response_data = array();

    $response_data['error'] = false; 
    $response_data['users'] = $users; 

    $response->getBody()->write(json_encode($response_data));

    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});

/**
    endpoint = userbyuid/{uid},
    parameters = uid
    method = GET
 */
$app->get('/HF_Online/public/userbyuid/{uid}', function(Request $request, Response $response, array $args){

    $uid = $args['uid'];
    $db = new DbOperations; 

    $users = $db->getUserByUid($uid);

    $response_data = array();

    $response_data['error'] = false; 
    $response_data['users'] = $users; 

    $response->getBody()->write(json_encode($response_data));

    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});


/**
    endpoint = userinfobyuid/{uid},
    parameters = uid
    method = GET
 */
$app->get('/HF_Online/public/userinfobyuid/{uid}', function(Request $request, Response $response, array $args){

    $uid = $args['uid'];
    $db = new DbOperations; 

    $users = $db->getUserInfoByUid($uid);

    $response_data = array();

    $response_data['error'] = false; 
    $response_data['users'] = $users; 

    $response->getBody()->write(json_encode($response_data));

    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});


/**
    endpoint = isUserInfoExist/{uid},
    parameters = uid
    method = GET
 */
$app->get('/HF_Online/public/isUserInfoExist/{uid}', function(Request $request, Response $response, array $args){

    $uid = $args['uid'];
    $db = new DbOperations; 

    $infoMsg = $db->isUserInfoExists($uid);

    $response_data = array();

    $response_data['error'] = "$infoMsg"; 
    $response_data['info'] = $infoMsg; 

    $response->getBody()->write(json_encode($response_data));

    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});

/**
    endpoint = hostelinfobyhcode/{hostel_code},
    parameters = hostel_code
    method = GET
 */
$app->get('/HF_Online/public/hostelinfobyhcode/{hostel_code}', function(Request $request, Response $response, array $args){

    $hostel_code = $args['hostel_code'];
    $db = new DbOperations; 
    $user = $db->getHostelDetailsByHostelCode($hostel_code);

    $response_data = array();

    $response_data['error'] = false; 
    $response_data['user'] = $user; 

    $response->getBody()->write(json_encode($response_data));

    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});


/**
    endpoint = userupdate/{uid},
    parameters = email, username, uid
    method = PUT
 */

$app->put('/HF_Online/public/userupdate/{uid}', function(Request $request, Response $response, array $args){

    $uid = $args['uid'];

    if(!haveEmptyParameters(array('username', 'email'), $request, $response)){


        
        $request_data = $request->getParsedBody(); 
        //$request_data = json_decode($request->getBody(),TRUE); 
        $username = $request_data['username'];
        $email = $request_data['email'];
    
       
        $db = new DbOperations;

        if($db->updateUser($username, $email, $uid)){
            $response_data = array();
            $response_data['error'] = false; 
            $response_data['message'] = 'User Updated Successfully';
            $user = $db->getUserByUid($uid);
            $response_data['user'] = $user; 

            $response->getBody()->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
        
        }else{
            $response_data = array(); 
            $response_data['error'] = true; 
            $response_data['message'] = 'Please try again later';
            $user = $db->getUserByEmail($email);
            $response_data['user'] = $user; 

            $response->getBody()->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
              
        }

    }
    
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});

$app->put('/HF_Online/public/updateuserpassword', function(Request $request, Response $response){

    if(!haveEmptyParameters(array('currentpassword', 'newpassword', 'email'), $request, $response)){
        
        $request_data = $request->getParsedBody(); 

        $currentpassword = $request_data['currentpassword'];
        $newpassword = $request_data['newpassword'];
        $email = $request_data['email']; 

        $db = new DbOperations; 

        $result = $db->updatePassword($currentpassword, $newpassword, $email);

        if($result == PASSWORD_CHANGED){
            $response_data = array(); 
            $response_data['error'] = false;
            $response_data['message'] = 'Password Changed';
            $response->getBody()->write(json_encode($response_data));
            return $response->withHeader('Content-type', 'application/json')
                            ->withStatus(200);

        }else if($result == PASSWORD_DO_NOT_MATCH){
            $response_data = array(); 
            $response_data['error'] = true;
            $response_data['message'] = 'You have given wrong password';
            $response->getBody()->write(json_encode($response_data));
            return $response->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
        }else if($result == PASSWORD_NOT_CHANGED){
            $response_data = array(); 
            $response_data['error'] = true;
            $response_data['message'] = 'Some error occurred';
            $response->getBody()->write(json_encode($response_data));
            return $response->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
        }
    }

    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);  
});

/**
    endpoint = updateuserinfo/{uid},
    parameters = 'user_phone_number', 'user_address', 'user_DOB',
                'user_gender', 'user_guardian_name','user_guardian_contact_number','education','about_you'
    method = PUT
 */

$app->put('/HF_Online/public/updateuserinfo/{uid}', function(Request $request, Response $response, array $args){

    $uid = $args['uid'];

     if(!haveEmptyParameters(array('user_phone_number', 'user_address', 'user_DOB', 'user_gender', 'user_guardian_name','user_guardian_contact_number','education','about_you'), $request, $response)){


        
        $request_data = $request->getParsedBody(); 
        //$request_data = json_decode($request->getBody(),TRUE); 
        $user_phone_number = $request_data['user_phone_number'];
        $user_address = $request_data['user_address'];
        $user_DOB = $request_data['user_DOB'];
        $user_gender = $request_data['user_gender'];
        $user_guardian_name = $request_data['user_guardian_name'];
        $user_guardian_contact_number = $request_data['user_guardian_contact_number'];
        $education = $request_data['education'];
        $about_you = $request_data['about_you'];
       
        $db = new DbOperations;
        $uiid = $db->getUserInfoIDByUid($uid);

        if($db->updateUserInfo($user_phone_number, $user_address, $user_DOB, $user_gender, $user_guardian_name, $user_guardian_contact_number, $education, $about_you, $uid, $uiid)){
            $response_data = array();
            $response_data['error'] = false; 
            $response_data['message'] = 'User Info Updated Successfully';
            $user = $db->getUserInfoByUid($uid);
            $response_data['user'] = $user; 

            $response->getBody()->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
        
        }else{
            $response_data = array(); 
            $response_data['error'] = true; 
            $response_data['message'] = 'Please try again later';
            $user = $db->getUserInfoByUid($uid);
            $response_data['user'] = $user; 

            $response->getBody()->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
              
        }

   }

    // $response_data = array(); 
    // $response_data['user'] = 'Parameters are not complete.';
    // $response->getBody()->write(json_encode($response_data));
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});

/**
    endpoint = updateuserinfo/{uid},
    parameters = email, username, uid
    method = PUT
 */

$app->put('/HF_Online/public/updateOwner/{hostel_code}', function(Request $request, Response $response, array $args){

    $hostel_code = $args['hostel_code'];

    if(!haveEmptyParameters(array('hostel_owner_name', 'hostel_name', 'hostel_location', 'hostel_type', 'contact_number', 'hostel_email'), $request, $response)){


        
        $request_data = $request->getParsedBody(); 
        //$request_data = json_decode($request->getBody(),TRUE); 
        $hostel_owner_name = $request_data['hostel_owner_name'];
        $hostel_name = $request_data['hostel_name'];
        $hostel_location = $request_data['hostel_location'];
        $hostel_type = $request_data['hostel_type'];
        $contact_number = $request_data['contact_number'];
        $hostel_email = $request_data['hostel_email'];
        //$about_you = $request_data['about_you'];
       
        $db = new DbOperations;

        if($db->updateOwner($hostel_owner_name, $hostel_name, $hostel_location, $hostel_type, $contact_number, $hostel_email, $hostel_code)){
            $response_data = array();
            $response_data['error'] = false; 
            $response_data['message'] = 'User Info Updated Successfully';
            $user = $db->getHostelOwnerByHostel_Coder($hostel_code);
            $response_data['user'] = $user;

            $response->getBody()->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
        
        }else{
            $response_data = array(); 
            $response_data['error'] = true; 
            $response_data['message'] = 'Please try again later';
            $user = $db->getHostelOwnerByHostel_Coder($hostel_code);
            $response_data['user'] = $user; 

            $response->getBody()->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
              
        }

    }
    
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});

$app->get('/HF_Online/public/showError/{uid}', function(Request $request, Response $response, array $args){

    $uid = $args['uid'];

    $db = new DBOperations;
    $request_data = $request->getParsedBody(); 
    //$username = $request_data['username'];
    $email = $request_data['email'];
    $user = array();

    $response_data = array();
    $response_data['error'] = false; 
    $response_data['message']="Reading success";
    $user = $db->getUserByEmail($email);
    $response_data['user'] = $user;
    $response->getBody()->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);

});


$app->post('/HF_Online/public/userlogin', function(Request $request, Response $response){

    if(!haveEmptyParameters(array('email', 'password'), $request, $response)){
        $request_data = $request->getParsedBody(); 

        $email = $request_data['email'];
        $password = $request_data['password'];
        
        $db = new DbOperations; 

        $result = $db->userLogin($email, $password);

        if($result == USER_AUTHENTICATED){
            
            $user = $db->getUserByEmail($email);
            $response_data = array();

            $response_data['error']=false; 
            $response_data['message'] = 'Login Successful';
            $response_data['user']=$user;
            $response_data['keys']="User";

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);

        }else if($result == USER_NOT_FOUND){
            $response_data = array();

            $response_data['error']=true; 
            $response_data['message'] = 'User not exist';

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);    

        }else if($result == USER_PASSWORD_DO_NOT_MATCH){
            $response_data = array();

            $response_data['error']=true; 
            $response_data['message'] = 'Invalid credential';

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);  
        }
    }

    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});


$app->post('/HF_Online/public/adminlogin', function(Request $request, Response $response){

    if(!haveEmptyParameters(array('email', 'password'), $request, $response)){
        $request_data = $request->getParsedBody(); 

        $email = $request_data['email'];
        $password = $request_data['password'];
        
        $db = new DbOperations; 

        $result = $db->adminLogin($email, $password);

        if($result == USER_AUTHENTICATED){
            
            $admin = $db->getAdminByEmail($email);
            $response_data = array();

            $response_data['error']=false; 
            $response_data['message'] = 'Login Successful';
            $response_data['user']=$admin;
            $response_data['keys']="Admin";

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);

        }else if($result == USER_NOT_FOUND){
            $response_data = array();

            $response_data['error']=true; 
            $response_data['message'] = 'Admin does not exist';

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);    

        }else if($result == USER_PASSWORD_DO_NOT_MATCH){
            $response_data = array();

            $response_data['error']=true; 
            $response_data['message'] = 'Invalid credential';

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);  
        }
    }

    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});


$app->post('/HF_Online/public/ownerlogin', function(Request $request, Response $response){

    if(!haveEmptyParameters(array('hostel_code', 'login_pwd'), $request, $response)){
        $request_data = $request->getParsedBody(); 

        $hostel_code = $request_data['hostel_code'];
        $login_pwd = $request_data['login_pwd'];
        
        $db = new DbOperations; 

        $result = $db->ownerLogin($hostel_code, $login_pwd);

        if($result == HOSTEL_OWNER_AUTHENTICATED){
            
            $owner = $db->getHostelOwnerByHostel_Coder($hostel_code);
            $response_data = array();

            $response_data['error']=false; 
            $response_data['message'] = 'Login Successful';
            $response_data['owner']=$owner;
            $response_data['keys']="Owner";

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);

        }else if($result == HOSTEL_OWNER_NOT_FOUND){
            $response_data = array();

            $response_data['error']=true; 
            $response_data['message'] = 'Hostel does not exist';

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);    

        }else if($result == OWNER_PASSWORD_DO_NOT_MATCH){
            $response_data = array();

            $response_data['error']=true; 
            $response_data['message'] = 'Invalid credential';

            $response->getBody()->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);  
        }
    }

    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});


function haveEmptyParameters($required_params, $request, $response){
  $error = false; 
  $error_params = '';
  $request_params = $_REQUEST; //$request->getParsedBody(); 

  foreach($required_params as $param){
      if(!isset($request_params[$param]) || strlen($request_params[$param])<=0){
          $error = true; 
          $error_params .= $param . ', ';
      }
  }

  if($error){
      $error_detail = array();
      $error_detail['error'] = true; 
      $error_detail['message'] = 'Required parameters ' . substr($error_params, 0, -2) . ' are missing or empty';
      $response ->getBody()->write(json_encode($error_detail));
  }
  return $error;
}

$app->run();

