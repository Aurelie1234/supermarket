<?php

$servername = "localhost";
$username = "username";
$password = "";
$dbName = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password , $dbName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// define variables and set to empty values
$firstn = $lastn = $email = $pwd = $pwd2 = "";
$firstnErr = $lastnErr = $emailErr = $pwdErr = $pwd2Err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$firstn = test_input($_POST["firstn"]);
$lastn = test_input($_POST["lastn"]);
$email = test_input($_POST["email"]);
$pwd = test_input($_POST["pwd"]);
$pwd2 = test_input($_POST["pwd2"]);
}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (empty($_POST["firstn"])) {
$firstnErr = "First name is required";
} else {
$firstn = test_input($_POST["firstn"]);
$firstn = test_input($_POST["firstn"]);
if (!preg_match("/^[a-zA-Z-' ]*$/",$firstn)) {
$firstnErr = "Only letters and white space allowed"; 
}
}
  
if (empty($_POST["lastn"])) {
$lastnErr = "Last name is required";
} else {
$lastn = test_input($_POST["lastn"]);
$lastn = test_input($_POST["lastn"]);
if (!preg_match("/^[a-zA-Z-' ]*$/",$lastn)) {
$lastnErr = "Only letters and white space allowed"; 
}
}
  
if (empty($_POST["email"])) {
$emailErr= "E-mail is required";
} else {
$email = test_input($_POST["email"]);
$email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format"; 
}
}
  
if (empty($_POST["pwd"])) {
$pwdErr = "Password is required";
} else {
$pwd = test_input($_POST["pwd"]);
if (strlen($_POST["password"]) < 6) {
$pwdErr = "Password must be at least 6 characters";
}
if ( ! preg_match("/[a-z]/i", $_POST["pwd"])) {
$pwdErr = "Password must contain at least one letter";
}
if ( ! preg_match("/[0-9]/", $_POST["pwd"])) {
$pwdErr = "Password must contain at least one number";
}
}
  
if (empty($_POST["pwd2"])) {
$pwd2Err = "Enter your password again is required";
} else {
$pwd2  = test_input($_POST["pwd2"]);
}
if ($_POST["pwd2"] !== $_POST["pwd2"]) {
$pwd2Err = "Passwords must match";
}
}

$password_hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
$_POST["name"],
$_POST["email"],
$password_hash);
                  

?>