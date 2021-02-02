<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This file is reponsible to get a list of items based on search parameter using DB query
 */
include "connect.php";

//filter paramter
$search=filter_input(INPUT_GET,"search",FILTER_SANITIZE_SPECIAL_CHARS);
$itemlist=[];//array for json
$search = "%" . $search . "%";//add wildcard chars
//db query
$command = "SELECT * FROM items WHERE (itemname LIKE ? OR description LIKE ?) AND complete=0";
$stmt = $dbh->prepare($command);
$params = [$search, $search];
$success = $stmt->execute($params);
if ($success) {
    while ($row = $stmt->fetch()) {
        $item = [
            "itemid" => $row["itemid"],
            "itemname" => $row["itemname"],
            "description" => $row["description"],
            "seller" => $row["seller"],
            "startingprice" => $row["startingprice"],
            "highestbid" => $row["highestbid"],
            "highestbidder" => $row["highestbidder"]
        ];
        array_push($itemlist, $item);//add item to array
    }
} else {
    array_push($itemlist, "Failed");//add failed to array
}


echo json_encode($itemlist); //output json