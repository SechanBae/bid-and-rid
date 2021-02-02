<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This file is reponsible to get the user's items they have won using DB query
 */
include "connect.php";
//session management
session_start();
$access = isset($_SESSION['User']);
//if tehres access
if($access){
    //array for json
    $bidlist=[];
    $user = $_SESSION['User'];
    //DB query
    $command = "SELECT * FROM items WHERE highestbidder=? AND complete=1";
    $stmt = $dbh->prepare($command);
    $params = [$user];
    $success = $stmt->execute($params);
    if ($success) {
        while($row=$stmt->fetch()){
            $item=[
                "itemid"=>$row["itemid"],
                "itemname"=>$row["itemname"],
                "description"=>$row["description"],
                "seller"=>$row["seller"],
                "startingprice"=>$row["startingprice"],
                "highestbid"=>$row["highestbid"],
                "highestbidder"=>$row["highestbidder"]
            ];
            array_push($bidlist,$item);//push item to array
        }
    } 
    else {
        array_push($bidlist,"Failed");//push failed to array
    }
}
    
else{
    header("location:index.php?access=denied");//send user back to index page
}

echo json_encode($bidlist); //output json
