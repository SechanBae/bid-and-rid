<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement

 *  This file is reponsible to get the user's items they have put on sale by using a 
 *  DB query
 */
include "connect.php";
//session managment
session_start();
$access = isset($_SESSION['User']);
$itemlist= [];//array for json

//if theres access
if($access){
    $user=$_SESSION['User'];
    //db query
    $command="SELECT * FROM items WHERE seller=? ORDER BY complete ASC";
    $stmt=$dbh->prepare($command);
    $params=[$user];
    $success=$stmt->execute($params);
    if($success){
        while($row=$stmt->fetch()){
            $item=[
                "itemid"=>$row["itemid"],
                "itemname"=>$row["itemname"],
                "description"=>$row["description"],
                "seller"=>$row["seller"],
                "startingprice"=>$row["startingprice"],
                "highestbid"=>$row["highestbid"],
                "highestbidder"=>$row["highestbidder"],
                "complete"=>$row["complete"]
            ];
            array_push($itemlist,$item);//add item to array
        }
    }
    else{
        array_push($itemlist,"Failed");//add failed to array
    }
}
    
else{
    header("location:index.php?access=denied");//send user back to index page
}

echo json_encode($itemlist);//outpu json