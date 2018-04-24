<?php

//Attempt MySQL server connection.
$link = mysqli_connect("localhost", "root", "root", "mymap");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$link->set_charset("utf8");
// Escape user inputs for security
$buildingnumber = mysqli_real_escape_string($link, $_REQUEST['buildingnumber']);

$zipcode = mysqli_real_escape_string($link, $_REQUEST['zipcode']);

$additionalnumber = mysqli_real_escape_string($link, $_REQUEST['additionalnumber']);

$username = mysqli_real_escape_string($link, $_REQUEST['username']);

// insert query
$sql = "INSERT INTO natadd (buildingnumber, zipcode, additionalnumber, username) VALUES ('$buildingnumber', '$zipcode', '$additionalnumber', '$username')";
if(mysqli_query($link, $sql)){
    echo '<div style="margin-top: 120px;font-size: 25px;color: green;text-align: center;">تم تحديد الموقع بنجاح، شكراً</div>';
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>
