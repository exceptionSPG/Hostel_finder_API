<?php 

    //yo define chai server ko lagi
    // define('DB_HOST', 'localhost');
    // define('DB_USER', 'id13865620_hostel_db');
    // define('DB_PASSWORD', 'Newpassword_2332');
    // define('DB_NAME', 'id13865620_hostel');

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'id13865620_hostel');
    
// $server_name = "localhost";
// $db_username = "id13865620_hostel_db";
// $db_password = "Newpassword_2332";
// $db_name = "id13865620_hostel";
    

    //1** denote for inserting operation
    define('USER_CREATED', 101);
    define('USER_EXISTS', 102);
    define('USER_FAILURE', 103);

    define('HOSTEL_CREATED', 104);
    define('HOSTEL_EXISTS', 105);
    define('HOSTEL_REGISTER_FAILURE', 106);

    define("HOSTEL_DETAILS_SAVED_SUCCESSFULLY", 107);
    define("HOSTEL_DETAILS_SAVING_FAILURE", 108);
    define("HOSTEL_CODE_NOT_EXISTS", 109);

    define("USER_DETAILS_SAVED_SUCCESSFULLY", 111);
    define("USER_DETAILS_SAVING_FAILURE", 112);
    define("USER_DOES_NOT_EXIST", 113);
    define("USER_DETAILS_Already_Exists", 114);
    
    define('HOSTEL_REQUEST_SUCCESSFULL', 115);
    define('HOSTEL_REQUEST_FAILURE', 116);
    //define('HOSTEL_REGISTER_FAILURE', 117); 

    define('USER_AUTHENTICATED', 201);
    define('USER_NOT_FOUND', 202); 
    define('USER_PASSWORD_DO_NOT_MATCH', 203);

    define('HOSTEL_OWNER_AUTHENTICATED', 204);
    define('HOSTEL_OWNER_NOT_FOUND', 205); 
    define('OWNER_PASSWORD_DO_NOT_MATCH', 206);

    define('PASSWORD_CHANGED', 301);
    define('PASSWORD_DO_NOT_MATCH', 302);
    define('PASSWORD_NOT_CHANGED', 303);

    


