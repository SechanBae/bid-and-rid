<?php

/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This file is reponsible to verify login by using DB query
 */
//session managment
session_start();
include "connect.php";

//filter and validate parameters
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
if ($username !== null && $password !== null) {
    //DB query
    $command = "SELECT * FROM users WHERE username=?";
    $stmt = $dbh->prepare($command);
    $params = [$username];
    $success = $stmt->execute($params);
    if ($success) {
        if ($row = $stmt->fetch()) {
            //verify password
            if (password_verify($password, $row["password"])) {
                $_SESSION['User'] = $username;
                header("location:/bid and rid/index.php");//send user back to index page with session
            } 
            else {
                header("location:/bid and rid/index.php?login=invalid");//send user back to index page
            }
        } 
        else {
            header("location:/bid and rid/index.php?login=invalid");//send user back to index page
        }
    } 
    else {
        header("location:/bid and rid/index.php?login=invalid");//send user back to index page
    }
} 
else {
    header("location:/bid and rid/index.php?login=invalid");//send user back to index page
}
    
?>