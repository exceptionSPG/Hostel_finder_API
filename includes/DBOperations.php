<?php 

    class DbOperations{

        private $con; 

        function __construct(){
            require_once dirname(__FILE__) . '/DbConnect.php';
            //include_once('/HF_Online/includes/DBConnect.php');

            $db = new DbConnect; 
            $this->con = $db->connect(); 
        }

        public function createUser($name, $email, $password){
           if(!$this->isEmailExist($email)){
               $query = "INSERT INTO hosteluser (username,email, password) VALUES (?, ?, ?)";
                $stmt = $this->con->prepare($query);
                if($stmt){
                    $stmt->bind_param("sss", $name, $email, $password);
                if($stmt->execute()){
                    return USER_CREATED; 
                }else{
                    return USER_FAILURE;
                }
            }
                
           }
           return USER_EXISTS; 
        }

        public function createAdmin($name, $email, $password){
            if(!$this->isAdminExist($email)){
                $query = "INSERT INTO admin (username,email, password) VALUES (?, ?, ?)";
                 $stmt = $this->con->prepare($query);
                 if($stmt){
                     $stmt->bind_param("sss", $name, $email, $password);
                 if($stmt->execute()){
                     return USER_CREATED; 
                 }else{
                     return USER_FAILURE;
                 }
             }
                 
            }
            return USER_EXISTS; 
         }

         

        public function createHostelOwner($owner_name,$hostel_name,$hostel_location,$hostel_type,$contact_number,$hostel_email,$hostel_code,$login_pwd){
            if(!$this->isHostelExists($hostel_code)){
                $sql="INSERT INTO hostel_owner (hostel_owner_name,hostel_name,hostel_location,hostel_type,contact_number,hostel_email,hostel_code,login_pwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                 $stmt = $this->con->prepare($sql);
                 if($stmt){
                    $stmt->bind_param("ssssisss",$owner_name,$hostel_name,$hostel_location,$hostel_type,$contact_number,$hostel_email,$hostel_code,$login_pwd );
                    if($stmt->execute()){
                        return HOSTEL_CREATED; 
                    }else{
                        echo "error: "; //$stmt->error();
                        return HOSTEL_REGISTER_FAILURE;
                    }
                 }
             
            }
            return HOSTEL_EXISTS; 
        }


        //INSERT INTO `request`(`eid`, `userid`, `ownerid`, `user_name`, `user_email`, `user_phone`, `owner_name`, `hostel_name`, `hostel_address`, `enquiry_status`, `enquiry_message`, `enquiry_date`, 
        public function insertEnquiry($userid, $ownerid, $user_name, $user_email, $user_phone,$owner_name, $hostel_name, $hostel_address, $enquiry_message){
            $sql = $this->con->prepare("INSERT INTO request (userid, ownerid, user_name, user_email, user_phone, owner_name, hostel_name, hostel_address, enquiry_message) VALUES (?,?,?,?,?,?,?,?,?)");
            $sql->bind_param("iisssssss",$userid, $ownerid, $user_name, $user_email, $user_phone, $owner_name, $hostel_name, $hostel_address, $enquiry_message);
            $vayo = $sql->execute();
            if($vayo){
                return USER_CREATED;
            }else{
                
                return USER_FAILURE;
            }




        }
        public function requestHostelOwner($hostel_name, $hostel_location, $hos_lati, $hos_longi, $hostel_type, $owner_name, $contact_number, $hostel_email)
        {

            $sq1 = "INSERT INTO `hostel_request` (`hrid`, `hostel_name`, `hostel_location`, `loc_lattitude`, `loc_longitude`, `hostel_type`, `hostel_owner_name`, `contact_number`, `hostel_email`, `request_date`, `status`) VALUES (NULL, '$hostel_name','$hostel_location',$hos_lati,$hos_longi, '$hostel_type', '$owner_name',$contact_number,'$hostel_email', current_timestamp(), 'Pending')";
            //$sql="INSERT INTO hostel_request (hostel_name,hostel_location,loc_lattitude,loc_longitude,hostel_type,hostel_owner_name,contact_number,hostel_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->con->prepare($sq1);

            //  //$result = $stmt->execute();
            // if (!$stmt) {
            //     throw new Exception($mysqli->error);
            //     }

            if ($stmt) {
                //$stmt->bind_param("ssddssis",$hostel_name,$hostel_location,$hos_lati,$hos_longi,$hostel_type,$owner_name,$contact_number,$hostel_email );
                if ($stmt->execute()) {
                    return HOSTEL_REQUEST_SUCCESSFULL;
                } else {
                    //return $sq1;
                    return HOSTEL_REQUEST_FAILURE;
                }
            }
            return HOSTEL_REQUEST_FAILURE;
        }

    
          



        public function userLogin($email, $password){
            if($this->isEmailExist($email)){
                $hashed_password = $this->getUsersPasswordByEmail($email); 
                if($hashed_password==$password){ //password_verify($password, $hashed_password
                    return USER_AUTHENTICATED;
                }else{
                    return USER_PASSWORD_DO_NOT_MATCH; 
                }
            }else{
                return USER_NOT_FOUND; 
            }
        }

        public function adminLogin($email, $password){
            if($this->isAdminExist($email)){
                $hashed_password = $this->getAdminPasswordByEmail($email); 
                if($hashed_password==$password){ //password_verify($password, $hashed_password
                    return USER_AUTHENTICATED;
                }else{
                    return USER_PASSWORD_DO_NOT_MATCH; 
                }
            }else{
                return USER_NOT_FOUND; 
            }
        }


        public function insertHostelDetails($hostel_code, $total_room_number, $facility, $pricing){
            if($this->isHostelExists($hostel_code)){
                $query = "INSERT INTO hostel_details (hostel_code,total_room_number, facility, pricing) VALUES (?, ?, ?, ?)";
                 $stmt = $this->con->prepare($query);
                 if($stmt){
                     $stmt->bind_param("siss", $hostel_code, $total_room_number, $facility, $pricing);
                 if($stmt->execute()){
                     return HOSTEL_DETAILS_SAVED_SUCCESSFULLY; 
                 }else{
                     return HOSTEL_DETAILS_SAVING_FAILURE;
                 }
             }
                 
            }
            return HOSTEL_CODE_NOT_EXISTS; 
        }


        public function insertUserDetails($uid, $user_phone_number, $user_address, $user_DOB, $user_gender, $user_guardian_name, $user_guardian_contact_number, $education, $about_you){
            if($this->isUserExists($uid)){
                if(!$this->isUserInfoExists($uid)){

                
                $query = "INSERT INTO user_info (uid, user_phone_number, user_address, user_DOB, user_gender, user_guardian_name, user_guardian_contact_number, education, about_you) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                 $stmt = $this->con->prepare($query);
                 if($stmt){
                     $stmt->bind_param("issssssss", $uid, $user_phone_number, $user_address, $user_DOB, $user_gender, $user_guardian_name, $user_guardian_contact_number, $education, $about_you);
                 if($stmt->execute()){
                     return USER_DETAILS_SAVED_SUCCESSFULLY; 
                 }else{
                     return USER_DETAILS_SAVING_FAILURE;
                 }
             }
            }else return USER_DETAILS_Already_Exists; 
                 
            }
            return USER_DOES_NOT_EXIST; 
        }



        public function getAllUsers(){
            $stmt = $this->con->prepare("SELECT uid, username, email, password, reg_date, updation_date FROM hosteluser ORDER BY uid, username ASC");
            $stmt->execute(); 
            $stmt->bind_result($uid, $username ,$email, $password, $reg_date, $updation_date);
            $users = array(); 
            while($stmt->fetch()){ 
                $user = array(); 
                $user['uid'] = $uid; 
                $user['email']=$email; 
                $user['username'] = $username; 
                $user['password'] = $password; 
                $user['reg_date'] = $reg_date; 
                $user['updation_date'] = $updation_date; 
                array_push($users, $user);
            }             
            return $users; 
        }

        //returns count of all users
        public function getCountOfAllUsers()
        {
            $stmt = $this->con->prepare("SELECT COUNT(uid) AS co FROM hosteluser  ");
            $stmt->execute();
            $stmt->bind_result($co);
            while ($stmt->fetch()) {
                $count = $co;
            }
            return $count;
        }
        //returns count of all owners
        public function getCountOfAllOwners()
        {
            $stmt = $this->con->prepare("SELECT COUNT(sid) AS co FROM hostel_owner  ");
            $stmt->execute();
            $stmt->bind_result($co);
            while ($stmt->fetch()) {
                $count = $co;
            }
            return $count;
        } 
                //returns count of all owner request
        public function getCountOfAllOwnersRequest()
        {
            $stmt = $this->con->prepare("SELECT COUNT(hrid) AS co FROM hostel_request  ");
            $stmt->execute();
            $stmt->bind_result($co);
            while ($stmt->fetch()) {
                $count = $co;
            }
            return $count;
        } 
        //returns count of all pending request
        public function getCountOfAllOwnersPendingRequest()
        {
            $stmt = $this->con->prepare("SELECT COUNT(hrid) AS co FROM hostel_request Where status = 'Pending' ");
            $stmt->execute();
            $stmt->bind_result($co);
            while ($stmt->fetch()) {
                $count = $co;
            }
            return $count;
        } 
        //returns count of all approved request
        public function getCountOfAllOwnersApprovedgRequest()
        {
            $stmt = $this->con->prepare("SELECT COUNT(hrid) AS co FROM hostel_request Where status = 'Approved' ");
            $stmt->execute();
            $stmt->bind_result($co);
            while ($stmt->fetch()) {
                $count = $co;
            }
            return $count;
        } 

        public function getAllHostelOwners(){
            $stmt = $this->con->prepare("SELECT sid, hostel_owner_name, hostel_name, hostel_location, hostel_type, contact_number, hostel_email, hostel_code, login_pwd, hostel_registered_date, updation_date FROM hostel_owner ORDER BY hostel_name ASC");
            $stmt->execute(); 
            $stmt->bind_result($sid, $hostel_owner_name, $hostel_name, $hostel_location, $hostel_type, $contact_number, $hostel_email, $hostel_code, $login_pwd, $hostel_registered_date, $updation_date);
            $users = array(); 
            while($stmt->fetch()){ 
                $user = array(); 
                $user['sid'] = $sid; 
                $user['hostel_owner_name']=$hostel_owner_name; 
                $user['hostel_name'] = $hostel_name; 
                $user['hostel_location'] = $hostel_location; 
                $user['hostel_type'] = $hostel_type; 
                $user['contact_number']=$contact_number; 
                $user['hostel_email'] = $hostel_email; 
                $user['hostel_code'] = $hostel_code; 
                $user['login_pwd'] = $login_pwd; 
                $user['hostel_registered_date']=$hostel_registered_date;
                $user['updation_date']=$updation_date;
                array_push($users, $user);
            }             
            return $users; 
        }

        public function getAllAdmins(){
            $stmt = $this->con->prepare("SELECT id, username, email, password, reg_date, updation_date FROM admin ORDER BY id ASC");
            $stmt->execute(); 
            $stmt->bind_result($uid, $username ,$email, $password, $reg_date, $updation_date);
            $admins = array(); 
            while($stmt->fetch()){ 
                $admin = array(); 
                $admin['id'] = $uid; 
                $admin['email']=$email; 
                $admin['username'] = $username; 
                $admin['password'] = $password; 
                $admin['reg_date'] = $reg_date; 
                $admin['updation_date'] = $updation_date; 
                array_push($admins, $admin);
            }             
            return $admins; 
        }

        public function getUserByUid($uid){
            $user = array(); 
            $users = array(); 
            if($this->isUserExists($uid)){
                $stmt = $this->con->prepare("SELECT uid, username, email, reg_date, updation_date FROM hosteluser WHERE uid = ?");
                if($stmt){
                    $stmt->bind_param("i",$uid);
                }
                $stmt->execute(); 
                $stmt->bind_result($uid, $username ,$email, $reg_date,$updation_date);
                //$users = array(); 
                while($stmt->fetch()){ 
                   // $user = array(); 
                    $user['uid'] = $uid; 
                    $user['email']=$email; 
                    $user['username'] = $username; 
                    $user['reg_date'] = $reg_date; 
                    $user['updation_date'] = $updation_date; 
                    array_push($users, $user);
                }             
                return $users;
               
            }else {
                $user['message'] = "user does not exist";
                array_push($users, $user);
                return $users;

            }
           

            
        }

        public function getAdminById($id){
            $admin = array(); 
            $admins = array(); 
            if($this->isAdminExistById($id)){
                $stmt = $this->con->prepare("SELECT id, username, email, password, reg_date, updation_date FROM admin WHERE id = ?");
                if($stmt){
                    $stmt->bind_param("i",$id);
                }
                $stmt->execute(); 
                $stmt->bind_result($id, $username ,$email,$password, $reg_date,$updation_date);
                //$users = array(); 
                while($stmt->fetch()){ 
                   // $user = array(); 
                    $admin['id'] = $id; 
                    $admin['email']=$email; 
                    $admin['username'] = $username; 
                    $admin['password'] = $password;
                    $admin['reg_date'] = $reg_date; 
                    $admin['updation_date'] = $updation_date; 
                    array_push($admins, $admin);
                }             
                return $admins;
               
            }else {
                $admin['message'] = "user does not exist";
                array_push($admins, $admin);
                return $admins;

            }
           

            
        }

        public function getUserInfoByUid($uid){
            $user = array(); 
           // $users = array(); 
           $infoMsg = $this->isUserInfoExists($uid);
           $userExist = $this->isUserExists($uid);
            if($userExist && $infoMsg){
                $stmt = $this->con->prepare("SELECT uiid, uid, username, email, reg_date, hosteluser.updation_date, user_phone_number, user_address, user_DOB, user_gender, user_guardian_name, user_guardian_contact_number, education, about_you, user_info.updation_date FROM hosteluser INNER JOIN user_info USING (uid) WHERE uid=?");
                // if($stmt){
                //     $stmt->bind_param("i",$uid);
                // }
                if($stmt){
                    $stmt->bind_param("i",$uid);
                    $stmt->execute(); 
                    $stmt->bind_result($uiid, $uid, $username, $email, $reg_date, $Registration_updation_date, $user_phone_number, $user_address, $user_DOB, $user_gender, $user_guardian_name, $user_guardian_contact_number, $education, $about_you, $Info_updation_date);
                    //$users = array(); 
                    while($stmt->fetch()){ 
                       // $user = array(); 
                        $user['uiid'] = $uiid; 
                        $user['uid']=$uid; 
                        $user['username'] = $username; 
                        $user['email']=$email; 
                        $user['reg_date'] = $reg_date;
                        $user['Registration_updation_date'] = $Registration_updation_date; 
                        $user['user_phone_number'] = $user_phone_number;

                       
                        $user['user_address'] = $user_address; 
                        $user['user_DOB'] = $user_DOB;
                        $user['user_gender'] = $user_gender;
                        $user['user_guardian_name'] = $user_guardian_name; 
                        $user['user_guardian_contact_number']=$user_guardian_contact_number; 
                        $user['education'] = $education; 
                        $user['about_you'] = $about_you; 
                        $user['Info_updation_date'] = $Info_updation_date;
                        $user['message'] = "User Info By id found."; 
                        //array_push($users, $user);
                    }             
                    return $user;
                }else {
                    $user['message'] = "stmt error"; 
                    //array_push($users, $user);
                    return $user;
                }
               
            }else if($infoMsg){
                $user['message'] = "user does not exist";
                //array_push($users, $user);
                return $user;

            }else if ($userExist) {
                $user['message'] = "User Info doesnot exists.";
                //array_push($users, $user);
                return $user;
            }else {
                $user['message'] = "user and info both does not exist";
                //array_push($users, $user);
                return $user;
            }
           

            
        }

        public function getUserInfoIDByUid($uid){
           
            if($this->isUserExists($uid)){
                $user = array();
                $users = array();
               // $uiid;
                $stmt = $this->con->prepare("SELECT uiid, uid FROM hosteluser INNER JOIN user_info USING (uid) WHERE uid=?");
                // if($stmt){
                //     $stmt->bind_param("i",$uid);
                // }
                if($stmt){
                    $stmt->bind_param("i",$uid);
                    $stmt->execute(); 
                    $stmt->bind_result($uiid, $uid);
                    //$users = array(); 
                    while($stmt->fetch()){ 
                       // $user = array(); 
                        $uiid = $uiid;
                        array_push($users, $user);
                    }             
                    return $uiid;
                }
            
               
            }else {
                $user['message'] = "user does not exist";
                array_push($users, $user);
                return $users;

            }
           

            
        }

        public function getHostelDetailsByHostelCode($hostel_code)
        {
            $infoExist = $this->isHostelInfoExists($hostel_code);
            $hostelExist = $this->isHostelExists($hostel_code);
            $user = array();
            if ($hostelExist && $infoExist) {
                $stmt = $this->con->prepare("SELECT `hdid`,`sid`,  `hostel_code`, `total_room_number`, `facility`, `pricing`, `hostel_owner_name`, `hostel_name`, `hostel_location`, `hostel_type`, `contact_number`, `hostel_email`, `login_pwd`, `hostel_registered_date` FROM `hostel_owner` INNER JOIN hostel_details USING (hostel_code) WHERE hostel_code = ? ");
                if ($stmt) {
                    $stmt->bind_param("s", $hostel_code);
                    $stmt->execute();
                    $stmt->bind_result($hdid, $sid, $hostel_code, $total_room_number, $facility, $pricing, $hostel_owner_name, $hostel_name, $hostel_location, $hostel_type, $contact_number, $hostel_email, $login_pwd, $hostel_registered_date);
                    // $users = array(); 

                    while ($stmt->fetch()) {

                        $user['hdid'] = $hdid;
                        $user['sid'] = $sid;
                        $user['hostel_code'] = $hostel_code;
                        $user['total_room_number'] = $total_room_number;
                        $user['facility'] = $facility;
                        $user['pricing'] = $pricing;
                        $user['hostel_owner_name'] = $hostel_owner_name;
                        $user['hostel_name'] = $hostel_name;
                        $user['hostel_location'] = $hostel_location;
                        $user['hostel_type'] = $hostel_type;
                        $user['contact_number'] = $contact_number;
                        $user['hostel_email'] = $hostel_email;
                        $user['login_pwd'] = $login_pwd;
                        $user['hostel_registered_date'] = $hostel_registered_date;
                        $user["message"] = "Hostel Info are provided. Thanks " . $hostel_owner_name;
                        //array_push($users, $user);
                    }
                    return $user;
                }
            } else {
                if ($infoExist) {
                    $user["message"] = "Hostel does not exists for hostel code :" . $hostel_code;
                    return $user;
                } else if ($hostelExist) {


                    $stmt = $this->con->prepare("SELECT `sid`,  `hostel_code`,  `hostel_owner_name`, `hostel_name`, `hostel_location`, `hostel_type`, `contact_number`, `hostel_email`, `login_pwd`, `hostel_registered_date` FROM `hostel_owner` WHERE hostel_code = ? ");
                    if ($stmt) {
                        $stmt->bind_param("s", $hostel_code);
                        $stmt->execute();
                        $stmt->bind_result($sid, $hostel_code, $hostel_owner_name, $hostel_name, $hostel_location, $hostel_type, $contact_number, $hostel_email, $login_pwd, $hostel_registered_date);
                        // $users = array(); 

                        while ($stmt->fetch()) {
                            $user['hdid'] = null;
                            $user['sid'] = $sid;
                            $user['hostel_code'] = $hostel_code;
                            $user['total_room_number'] = 'N/A';
                            $user['facility'] = 'N/A';
                            $user['pricing'] = 'N/A';
                            $user['hostel_owner_name'] = $hostel_owner_name;
                            $user['hostel_name'] = $hostel_name;
                            $user['hostel_location'] = $hostel_location;
                            $user['hostel_type'] = $hostel_type;
                            $user['contact_number'] = $contact_number;
                            $user['hostel_email'] = $hostel_email;
                            $user['login_pwd'] = $login_pwd;
                            $user['hostel_registered_date'] = $hostel_registered_date;
                            $user["message"] = "Hostel Info does not exists. Only owner details provided";
                            //array_push($users, $user);
                        }
                        return $user;
                    } else {
                        $user["message"] = "Hostel and hostel Info both does not exists";
                        return $user;
                    }
                }
            }
        }

         //INSERT INTO `request`(`eid`, `userid`, `ownerid`, `user_name`, `user_email`, `user_phone`, `owner_name`, `hostel_name`, `hostel_address`, `enquiry_status`, `enquiry_message`, `enquiry_date`,enquiry_status_update_date 
        public function getAllPendingEnquiry(){
                $stmt = $this->con->prepare("SELECT eid, userid, ownerid, user_name, user_email, user_phone, owner_name, hostel_name, hostel_address, enquiry_message, enquiry_date, enquiry_status, enquiry_status_update_date  FROM request WHERE enquiry_status = 'Pending' ORDER BY enquiry_date DESC");
                $stmt->execute(); 
                $stmt->bind_result($eid, $userid, $ownerid, $user_name, $user_email, $user_phone, $owner_name, $hostel_name, $hostel_address, $enquiry_message, $enquiry_date, $enquiry_status,$enquiry_status_update_date);
                $enquiries = array(); 
                while($stmt->fetch()){ 
                    $request = array(); 
                    $request['eid'] = $eid; 
                    $request['userid']=$userid; 
                    $request['ownerid'] = $ownerid;
                    $request['user_name'] = $user_name; 
                    $request['user_email'] = $user_email; 
                    $request['user_phone'] = $user_phone; 
                    $enquiry['owner_name'] = $owner_name; 
                    $enquiry['hostel_name']=$hostel_name; 
                    $enquiry['hostel_address'] = $hostel_address; 
                    $enquiry['enquiry_message'] = $enquiry_message; 
                    $enquiry['enquiry_date'] = $enquiry_date; 
                    $enquiry['enquiry_status'] = $enquiry_status; 
                    $enquiry['enquiry_status_update_date'] = $enquiry_status_update_date;
                    array_push($enquiries, $enquiry);
                }             
                return $enquiries; 
    
        }

    public function getAllEnquiry()
    {
        $stmt = $this->con->prepare("SELECT eid, userid, ownerid, user_name, user_email, user_phone, owner_name, hostel_name, hostel_address, enquiry_message, enquiry_date, enquiry_status, enquiry_status_update_date  FROM enquiry ORDER BY enquiry_status = 'Pending', enquiry_date DESC");
        $stmt->execute();
        $stmt->bind_result($eid, $userid, $ownerid, $user_name, $user_email, $user_phone, $owner_name, $hostel_name, $hostel_address, $enquiry_message, $enquiry_date, $enquiry_status, $enquiry_status_update_date);
        $enquiries = array();
        while ($stmt->fetch()) {
            $enquiry = array();
            $enquiry['eid'] = $eid;
            $enquiry['userid'] = $userid;
            $enquiry['ownerid'] = $ownerid;
            $enquiry['user_name'] = $user_name;
            $enquiry['user_email'] = $user_email;
            $enquiry['user_phone'] = $user_phone;
            $enquiry['owner_name'] = $owner_name;
            $enquiry['hostel_name'] = $hostel_name;
            $enquiry['hostel_address'] = $hostel_address;
            $enquiry['enquiry_message'] = $enquiry_message;
            $enquiry['enquiry_date'] = $enquiry_date;
            $enquiry['enquiry_status'] = $enquiry_status;
            $enquiry['enquiry_status_update_date'] = $enquiry_status_update_date;
            array_push($enquiries, $enquiry);
        }
        return $enquiries;
    }

    public function getAllReviewedEnquiry(){
        $stmt = $this->con->prepare("SELECT eid, userid, ownerid, user_name, user_email, user_phone, owner_name, hostel_name, hostel_address, enquiry_message, enquiry_date, enquiry_status, enquiry_status_update_date  FROM enquiry WHERE enquiry_status = 'Reviewed' ORDER BY enquiry_date DESC");
        $stmt->execute(); 
        $stmt->bind_result($eid, $userid, $ownerid, $user_name, $user_email, $user_phone, $owner_name, $hostel_name, $hostel_address, $enquiry_message, $enquiry_date, $enquiry_status,$enquiry_status_update_date);
        $enquiries = array(); 
        while($stmt->fetch()){ 
            $enquiry = array(); 
            $enquiry['eid'] = $eid; 
            $enquiry['userid']=$userid; 
            $enquiry['ownerid'] = $ownerid;
            $enquiry['user_name'] = $user_name; 
            $enquiry['user_email'] = $user_email; 
            $enquiry['user_phone'] = $user_phone; 
            $enquiry['owner_name'] = $owner_name; 
            $enquiry['hostel_name']=$hostel_name; 
            $enquiry['hostel_address'] = $hostel_address; 
            $enquiry['enquiry_message'] = $enquiry_message; 
            $enquiry['enquiry_date'] = $enquiry_date; 
            $enquiry['enquiry_status'] = $enquiry_status; 
            $enquiry['enquiry_status_update_date'] = $enquiry_status_update_date;
            array_push($enquiries, $enquiry);
        }             
        return $enquiries; 

}

    public function getAllPendingEnquiryByOwner_id($owner_id)
    {
        $stmt = $this->con->prepare("SELECT eid, userid, ownerid, user_name, user_email, user_phone, owner_name, hostel_name, hostel_address, enquiry_message, enquiry_date, enquiry_status,enquiry_status_update_date FROM enquiry WHERE ownerid ='$owner_id' AND  enquiry_status = 'Pending' ORDER BY enquiry_date DESC");
        $stmt->execute();
        $stmt->bind_result($eid, $userid, $ownerid, $user_name, $user_email, $user_phone, $owner_name, $hostel_name, $hostel_address, $enquiry_message, $enquiry_date, $enquiry_status, $enquiry_status_update_date);
        $enquiries = array();
        while ($stmt->fetch()) {
            $enquiry = array();
            $enquiry['eid'] = $eid;
            $enquiry['userid'] = $userid;
            $enquiry['ownerid'] = $ownerid;
            $enquiry['user_name'] = $user_name;
            $enquiry['user_email'] = $user_email;
            $enquiry['user_phone'] = $user_phone;
            $enquiry['owner_name'] = $owner_name;
            $enquiry['hostel_name'] = $hostel_name;
            $enquiry['hostel_address'] = $hostel_address;
            $enquiry['enquiry_message'] = $enquiry_message;
            $enquiry['enquiry_date'] = $enquiry_date;
            $enquiry['enquiry_status'] = $enquiry_status;
            $enquiry['enquiry_status_update_date'] = $enquiry_status_update_date;
            array_push($enquiries, $enquiry);
        }
        return $enquiries;
    }

    public function getAllReviewedEnquiryByOwner_id($owner_id)
    {
        $stmt = $this->con->prepare("SELECT eid, userid, ownerid, user_name, user_email, user_phone, owner_name, hostel_name, hostel_address, enquiry_message, enquiry_date, enquiry_status,enquiry_status_update_date FROM enquiry WHERE ownerid ='$owner_id' AND  enquiry_status = 'Reviewed' ORDER BY enquiry_status_update_date DESC");
        $stmt->execute();
        $stmt->bind_result($eid, $userid, $ownerid, $user_name, $user_email, $user_phone, $owner_name, $hostel_name, $hostel_address, $enquiry_message, $enquiry_date, $enquiry_status, $enquiry_status_update_date);
        $enquiries = array();
        while ($stmt->fetch()) {
            $enquiry = array();
            $enquiry['eid'] = $eid;
            $enquiry['userid'] = $userid;
            $enquiry['ownerid'] = $ownerid;
            $enquiry['user_name'] = $user_name;
            $enquiry['user_email'] = $user_email;
            $enquiry['user_phone'] = $user_phone;
            $enquiry['owner_name'] = $owner_name;
            $enquiry['hostel_name'] = $hostel_name;
            $enquiry['hostel_address'] = $hostel_address;
            $enquiry['enquiry_message'] = $enquiry_message;
            $enquiry['enquiry_date'] = $enquiry_date;
            $enquiry['enquiry_status'] = $enquiry_status;
            $enquiry['enquiry_status_update_date'] = $enquiry_status_update_date;
            array_push($enquiries, $enquiry);
        }
        return $enquiries;
    }

    public function getCountOfPendingEnquiryByOwner_id($owner_id)
    {
        $stmt = $this->con->prepare("SELECT COUNT(eid) AS co FROM enquiry WHERE ownerid ='$owner_id' AND  enquiry_status = 'Pending' ");
        $stmt->execute();
        $stmt->bind_result($co);
        while ($stmt->fetch()) {
            $count = $co;
        }
        return $count;
    }

    public function getCountOfReviewedEnquiryByOwner_id($owner_id)
    {
        $stmt = $this->con->prepare("SELECT COUNT(eid) AS co FROM enquiry WHERE ownerid ='$owner_id' AND  enquiry_status = 'Reviewed' ");
        $stmt->execute();
        $stmt->bind_result($co);
        while ($stmt->fetch()) {
            $count = $co;
        }
        return $count;
    }


    public function getCountOfPendingEnquiry()
    {
        $stmt = $this->con->prepare("SELECT COUNT(eid) AS co FROM enquiry WHERE  enquiry_status = 'Pending' ");
        $stmt->execute();
        $stmt->bind_result($co);
        while ($stmt->fetch()) {
            $count = $co;
        }
        return $count;
    }
    
    public function getCountOfReviewedEnquiry()
    {
        $stmt = $this->con->prepare("SELECT COUNT(eid) AS co FROM enquiry WHERE  enquiry_status = 'Reviewed' ");
        $stmt->execute();
        $stmt->bind_result($co);
        while ($stmt->fetch()) {
            $count = $co;
        }
        return $count;
    } 
    public function getCountOfAllEnquiry()
    {
        $stmt = $this->con->prepare("SELECT COUNT(eid) AS co FROM enquiry  ");
        $stmt->execute();
        $stmt->bind_result($co);
        while ($stmt->fetch()) {
            $count = $co;
        }
        return $count;
    } 


    public function getAllRequest()
    {
        //SELECT `hrid`, `hostel_name`, `hostel_location`, `hostel_type`, `hostel_owner_name`, `contact_number`, `hostel_email`, `request_date`, `status` FROM `hostel_request`
        $stmt = $this->con->prepare("SELECT hrid, hostel_name, hostel_location, hostel_type, hostel_owner_name, contact_number, hostel_email, request_date, status FROM hostel_request ORDER BY request_date DESC");
        $stmt->execute();
        $stmt->bind_result($hrid, $hostel_name, $hostel_location, $hostel_type, $hostel_owner_name, $contact_number, $hostel_email, $request_date, $status);
        $requests = array();
        while ($stmt->fetch()) {
            $request = array();
            $request['hrid'] = $hrid;
            $request['hostel_name'] = $hostel_name;
            $request['hostel_location'] = $hostel_location;
            $request['hostel_type'] = $hostel_type;
            $request['hostel_owner_name'] = $hostel_owner_name;
            $request['contact_number'] = $contact_number;
            $request['owner_name'] = $hostel_email;
            $request['request_date'] = $request_date;
            $request['status'] = $status;
            array_push($requests, $request);
        }
        return $requests;
    }


    //return request info by req id
    public function getRequestByReqId($hrid)
    {
        //SELECT `hrid`, `hostel_name`, `hostel_location`, `hostel_type`, `hostel_owner_name`, `contact_number`, `hostel_email`, `request_date`, `status` FROM `hostel_request`
        $stmt = $this->con->prepare("SELECT hrid, hostel_name, hostel_location, hostel_type, hostel_owner_name, contact_number, hostel_email, request_date, status FROM hostel_request where hrid = $hrid");
        $stmt->execute();
        $stmt->bind_result($hrid, $hostel_name, $hostel_location, $hostel_type, $hostel_owner_name, $contact_number, $hostel_email, $request_date, $status);
        $request = array();
        $request['hrid'] = $hrid;
        $request['hostel_name'] = $hostel_name;
        $request['hostel_location'] = $hostel_location;
        $request['hostel_type'] = $hostel_type;
        $request['hostel_owner_name'] = $hostel_owner_name;
        $request['contact_number'] = $contact_number;
        $request['hostel_email'] = $hostel_email;
        $request['request_date'] = $request_date;
        $request['status'] = $status;
        
        return $request;
    }

    public function updateRequestStatus($hrid,$hostel_code,$hostel_first_password)
    {
        //$query = "UPDATE `hostel_request` SET `hrid`=[value-1],`hostel_name`=[value-2],`hostel_location`=[value-3],`hostel_type`=[value-4],`hostel_owner_name`=[value-5],`contact_number`=[value-6],`hostel_email`=[value-7],`request_date`=[value-8],`status`=[value-9] WHERE 1

        //before updating, we must insert into hostel_owner and also asign hostel id and password
        $owner = $this->getRequestByReqId($hrid);
        $reg_code = $this->createHostelOwner($owner['hostel_owner_name'],$owner['hostel_name'],$owner['hostel_location'],$owner['hostel_type'],$owner['contact_number'],$owner['hostel_email'],$hostel_code,$hostel_first_password);
        if($reg_code==HOSTEL_CREATED){
            $stmt = $this->con->prepare("UPDATE hostel_request SET status = 'Approved', request_approved_date = current_timestamp() WHERE hrid = ?");

            if ($stmt)
                $stmt->bind_param("i", $hrid);
            // $stmt->bind_param("ssi", $email, $name, $uid);
            if ($stmt->execute())
                return true;
            return false;
        }else{
            return false;
        }
       
    }




        public function getHostelOwnerByHostel_Coder($hostel_code)
        {

            $user = array();
            if ($this->isHostelExists($hostel_code)) {
                $stmt = $this->con->prepare("SELECT sid,hostel_owner_name, hostel_name, hostel_location, hostel_type, contact_number, hostel_email, hostel_code, login_pwd, hostel_registered_date, updation_date FROM hostel_owner Where hostel_code = ?");
                if ($stmt)
                    $stmt->bind_param("s", $hostel_code);
                $stmt->execute();
                $stmt->bind_result($sid, $hostel_owner_name, $hostel_name, $hostel_location, $hostel_type, $contact_number, $hostel_email, $hostel_code, $login_pwd, $hostel_registered_date, $updation_date);

                while ($stmt->fetch()) {
                    // $user = array(); 
                    $user['sid'] = $sid;
                    $user['hostel_owner_name'] = $hostel_owner_name;
                    $user['hostel_name'] = $hostel_name;
                    $user['hostel_location'] = $hostel_location;
                    $user['hostel_type'] = $hostel_type;
                    $user['contact_number'] = $contact_number;
                    $user['hostel_email'] = $hostel_email;
                    $user['hostel_code'] = $hostel_code;
                    $user['login_pwd'] = $login_pwd;
                    $user['hostel_registered_date'] = $hostel_registered_date;
                    $user['updation_date'] = $updation_date;
                    $user["message"] = "Hostel Owner info found.";
                    //array_push($users, $user);
                }
            } else {
                $user["message"] = "Hostel does not exists.";
                return $user;
            }

            return $user;
        }


        private function getUsersPasswordByEmail($email)
        {
            $stmt = $this->con->prepare("SELECT password FROM hosteluser WHERE email = ?");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($password);
                $stmt->fetch();
                // $hash_password = password_hash($password, PASSWORD_DEFAULT);
                // echo "pass= $hash_password";
                return $password;
            }
        }




        private function getAdminPasswordByEmail($email)
        {
            $stmt = $this->con->prepare("SELECT password FROM admin WHERE email = ?");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($password);
                $stmt->fetch();
                // $hash_password = password_hash($password, PASSWORD_DEFAULT);
                // echo "pass= $hash_password";
                return $password;
            }
        }

        private function getOwnerPasswordByHostelCode($hostel_code)
        {
            $stmt = $this->con->prepare("SELECT login_pwd FROM hostel_owner WHERE hostel_code = ?");
            if ($stmt) {
                $stmt->bind_param("s", $hostel_code);
                $stmt->execute();
                $stmt->bind_result($login_pwd);
                $stmt->fetch();
                // $hash_password = password_hash($password, PASSWORD_DEFAULT);
                // echo "pass= $hash_password";
                return $login_pwd;
            }
        }



        public function getUserByEmail($email)
        {
            $stmt = $this->con->prepare("SELECT uid, email, username, reg_date, updation_date FROM hosteluser WHERE email = ?");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($uid, $email, $username, $reg_date, $updation_date);
                $stmt->fetch();
                $user = array();
                $user['uid'] = $uid;
                $user['email'] = $email;
                $user['username'] = $username;
                $user['reg_date'] = $reg_date;
                $user['updation_date'] = $updation_date;
                return $user;
            } else return  $user['message'] = "User does not exist for " . $email;
        }


        public function getAdminByEmail($email)
        {
            $stmt = $this->con->prepare("SELECT id, email, username, reg_date, updation_date FROM admin WHERE email = ?");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($uid, $email, $username, $reg_date, $updation_date);
                $stmt->fetch();
                $user = array();
                $user['id'] = $uid;
                $user['email'] = $email;
                $user['username'] = $username;
                $user['reg_date'] = $reg_date;
                $user['updation_date'] = $updation_date;
                return $user;
            } else return  $user['message'] = "Admin does not exist for " . $email;
        }

        public function updateUser($name, $email, $uid)
        {
            //$query = "UPDATE `hosteluser` SET `username`=$name,`email`=$email,`updation_date`=current_timestamp() WHERE uid = ?";
            $stmt = $this->con->prepare("UPDATE hosteluser SET username = '$name',email = '$email', updation_date = current_timestamp() WHERE uid = ?");
            if ($stmt)
                $stmt->bind_param("i", $uid);
            // $stmt->bind_param("ssi", $email, $name, $uid);
            if ($stmt->execute())
                return true;
            return false;
        }




        public function updatePassword($currentpassword, $newpassword, $email)
        {
            $hashed_password = $this->getUsersPasswordByEmail($email);
            // $current_hash_password = password_hash($currentpassword, PASSWORD_DEFAULT);
            if ($currentpassword == $hashed_password) {

                //$hash_password = password_hash($newpassword, PASSWORD_DEFAULT);
                $stmt = $this->con->prepare("UPDATE hosteluser SET password = ? WHERE email = ?");
                if ($stmt)
                    $stmt->bind_param("ss", $newpassword, $email);

                if ($stmt->execute())
                    return PASSWORD_CHANGED;
                return PASSWORD_NOT_CHANGED;
            } else {
                return PASSWORD_DO_NOT_MATCH;
            }
        }

        public function updateUserInfo($user_phone_number, $user_address, $user_DOB, $user_gender, $user_guardian_name, $user_guardian_contact_number, $education, $about_you, $uid, $uiid)
        {
            //$query = "UPDATE `user_info` SET `uiid`=[value-1],`uid`=[value-2],`user_phone_number`,`user_address`=[value-4],`user_DOB`=[value-5],`user_guardian_name`=[value-6],`user_guardian_contact_number`=[value-7],`education`=[value-8],`about_you`=[value-9] WHERE 1";

            // $uiid = $this->getUserInfoIDByUid($uid);
            //echo "uiid: ".$uiid;
            $stmt = $this->con->prepare("UPDATE user_info SET user_phone_number = '$user_phone_number',user_address = '$user_address', user_DOB = '$user_DOB', user_gender = '$user_gender', user_guardian_name = '$user_guardian_name', user_guardian_contact_number = '$user_guardian_contact_number', education = '$education', about_you = '$about_you', updation_date = current_timestamp() WHERE uiid = ?");
            if ($stmt) {
                $stmt->bind_param("i", $uiid);
                // $stmt->bind_param("ssi", $email, $name, $uid);
                if ($stmt->execute())
                    return true;
                return false;
            }
            return false;
        }

        public function updateOwner($hostel_owner_name, $hostel_name, $hostel_location, $hostel_type, $contact_number, $hostel_email, $hostel_code)
        {
            //$query = "UPDATE `hostel_owner` SET `sid`=[value-1],`hostel_owner_name`=[value-2],`hostel_name`=[value-3],`hostel_location`=[value-4],`hostel_type`=[value-5],`contact_number`=[value-6],`hostel_email`=[value-7],`hostel_code`=[value-8],`login_pwd`=[value-9],`hostel_registered_date`=[value-10] WHERE 1";

            $users = $this->getHostelOwnerID($hostel_code);
            $id = $users['sid'];
            $query = "UPDATE hostel_owner SET hostel_owner_name = '$hostel_owner_name',hostel_name = '$hostel_name', hostel_location = '$hostel_location', hostel_type = '$hostel_type', contact_number = '$contact_number', hostel_email = '$hostel_email', updation_date = current_timestamp() WHERE sid = ?";
            $stmt = $this->con->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $id);

                // $stmt->bind_param("ssi", $email, $name, $uid);
                if ($stmt->execute()) {
                    return true;
                }
                return false;
            }
            return false;
        }

        public function ownerLogin($hostel_code, $password)
        {
            if ($this->isHostelExists($hostel_code)) {
                $hashed_password = $this->getOwnerPasswordByHostelCode($hostel_code);
                if ($hashed_password == $password) { //password_verify($password, $hashed_password
                    return HOSTEL_OWNER_AUTHENTICATED;
                } else {
                    return OWNER_PASSWORD_DO_NOT_MATCH;
                }
            } else {
                return HOSTEL_OWNER_NOT_FOUND;
            }
        }

        public function updateEnquiryStatus($eid)
        {
            //$query = "UPDATE `hosteluser` SET `username`=$name,`email`=$email,`updation_date`=current_timestamp() WHERE uid = ?";
            $stmt = $this->con->prepare("UPDATE request SET enquiry_status = 'Reviewed', enquiry_status_update_date = current_timestamp() WHERE eid = ?");
            if ($stmt)
                $stmt->bind_param("i", $eid);
            // $stmt->bind_param("ssi", $email, $name, $uid);
            if ($stmt->execute())
                return true;
            return false;
        }



        public function deleteUser($id)
        {
            $stmt = $this->con->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute())
                return true;
            return false;
        }

        public function deleteOwner($sid)
        {
            $stmt = $this->con->prepare("DELETE FROM hostel_owner WHERE sid = ?");
            $stmt->bind_param("i", $sid);
            if ($stmt->execute())
                return true;
            return false;
        }
        public function deleteRequest($rid)
        {
            $stmt = $this->con->prepare("DELETE FROM hostel_request WHERE hrid = ?");
            $stmt->bind_param("i", $rid);
            if ($stmt->execute())
                return true;
            return false;
        }
        public function deleteHostelDetails($did)
        {
            $stmt = $this->con->prepare("DELETE FROM hostel_details WHERE hdid = ?");
            $stmt->bind_param("i", $did);
            if ($stmt->execute())
                return true;
            return false;
        }

        public function deleteEnquiry($eid)
        {
            $stmt = $this->con->prepare("DELETE FROM request WHERE eid = ?");
            $stmt->bind_param("i", $eid);
            if ($stmt->execute())
                return true;
            return false;
        }

        private function isEmailExist($email)
        {
            $stmt = $this->con->prepare("SELECT uid FROM hosteluser WHERE email = ?");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            } else return $stmt;
        }

        private function isAdminExist($email)
        {
            $stmt = $this->con->prepare("SELECT id FROM admin WHERE email = ?");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            } else return false; //$stmt->num_rows < 1; ;



        }

        private function isAdminExistById($id)
        {
            $stmt = $this->con->prepare("SELECT id FROM admin WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            } else return false; //$stmt->num_rows < 1; ;



        }

        private function isHostelExists($hostel_code)
        {
            $stmt = $this->con->prepare("SELECT sid FROM hostel_owner WHERE hostel_code = ?");
            if ($stmt) {
                $stmt->bind_param("s", $hostel_code);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            } else return false;
        }



        private function isHostelInfoExists($hostel_code)
        {
            $stmt = $this->con->prepare("SELECT hdid FROM hostel_details WHERE hostel_code = ?");
            if ($stmt) {
                $stmt->bind_param("s", $hostel_code);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            } else return false;
        }

        private function isUserExists($uid)
        {
            $stmt = $this->con->prepare("SELECT uid FROM hosteluser WHERE uid = ?");
            if ($stmt) {
                $stmt->bind_param("i", $uid);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            } else return false;
        }

        public function isUserInfoExists($uid)
        {
            $stmt = $this->con->prepare("SELECT uiid FROM user_info WHERE uid = ?");
            if ($stmt) {
                $stmt->bind_param("i", $uid);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            } else return false;
        }

        public function getHostelOwnerID($hostel_code)
        {
            $stmt = $this->con->prepare("SELECT sid FROM hostel_owner Where hostel_code = ?");
            if ($stmt)
                $stmt->bind_param("s", $hostel_code);
            $stmt->execute();
            $stmt->bind_result($sid);
            $users = array();
            while ($stmt->fetch()) {
                $users['sid'] = $sid;
            }
            return $users;
        }
    }
