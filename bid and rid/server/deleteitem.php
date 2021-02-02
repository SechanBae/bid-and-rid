<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This file is reponsible to delete a user's item using DB query
 */
include "connect.php";
//session management
session_start();
$access = isset($_SESSION['User']);
//if theres access
if($access){
    //filter and validate parameter
    $itemid=filter_input(INPUT_GET,"itemid",FILTER_VALIDATE_INT);
    if($itemid!==null && $itemid!==false){
        $user=$_SESSION['User'];
        //DB query
        $command="DELETE FROM items WHERE itemid=? AND seller=?";
        $stmt=$dbh->prepare($command);
        $params=[$itemid,$user];
        $success=$stmt->execute($params);
        //Delete bids rows for the itemid as well
        if($success){
            //DB query
            $command="DELETE FROM bids WHERE itemid=?";
            $stmt=$dbh->prepare($command);
            $params=[$itemid];
            $deleteSucces=$stmt->execute($params);
            if($deleteSucces){
                echo "Success";//output text
            }
            else{
                echo "Failed1";//output text
            }
        }
        else{
            echo "Failed2";//output text
        }
    }
    else{
        echo "Failed3";//output text
    }
}
    
else{
    header("location:index.php?access=denied");//send user back to index page
}
