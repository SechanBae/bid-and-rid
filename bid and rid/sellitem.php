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
    <title>Sell Item</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bidandrid.css">
    <script src="js/sellitem.js"></script>
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
                    
        <form class="sellform" id="sellitem">
            <p id="message"></p>
            <label for="name">Item Name (25 characters): </label>  
            <input type="text" id="itemname" maxlength="25" required><br>
            <label for="description">Description (50 characters): </label>
            <textarea id="description" required maxlength="50" rows="2" cols="25"></textarea><br>
            <label for="price">Starting price: </label>
            <input type="number" id="price" required step="0.01" min="0.00" ><br>
            <input type="submit" id="additem" value="Sell Item">
        </form>
    </main>
</body>

</html>