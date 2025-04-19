<?php
$dbhost="localhost";
$dbname="classSpring25db"; //change here to your database name
$dbuser="gcarrspring25";  //change to your user name
$dbpass="C7P!;]NE*XC#";  // change to your user password

//echo "About to connect to DB<br>";
# get connected to the DB
try {
    $userDBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $userDBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
}
    //catch(PDOException $e) {
    //echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();

    catch(PDOException $e) {
        echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
?>