<!--I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement-->
<?php
    //session management
    session_start();
    $access=isset($_SESSION['User']);
?>
<!DOCTYPE html>

<html>

<head>
    <title>Bid and Rid - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bidandrid.css">
    <script type="text/javascript">
        //declaring session variable into js
        var user=<?php if($access){
                    echo '"'.$_SESSION['User'].'"';
                    }
                    else{ echo 'null';
                    }?>;
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bidandrid.js"></script>
</head>

<body>
    <header>
    <?php
        //if there is access, logout button is shown
        if($access){
            ?>
                <div class="login">
                    <p>Welcome, <?php echo $_SESSION['User'];?></p>
                    <a href="server/logout.php">Logout</a>
                </div>
                
        <?php
        }
        //if there isn't access, login form is shown, with approriate messages 
        else {
            ?>
                <div class="login">
                    <form action="server/login.php" method="post">  
                        <label for="username" >Username:</label>
                        <input type="text" id="username" name="username" required><br><br>
                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" required>
                        <br>
                        <input type="submit" id="login" value="Login">
                        <a href="signup.html"> or Sign Up</a>
                        <?php if(@$_GET['login']==true){
                        ?> <h2>Invalid username or password</h2>
                        <?php } ?>
                        <?php if(@$_GET['access']==true){
                        ?> <h2>You must be logged in</h2>
                        <?php } ?>
                    </form>
                    
                 </div>
      <?php   }?>
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
        <div class="search">
            <label for="searchbar">Search Item (Name or Description):</label>
            <input type="text" id="searchbar" size="50">
        </div>
        
        <div id="itemlist" class="listcontainer">
            
        </div>
    </main>
    
</body>

</html>