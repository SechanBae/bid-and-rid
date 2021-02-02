<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This file is reponsible to add a user's item to the auction
 */
include "connect.php";

//session management
session_start();
$access=isset($_SESSION['User']);
//if there's access
if($access){
    //filter and validate parameters
    $itemname=filter_input(INPUT_GET,"itemname",FILTER_SANITIZE_SPECIAL_CHARS);
    $description=filter_input(INPUT_GET,"description",FILTER_SANITIZE_SPECIAL_CHARS);
    $price=filter_input(INPUT_GET,"price",FILTER_VALIDATE_FLOAT);
    $seller=$_SESSION['User'];
    if($itemname!==null && $description !==null && $price!==null && $price !==false && $seller !==null){
        
        //DB query
        $command="INSERT INTO items (itemname,description,seller,startingprice,highestbid) VALUES (?,?,?,?,?)";
        $stmt=$dbh->prepare($command);
        $params=[$itemname,$description,$seller,$price,$price];
        $success=$stmt->execute($params);


        if($success){
            echo "Item Succesfully Added";//output text
        }
        else{
            echo "Item Falied to Add";//output text

        }
        
    }
    else{
        echo "Parameters are invalid";//output text
    }
}
else{
    echo "Must be logged in";//output text
}
