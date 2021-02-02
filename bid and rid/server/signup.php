<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This file is reponsible to register a new account
 */
include "connect.php";

//make sure there are no special characters in username
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$_GET['username'])){
    echo "No special characters allowed in username";
}

else{
    //filter parameters
    $username=filter_input(INPUT_GET,"username",FILTER_SANITIZE_SPECIAL_CHARS);
    $password=filter_input(INPUT_GET,"password",FILTER_SANITIZE_SPECIAL_CHARS);
    $name=filter_input(INPUT_GET,"name",FILTER_SANITIZE_SPECIAL_CHARS);
    $email=filter_input(INPUT_GET,"email",FILTER_VALIDATE_EMAIL);
    //validate parameters
    if($username!==null && $password !==null && $name!==null && $email !==false && $email !==null){
        //DB query
        $command="SELECT * FROM users WHERE username=?";
        $stmt=$dbh->prepare($command);
        $params=[$username];
        $success=$stmt->execute($params);

        if($success){
            //if there is a username matched with the parameter
            if($stmt->fetch()){
                echo "The username has been taken";
            }
            //add new user if there is no match
            else{
                $hashed=password_hash($password,PASSWORD_DEFAULT);
                $command="INSERT INTO users (username,password,name,email) VALUES (?,?,?,?)";
                $stmt=$dbh->prepare($command);
                $params=[$username,$hashed,$name,$email];
                $successInsert=$stmt->execute($params);

                if($successInsert){
                    echo "Account has been successfully registered";//output text
                }
                else{
                    echo "Failed to register";//output text
                }
            }
        }
        else{
            echo "Failed to register";//output text
        }
    }
    else{
        echo "Failed to register";//output text
    }
}

