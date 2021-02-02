<?php

include "connect.php";
session_start();
$access = isset($_SESSION['User']);
if($access){
    $bidlist=[];
    $user = $_SESSION['User'];
    $command = "SELECT itemname, bidprice FROM items JOIN bids ON items.itemid=bids.itemid WHERE username=? ORDER BY bidprice DESC";
    $stmt = $dbh->prepare($command);
    $params = [$user];
    $success = $stmt->execute($params);
    if ($success) {
        while($row=$stmt->fetch()){
            $item=$row;
            array_push($bidlist,$item);
        }
    } 
    else {
        array_push($bidlist,"Failed");
    }
}
    
else{
    header("location:index.php");
}

echo json_encode($bidlist);
