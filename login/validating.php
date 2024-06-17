<?php 
require '../admin/.config/db.php'; 
session_start();

function getPermssion($PermssionId, $db){
    $sql = "SELECT * FROM user_permession WHERE Id=".$PermssionId."";
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
  
        while($row = $result->fetch_assoc()) {
            $_SESSION['make-request-prescription']  = $row["make-request-prescription"];
            $_SESSION['usernmake-request-prescription-laboratoriesame']  = $row["make-request-prescription-laboratories"];
            $_SESSION['make-request-prescription-paidstatus']  = $row["make-request-prescription-paidstatus"];
            $_SESSION['Dashboard']  = $row["Dashboard"];
        } 
 
    } else {
        // Login failed
       $error = "Invalid username or password";
    } 
}
 
try {
	 
// Check connection  
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

 
// Retrieve login form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the username and password combination exists
    $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
        session_start();
        $_SESSION['username'] = $username;
        while($row = $result->fetch_assoc()) { 
 
            $_SESSION['userId'] = $row["UserID"];
            $_SESSION['userrole'] = $row["Role"];
            $_SESSION['userfullname'] = $row["FirstName"].' '.$row["LastName"];
            getPermssion($row["Role"],  $db);
        } 
 
 
        
        header("Location: ../admin");
    } else {
        // Login failed
       $error = "Invalid username or password";
    } 
}  
 
   
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


