<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Store New Password</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div class="container mt-5">

    <h2 class="text-center mb-4">Store New Password</h2>

    <?php
    // lets see the actual POST array for troubleshooting purposes
    // var_dump($_POST);
    ?>

    <!-- Contact form -->
    <form action="" method="post" novalidate>
      
      <div class="form-group row">
        <label class="col-sm-8 col-form-label">Your password has been updated</label>
        <div class="col-sm-4">
          
      <?php
        $newpassword = $_POST ['newpassword'];
        $uutolookup = $_POST['uutolookup'];
        // lookup info in the the DB
        require_once("dbcreds.php");
        
        # process an SQL UPDATE
        try {
                # prepare the SQL shortcut!
                $updateSQL = "UPDATE users SET userPassword ='" . password_hash($newpassword, PASSWORD_DEFAULT) . "' WHERE userUUID = '" . $uutolookup ."'";    
                $userSQL = $userDBH->prepare($updateSQL);
                //echo "hashedpassword contains again: " . $newpassword . "<br>";
                //echo "uutolookup contains again: " . $uutolookup . "<br>";

                # submit the SQL statement to MySQL for processing
                $userSQL->execute();

        }
        catch(PDOException $e) {
              echo "There has been an issue (#40) with the database connection.  Please see your administrator"; // $e->getMessage();
        }





          ?> 
         
      </div>
     
      
    </form>
  </div>
</body>

</html>