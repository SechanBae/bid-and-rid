<!--I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement-->
<?php
//session management
session_start();
$access = isset($_SESSION['User']);
//send back to index with params
if ($access == false) {
    header("location:index.php?access=denied");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Items</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bidandrid.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/myitems.js"></script>
</head>

<body>
    <header>
        <div class="login">
            <p>Welcome, <?php echo $_SESSION['User']; ?></p>
            <a href="server/logout.php">Logout</a>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="myitems.php">My Items on Sale</a></li>
            <li><a href="mybids.php">My Bids</a></li>
            <li><a href="sellitem.php">Add Item for Sale</a></li>
        </ul>
    </nav>
    <main>
        
         <div class="listcontainer" id="itemlist">
            
        </div>
    </main>
</body>

</html>