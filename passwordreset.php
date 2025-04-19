<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Reset Credentials</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h2 class="text-center mb-4">Password Reset Sent</h2>
<?php
// catch the incoming email address from the form
$email = $_POST["email"];
// lookup the info in the DB
require_once("dbcreds.php");

# process an SQL SELECT
try {

    # prepare the SQL statement
    $userSQL = $userDBH->prepare("SELECT userName, userEmail from users WHERE userEmail = :uemail");
    
    // ALWAYS use prepared statements with parameters to protect against SQL injection attacks when
    // using form data in SQL statements.  Just bind the form field values that were POSTed into the
    // named parameter.
    $userSQL->bindParam(':uemail', $email);
    
    # setting the fetch mode
    $userSQL->setFetchMode(PDO::FETCH_ASSOC);

    // run the query
    $userSQL->execute();

    if($row = $userSQL->fetch()) {
        $to = $email;
        $subject = 'Password reset';
        $from = 'no-reply-mis419schoolproject.com';//change here to your domain
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        // generate UUID here so that it can be included in the link in the email message
        $tempUUID = bin2hex(random_bytes(16));

        
        // Compose a simple HTML email message
        $message = '
        <html>
        <body>
        <h1>Password Reset</h1>
        <p style="font-size:18px;">Hi '. $row["userName"] .', Here is the password reset email message you requested.</p>;
        <p style="font-size:18px;"><a href="http://mis419schoolproject.com/projectfolder/setnewpassword.php?uu=' . $tempUUID . '">Click here to enter a new password</a></p>;
        </body>
        </html>';
       
        // Sending email
        if(mail($to, $subject, $message, $headers)){
            //echo 'Your mail has been sent successfully.';
            // update DB table to have the tempUUID value in this user's row
            # process an SQL UPDATE
            try {
                # prepare the SQL shortcut!
                $updateSQL = "UPDATE users SET userUUID ='" . $tempUUID . "' WHERE userEmail = '" . $email ."'";
                $userSQL = $userDBH->prepare($updateSQL);
                # submit the SQL statement to MySQL for processing
                $userSQL->execute();
              }
              catch(PDOException $e) {
                  echo "There has been an issue (#37) with the database connection.  Please see your administrator"; // . $e->getMessage();
              }
        } else{
            echo 'Unable to send email. Please try again.';
        }
    } else {
        echo "No such user exists on our system";
    }
}
catch(PDOException $e) {
    echo "There has been an issue (#35) with the database connection.  Please see your administrator"; // . $e->getMessage();
}

?>       
<form action="" method="post" novalidate>
      <div class="form-group row">
        <div class="col-sm-12 mt-3">
          An email message has been sent to your email address.  Please click on the link in that message to reset your password.<br>   
        </div>
      </div>
    </form>
  </div>
</body>

</html>