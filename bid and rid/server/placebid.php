<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This file is reponsible to place a bid on an item using a DB query
 */
include "connect.php";


//sesion management
session_start();
$access=isset($_SESSION['User']);

//array for json
$message=[];
//if theres access
if($access){
    //filter and validate parameters
    $username=filter_input(INPUT_GET,"username",FILTER_SANITIZE_SPECIAL_CHARS);
    $itemid=filter_input(INPUT_GET,"itemid",FILTER_VALIDATE_INT);
    $bidamount=filter_input(INPUT_GET,"bidamount",FILTER_VALIDATE_FLOAT);
    if($username!==null && $itemid!==false && $itemid!==null && $bidamount!==false && $bidamount!==null){
        //DB query
        $command="UPDATE items SET highestbidder=?, highestbid=? WHERE itemid=? AND highestbid<?";
        $stmt=$dbh->prepare($command);
        $params=[$username,$bidamount,$itemid,$bidamount];
        $success=$stmt->execute($params);
        if($success){
            //If DB query has changed a row, INSERT a row into bids
            if($stmt->rowCount()){
                //DB query
                $command="INSERT INTO bids (itemid,username,bidprice) VALUES(?,?,?)";
                $insertstmt=$dbh->prepare($command);
                $params=[$itemid,$username,$bidamount];
                $insertSuccess=$insertstmt->execute($params);
                if($insertSuccess){
                    $message[]="Bid has been Successfully Placed";//add text to message
                }
                else{
                    $message[]="Failed";//add text to message
                }
            }
            else{
                $message[]="Bid must be greater than current bid";//add text to message
    
            }
        }
        else{
            $message[]="Bid did not go through";//add text to message
        }
    }
    else if($bidamount===false){
        $message[]= "Bid must be a valid price";//add text to message
    }
    else{
        $message[]= "Invalid Params";//add text to message
    }
    $message[]=$itemid;
}
else{
    $message[]="Must be logged in";//add text to message
}
//output json
echo json_encode($message);
