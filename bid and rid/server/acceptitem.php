<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This file is reponsible to finish the auction for an item of a user by accepting the latest offer
 * using a DB query
 */
include "connect.php";
//session management
session_start();
$access = isset($_SESSION['User']);
//if there is access
if($access){
    
    //filter parameter
    $itemid=filter_input(INPUT_GET,"itemid",FILTER_VALIDATE_INT);
    //validate parameter
    if($itemid!=null && $itemid!=false){
        //DB query
        $user=$_SESSION['User'];
        $command="UPDATE items SET complete =1 WHERE itemid=? AND seller=?";
        $stmt=$dbh->prepare($command);
        $params=[$itemid,$user];
        $success=$stmt->execute($params);
        if($success){
            echo "Success";//output text
        }
        else{
            echo "Failed";//output text
        }
    }
    else{
        echo "Failed";//output text
    }
}
    
else{
    header("location:index.php?access=denied");//send user back to index page
}
