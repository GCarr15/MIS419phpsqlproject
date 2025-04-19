<?php
    // start session
    session_start(); //load the $_SESSION values into memory from temp file on disk
    
    /* Unset all session variables, this means that yhis function frees all session variables. 
    It clears the $_SESSION array, but it does not end the session
    By calling session_unset() before session_destroy(), you ensure that all 
    session variables are cleared before the session is destroyed. */
    session_unset();
    
    // Destroy the session
    session_destroy(); 

    echo "<a href='http://mis419schoolproject.com/projectfolder/usersverification.php'> Click here to login </a>" ; 
?>