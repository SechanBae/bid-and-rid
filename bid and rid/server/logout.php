<?php
/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This is for the user to log out
 */

    //creates session and destroys it
    session_start();

    session_destroy();
    header("location:/bid and rid/index.php");//sends user back to index
    
?>