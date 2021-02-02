<?php

/**I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
 *  This is to connect to the database
 */

try{
    $dbh= new PDO("mysql:host=localhost;dbname=000803348","root","");
}
catch(Exception $e){
    die("Failed to connect to database{$e->getMessage()}");
}