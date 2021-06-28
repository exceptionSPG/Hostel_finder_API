<?php

$server_name = "localhost";
$db_username = "id13865620_hostel_db";
$db_password = "Newpassword_2332";
$db_name = "id13865620_hostel";

// $server_name = "localhost:3306";
// $db_username = "id13865620_hostel_db";
// $db_password = "Newpassword_2332";
// $db_name = "id13865620_hostel";

// DB_NAME = id13865620_hostel
// username = id13865620_hostel_db
// pwd = Miks2020@6891
//new pwd = Newpassword_2332

$con = mysqli_connect($server_name,$db_username,$db_password,$db_name);
//$con = mysqli_connect("localhost","id13865620_hostel_db","Newpassword_2332","id13865620_hostel");

if(!$con)
{
    die("Connection failed: " . mysqli_connect_error());
    echo '
        <div class="container">
            <div class="row">
                <div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title bg-danger text-white"> Database Connection Failed </h1>
                            <h2 class="card-title"> Database Failure</h2>
                            <p class="card-text"> Please Check Your Database Connection.</p>
                            <a href="#" class="btn btn-primary">:( </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
}
?>